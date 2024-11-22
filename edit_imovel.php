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

// Obtém o ID do imóvel
$id = $_GET['id'];

// Consulta para buscar os detalhes do imóvel
$query = "SELECT * FROM cadimovel WHERE IdImovel = $id";
$result = mysqli_query($con, $query);

if (!$result) {
    echo "Erro na consulta SQL: " . mysqli_error($con);
    exit;
}

$imovel = mysqli_fetch_assoc($result);

// Verifica se já existe um documento associado ao imóvel
$queryBook = "SELECT * FROM book WHERE IdImovel = $id";
$resultBook = mysqli_query($con, $queryBook);

if (!$resultBook) {
    echo "Erro na consulta SQL: " . mysqli_error($con);
    exit;
}

$documento = mysqli_fetch_assoc($resultBook);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomeImovel = $_POST['NomeImovel'];
    $estado = $_POST['Estado'];
    $cidade = $_POST['Cidade'];
    $bairro = $_POST['Bairro'];
    $estagio = $_POST['Estagio'];
    $tipo = $_POST['Tipo'];
    $quartos = $_POST['Quartos'];
    $suites = $_POST['Suites'];
    $vagas = $_POST['Vagas'];
    $preco = $_POST['Preco'];
    $dataEntrega = $_POST['DataEntrega'];
    $area = $_POST['Area'];
    $descricao = $_POST['Descricao'];

    // Atualiza os dados do imóvel
    $query = "UPDATE cadimovel SET 
                NomeImovel='$nomeImovel', 
                Estado='$estado', 
                Cidade='$cidade', 
                Bairro='$bairro', 
                Estagio='$estagio', 
                Tipo='$tipo', 
                Quartos='$quartos', 
                Suites='$suites', 
                Vagas='$vagas', 
                Preco='$preco', 
                DataEntrega='$dataEntrega', 
                Area='$area', 
                Descricao='$descricao' 
              WHERE IdImovel=$id";

    if (mysqli_query($con, $query)) {
        echo "Imóvel atualizado com sucesso.";

        // Verifica se um arquivo foi enviado
        if (isset($_FILES['documento']) && $_FILES['documento']['error'] == UPLOAD_ERR_OK) {
            $targetDir = "book/";
            $fileName = basename($_FILES['documento']['name']);
            $targetFilePath = $targetDir . $fileName;

            // Move o arquivo para a pasta "book"
            if (move_uploaded_file($_FILES['documento']['tmp_name'], $targetFilePath)) {
                if ($documento) {
                    // Atualiza o documento se já existir
                    $queryUpdateBook = "UPDATE book SET path='$targetFilePath', data_upload=NOW() WHERE IdImovel=$id";
                    mysqli_query($con, $queryUpdateBook);
                    echo "Documento atualizado com sucesso.";
                } else {
                    // Insere um novo documento se não existir
                    $queryInsertBook = "INSERT INTO book (IdImovel, path, data_upload, nome) VALUES ($id, '$targetFilePath', NOW(), '$fileName')";
                    mysqli_query($con, $queryInsertBook);
                    echo "Documento adicionado com sucesso.";
                }
            } else {
                echo "Erro ao mover o arquivo para a pasta.";
            }
        }
    } else {
        echo "Erro ao atualizar imóvel: " . mysqli_error($con);
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

    <div class="container border my-4 p-4">
        <h2>Editar Imóvel</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="NomeImovel" class="form-label">Nome do Imóvel</label>
                <input type="text" class="form-control" id="NomeImovel" name="NomeImovel" value="<?php echo $imovel['NomeImovel']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Estado" class="form-label">Estado</label>
                <input type="text" class="form-control" id="Estado" name="Estado" value="<?php echo $imovel['Estado']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Cidade" class="form-label">Cidade</label>
                <input type="text" class="form-control" id="Cidade" name="Cidade" value="<?php echo $imovel['Cidade']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Bairro" class="form-label">Bairro</label>
                <input type="text" class="form-control" id="Bairro" name="Bairro" value="<?php echo $imovel['Bairro']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Estagio" class="form-label">Estágio</label>
                <input type="text" class="form-control" id="Estagio" name="Estagio" value="<?php echo $imovel['Estagio']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Tipo" class="form-label">Tipo</label>
                <input type="text" class="form-control" id="Tipo" name="Tipo" value="<?php echo $imovel['Tipo']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Quartos" class="form-label">Quartos</label>
                <input type="text" class="form-control" id="Quartos" name="Quartos" value="<?php echo $imovel['Quartos']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Suites" class="form-label">Suítes</label>
                <input type="text" class="form-control" id="Suites" name="Suites" value="<?php echo $imovel['Suites']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Vagas" class="form-label">Vagas</label>
                <input type="text" class="form-control" id="Vagas" name="Vagas" value="<?php echo $imovel['Vagas']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Preco" class="form-label">Preço</label>
                <input type="number" step="0.01" class="form-control" id="Preco" name="Preco" value="<?php echo $imovel['Preco']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="DataEntrega" class="form-label">Data de Entrega</label>
                <input type="date" class="form-control" id="DataEntrega" name="DataEntrega" value="<?php echo $imovel['DataEntrega']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Area" class="form-label">Área (m²)</label>
                <input type="text" class="form-control" id="Area" name="Area" value="<?php echo $imovel['Area']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="Descricao" name="Descricao" rows="3" required><?php echo $imovel['Descricao']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="documento" class="form-label">Anexar Documento (PDF)</label>
                <input type="file" class="form-control" id="documento" name="documento" accept=".pdf">
            </div>
            <button type="submit" class="btn btn-primary">Atualizar Imóvel</button>
        </form>
    </div>

    <div class="mt-4 text-center">
        <a href="logout.php" class="btn btn-danger" onclick="return confirmLogout()">Sair</a>
    </div>
    
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
