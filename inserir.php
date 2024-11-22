<?php
session_start();
require('conexao.php');

// Verifique se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Verifique se o cargo do usuário é 'Administrador'
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] !== 'Administrador') {
    header("Location: negado.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeImovel = mysqli_real_escape_string($con, $_POST['NomeImovel']);
    $estado = mysqli_real_escape_string($con, $_POST['Estado']);
    $cidade = mysqli_real_escape_string($con, $_POST['Cidade']);
    $bairro = mysqli_real_escape_string($con, $_POST['Bairro']);
    $estagio = mysqli_real_escape_string($con, $_POST['Estagio']);
    $tipo = mysqli_real_escape_string($con, $_POST['Tipo']);
    $quartos = mysqli_real_escape_string($con, $_POST['Quartos']);
    $suites = mysqli_real_escape_string($con, $_POST['Suites']);
    $vagas = mysqli_real_escape_string($con, $_POST['Vagas']);
    $preco = floatval($_POST['Preco']);
    $dataEntrega = mysqli_real_escape_string($con, $_POST['DataEntrega']);
    $area = mysqli_real_escape_string($con, $_POST['Area']);
    $descricao = mysqli_real_escape_string($con, $_POST['Descricao']);

    mysqli_begin_transaction($con);

    try {
        // Cadastra o imóvel
        $queryImovel = "INSERT INTO cadimovel (NomeImovel, Estado, Cidade, Bairro, Estagio, Tipo, Quartos, Suites, Vagas, Preco, DataEntrega, Area, Descricao) 
                        VALUES ('$nomeImovel', '$estado', '$cidade', '$bairro', '$estagio', '$tipo', '$quartos', '$suites', '$vagas', $preco, '$dataEntrega', '$area', '$descricao')";
        
        if (!mysqli_query($con, $queryImovel)) {
            throw new Exception('Erro ao cadastrar imóvel: ' . mysqli_error($con));
        }

        $idImovel = mysqli_insert_id($con);

        // Upload da imagem principal
        if (isset($_FILES['ImagemPrincipal']) && $_FILES['ImagemPrincipal']['error'] === UPLOAD_ERR_OK) {
            $imagemPrincipal = $_FILES['ImagemPrincipal'];
            $pasta = "arquivos/";
            $nomeDoArquivo = $imagemPrincipal['name'];
            $novoNomeDoArquivo = uniqid();
            $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

            if ($extensao != "jpg" && $extensao != 'png') {
                throw new Exception("Tipo de arquivo não aceito: $nomeDoArquivo");
            }

            $path = $pasta . $novoNomeDoArquivo . "." . $extensao;
            $deu_certo = move_uploaded_file($imagemPrincipal["tmp_name"], $path);
            if (!$deu_certo) {
                throw new Exception("Falha ao enviar arquivo: $nomeDoArquivo");
            }

            $queryImagemPrincipal = "INSERT INTO imagemPrincipal (IdImovel, path, data_upload, nome) 
                                     VALUES ('$idImovel', '$path', NOW(), '$nomeDoArquivo')";
            if (!mysqli_query($con, $queryImagemPrincipal)) {
                throw new Exception('Erro ao cadastrar imagem principal: ' . mysqli_error($con));
            }
        }

        // Upload das imagens adicionais
        if (isset($_FILES['Imagens']) && count($_FILES['Imagens']['name']) > 0) {
            $arquivos = $_FILES['Imagens'];
            $pasta = "arquivos/";
            
            for ($i = 0; $i < count($arquivos['name']); $i++) {
                $nomeDoArquivo = $arquivos['name'][$i];
                $novoNomeDoArquivo = uniqid();
                $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

                if ($extensao != "jpg" && $extensao != 'png') {
                    throw new Exception("Tipo de arquivo não aceito: $nomeDoArquivo");
                }

                $path = $pasta . $novoNomeDoArquivo . "." . $extensao;
                $deu_certo = move_uploaded_file($arquivos["tmp_name"][$i], $path);
                if (!$deu_certo) {
                    throw new Exception("Falha ao enviar arquivo: $nomeDoArquivo");
                }

                $queryImagem = "INSERT INTO imagensimovel (IdImovel, path, data_upload, nome) 
                                VALUES ('$idImovel', '$path', NOW(), '$nomeDoArquivo')";
                if (!mysqli_query($con, $queryImagem)) {
                    throw new Exception('Erro ao cadastrar imagem: ' . mysqli_error($con));
                }
            }
        }

        // Upload do arquivo PDF (book) para a nova tabela
        if (isset($_FILES['book']) && $_FILES['book']['error'] === UPLOAD_ERR_OK) {
            $pdf = $_FILES['book'];
            $pastaBook = "book/";
            $nomeArquivoPDF = $pdf['name'];
            $novoNomePDF = uniqid();
            $extensaoPDF = strtolower(pathinfo($nomeArquivoPDF, PATHINFO_EXTENSION));

            if ($extensaoPDF != "pdf") {
                throw new Exception("Tipo de arquivo não aceito: $nomeArquivoPDF. Apenas PDFs são permitidos.");
            }

            $pathPDF = $pastaBook . $novoNomePDF . "." . $extensaoPDF;
            $pdfUploadSucesso = move_uploaded_file($pdf["tmp_name"], $pathPDF);
            if (!$pdfUploadSucesso) {
                throw new Exception("Falha ao enviar arquivo PDF: $nomeArquivoPDF");
            }

            // Insere o PDF na nova tabela 'book'
            $queryPDF = "INSERT INTO book (IdImovel, path, data_upload, nome) 
                         VALUES ('$idImovel', '$pathPDF', NOW(), '$nomeArquivoPDF')";
            if (!mysqli_query($con, $queryPDF)) {
                throw new Exception('Erro ao cadastrar PDF na nova tabela: ' . mysqli_error($con));
            }
        }

        mysqli_commit($con);
        echo "<p>Imóvel, imagens e PDF cadastrados com sucesso!</p>";

    } catch (Exception $e) {
        mysqli_rollback($con);
        echo $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pgi.css">
    <title>ENDLESS IMOBILIÁRIA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="icon" href="imgs/endless3DsemFundo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="margin-top: 160px;">
    
    <header class="custom-header">
        <div class="logo">
            <a href="javascript:void(0);" class="menu-icon" onclick="toggleMenu()">&#9776;</a>
            <a href="pgi.php"><img src="imgs/endless3DsemFundo.png" alt="ENDLESS IMOBILIÁRIA" class="header-logo"></a>
        </div>

        <div id="menu-links" class="menu-links">
            <a href="javascript:void(0);" class="close-menu" onclick="toggleMenu()">&#10006;</a>
            <a href="pgi.php">Empreendimentos</a>
            <a href="clientes.php">CRM</a>
            <a href="perfil.php"><img src="imgs/user.png" alt="perfil" class="user-logo">Perfil</a>
            <?php if ($_SESSION['cargo'] === 'Administrador') : ?>
                <a href="administrador.php">Painel de Administração</a>
            <?php endif; ?>
        </div>
    </header>
    
    <div class="container border my-5 py-4 px-5">
        <h1 class="m-0">Cadastro de Imóveis</h1>
        <p class="small">Preencha as informações abaixo para cadastrar um novo imóvel.</p>

        <form action="inserir.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="NomeImovel">Nome do Imóvel:</label>
                <input type="text" class="form-control" id="NomeImovel" name="NomeImovel" required>
            </div>
            <div class="mb-3">
                <label for="Estado">Estado:</label>
                <input type="text" class="form-control" id="Estado" name="Estado" maxlength="2" required>
            </div>
            <div class="mb-3">
                <label for="Cidade">Cidade:</label>
                <input type="text" class="form-control" id="Cidade" name="Cidade" required>
            </div>
            <div class="mb-3">
                <label for="Bairro">Bairro:</label>
                <input type="text" class="form-control" id="Bairro" name="Bairro" required>
            </div>
            <div class="mb-3">
                <label for="Estagio">Estágio:</label>
                <input type="text" class="form-control" id="Estagio" name="Estagio" required>
            </div>
            <div class="mb-3">
                <label for="Tipo">Tipo:</label>
                <input type="text" class="form-control" id="Tipo" name="Tipo" required>
            </div>
            <div class="mb-3">
                <label for="Quartos">Quartos:</label>
                <input type="text" class="form-control" id="Quartos" name="Quartos" required>
            </div>
            <div class="mb-3">
                <label for="Suites">Suítes:</label>
                <input type="text" class="form-control" id="Suites" name="Suites" required>
            </div>
            <div class="mb-3">
                <label for="Vagas">Vagas:</label>
                <input type="text" class="form-control" id="Vagas" name="Vagas" required>
            </div>
            <div class="mb-3">
                <label for="Preco">Preço:</label>
                <input type="number" step="0.01" class="form-control" id="Preco" name="Preco" required>
            </div>
            <div class="mb-3">
                <label for="DataEntrega">Data de Entrega:</label>
                <input type="date" class="form-control" id="DataEntrega" name="DataEntrega" required>
            </div>
            <div class="mb-3">
                <label for="Area">Área:</label>
                <input type="text" class="form-control" id="Area" name="Area" required>
            </div>
            <div class="mb-3">
                <label for="Descricao">Descrição:</label>
                <textarea class="form-control" id="Descricao" name="Descricao" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="Imagens" class="form-label">Selecione as imagens:</label><br>
                <input name="Imagens[]" type="file" class="form-control" multiple required>
            </div>
            <div class="mb-3">
                <label for="ImagemPrincipal" class="form-label">Imagem Principal:</label><br>
                <input name="ImagemPrincipal" type="file" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="book" class="form-label">Book do Corretor:</label>
                <input type="file" class="form-control" id="book" name="book">
            </div>

            <button type="submit" class="btn btn-success">Cadastrar Imóvel</button>
        </form>
    </div>

    <div class="mt-4 text-center">
        <a href="logout.php" class="btn btn-danger" onclick="return confirmLogout()">Sair</a>
    </div>
    
    <script>
    function confirmLogout() {
        return confirm("Você tem certeza que deseja sair?");
    }
    </script>

<div class="footer-basic">
        <footer>
            <div class="social">
                <a href="https://www.instagram.com/endlesssolucoesimobiliarias/profilecard/?igsh=MW56eTY0NWp4eHBtMw=="><i class="icon ion-social-instagram"></i></a>
                <a href="mailto:endlesssolucoesimobiliaria@gmail.com"><i class="icon ion-email"></i></a>
                <a href="tel:+55 19 99195-0356"><i class="icon ion-ios-telephone"></i></a>
                <a href="https://www.facebook.com/Ericas.consultoria?locale=pt_BR"><i class="icon ion-social-facebook"></i></a>
            </div>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Home</a></li>
                <li class="list-inline-item"><a href="#">Services</a></li>
                <li class="list-inline-item"><a href="#">About</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
            </ul>
            <p class="copyright">&copy; 2024 Endless Imobiliária. Todos os direitos reservados.</p>
        </footer>
    </div>

    <script src="script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
