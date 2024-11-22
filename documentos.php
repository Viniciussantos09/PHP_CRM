<?php
session_start();
require('conexao.php');

// Verifica se o usuário está autenticado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Captura o idUser da sessão
$id_user = $_SESSION['user_id'];

// Verifica se o ID do cliente foi fornecido
$id_cliente = $_GET['id_cliente'] ?? null;

// Verifica se o cliente existe no banco de dados
$query = "SELECT Id_cliente FROM cliente WHERE Id_cliente = '$id_cliente'";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    // O cliente existe, continue com a inserção na tabela documentos
} else {
    // Lidar com o caso em que o cliente não existe
    echo "Erro: O cliente não foi encontrado.";
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && $id_cliente) {
    // Define o diretório de destino para os uploads
    $target_dir = "documentos/";

    // Função para mover o arquivo com nome único
    function moverArquivoSeguro($file, $target_dir, $id_cliente) {
        if (!isset($file['tmp_name']) || empty($file['tmp_name'])) {
            return null;
        }

        $extensao = pathinfo($file['name'], PATHINFO_EXTENSION);
        $novo_nome = $id_cliente . '_' . uniqid() . '.' . $extensao;
        $caminho_completo = $target_dir . $novo_nome;

        if (move_uploaded_file($file['tmp_name'], $caminho_completo)) {
            return $caminho_completo;
        } else {
            return null;
        }
    }

    // Inicializar as variáveis de arquivo como null
    $rg_cpf = isset($_FILES['rg_cpf']) ? moverArquivoSeguro($_FILES['rg_cpf'], $target_dir, $id_cliente) : null;
    $carteira_trabalho = isset($_FILES['carteira_trabalho']) ? moverArquivoSeguro($_FILES['carteira_trabalho'], $target_dir, $id_cliente) : null;
    $certidao_casamento = isset($_FILES['certidao_casamento']) ? moverArquivoSeguro($_FILES['certidao_casamento'], $target_dir, $id_cliente) : null;
    $holerites = isset($_FILES['holerites']) ? moverArquivoSeguro($_FILES['holerites'], $target_dir, $id_cliente) : null;
    $comprovante_residencia = isset($_FILES['comprovante_residencia']) ? moverArquivoSeguro($_FILES['comprovante_residencia'], $target_dir, $id_cliente) : null;
    $ficha_cadastral = isset($_FILES['ficha_cadastral']) ? moverArquivoSeguro($_FILES['ficha_cadastral'], $target_dir, $id_cliente) : null;

    // Proponentes
    $rg_cpf_prop = isset($_FILES['rg_cpf_prop']) ? moverArquivoSeguro($_FILES['rg_cpf_prop'], $target_dir, $id_cliente) : null;
    $carteira_trabalho_prop = isset($_FILES['carteira_trabalho_prop']) ? moverArquivoSeguro($_FILES['carteira_trabalho_prop'], $target_dir, $id_cliente) : null;
    $holerites_prop = isset($_FILES['holerites_prop']) ? moverArquivoSeguro($_FILES['holerites_prop'], $target_dir, $id_cliente) : null;
    $fgts_prop = isset($_FILES['fgts_prop']) ? moverArquivoSeguro($_FILES['fgts_prop'], $target_dir, $id_cliente) : null;
    $imposto_renda_prop = isset($_FILES['imposto_renda_prop']) ? moverArquivoSeguro($_FILES['imposto_renda_prop'], $target_dir, $id_cliente) : null;

    // Outros Documentos
    $ficha_cohab = isset($_FILES['ficha_cohab']) ? moverArquivoSeguro($_FILES['ficha_cohab'], $target_dir, $id_cliente) : null;
    $ficha_mop = isset($_FILES['ficha_mop']) ? moverArquivoSeguro($_FILES['ficha_mop'], $target_dir, $id_cliente) : null;
    $fgts = isset($_FILES['fgts']) ? moverArquivoSeguro($_FILES['fgts'], $target_dir, $id_cliente) : null;
    $imposto_renda = isset($_FILES['imposto_renda']) ? moverArquivoSeguro($_FILES['imposto_renda'], $target_dir, $id_cliente) : null;
    $dependente = isset($_FILES['dependente']) ? moverArquivoSeguro($_FILES['dependente'], $target_dir, $id_cliente) : null;
    $outros_I = isset($_FILES['outros_I']) ? moverArquivoSeguro($_FILES['outros_I'], $target_dir, $id_cliente) : null;
    $outros_II = isset($_FILES['outros_II']) ? moverArquivoSeguro($_FILES['outros_II'], $target_dir, $id_cliente) : null;

    // Prepara a query de inserção
    $stmt = $con->prepare("
        INSERT INTO documentos 
        (Id_cliente, idUser, RG_CPF, Carteira_Trabalho, Certidao_Casamento_Nascimento, Holerites, Comprovante_Residencia, Ficha_Cadastral, RG_CPF_prop, Carteira_Trabalho_prop, Holerites_prop, FGTS_prop, Imposto_Renda_prop, Ficha_COHAB, Ficha_MOP, FGTS, Imposto_Renda, Dependente, outros_I, outros_II) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Erro na preparação da query: " . $con->error);
    }

    $stmt->bind_param('sissssssssssssssssss', 
        $id_cliente, $id_user, $rg_cpf, $carteira_trabalho, $certidao_casamento, $holerites, 
        $comprovante_residencia, $ficha_cadastral, $rg_cpf_prop, $carteira_trabalho_prop,
        $holerites_prop, $fgts_prop, $imposto_renda_prop, $ficha_cohab, $ficha_mop, $fgts, $imposto_renda, 
        $dependente, $outros_I, $outros_II
    );

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Documentos enviados com sucesso!";
        header("Location: documentos.php?id_cliente=$id_cliente");
        exit;
    } else {
        $_SESSION['error_message'] = "Erro ao enviar documentos: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
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

<body style="margin-top: 140px;">

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success">
            <?php
            echo $_SESSION['success_message'];
            unset($_SESSION['success_message']); // Limpa a mensagem após exibi-la
            ?>
        </div>
    <?php elseif (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger">
            <?php
            echo $_SESSION['error_message'];
            unset($_SESSION['error_message']); // Limpa a mensagem após exibi-la
            ?>
        </div>
    <?php endif; ?>

    <header class="custom-header">
        <!-- Menu Toggle e Logo à esquerda -->
        <div class="logo">
            <a href="javascript:void(0);" class="menu-icon" onclick="toggleMenu()">&#9776;</a>
            <a href="pgi.php"><img src="imgs/endless3DsemFundo.png" alt="ENDLESS IMOBILIÁRIA" class="header-logo"></a>
        </div>

        <!-- Menu Responsivo -->
        <div id="menu-links" class="menu-links">
            <a href="javascript:void(0);" class="close-menu" onclick="toggleMenu()">&#10006;</a>
            <a href="pgi.php">Empreendimentos</a>
            <a href="clientes.php">CRM</a>
            <a href="perfil.php"><img src="imgs/user.png" alt="perfil" class="user-logo">Perfil</a>
        </div>
    </header>

    <div class="container-docs">
        <h1>Envio de Documentos</h1>
        <form action="documentos.php?id_cliente=<?php echo $id_cliente; ?>" method="post" enctype="multipart/form-data">
            <div class="document-box">
                <label for="rg_cpf" class="form-label">RG/CPF (Obrigatório)</label>
                <input type="file" name="rg_cpf" class="form-control" required>
            </div>
            <div class="document-box">
                <label for="carteira_trabalho">Carteira de Trabalho:</label>
                <input type="file" name="carteira_trabalho" class="form-control" required>
            </div>
            <div class="document-box">
                <label for="certidao_casamento">Certidão de Casamento/Nascimento:</label>
                <input type="file" name="certidao_casamento" class="form-control" required>
            </div>
            <div class="document-box">
                <label for="holerites">Holerites:</label>
                <input type="file" name="holerites" class="form-control" required>
            </div>
            <div class="document-box">
                <label for="comprovante_residencia">Comprovante de Residência:</label>
                <input type="file" name="comprovante_residencia" class="form-control" required>
            </div>
            <div class="document-box">
                <label for="fgts">FGTS:</label>
                <input type="file" name="fgts" class="form-control">
            </div>
            <div class="document-box">
                <label for="imposto_renda">Imposto de Renda:</label>
                <input type="file" name="imposto_renda" class="form-control">
            </div>
            <div class="document-box">
                <label for="ficha_cohab">Ficha COHAB:</label>
                <input type="file" name="ficha_cohab" class="form-control">
            </div>
            <div class="document-box">
                <label for="ficha_mop">Ficha MOP:</label>
                <input type="file" name="ficha_mop" class="form-control">
            </div>
            <div class="document-box">
                <label for="ficha_cadastral">Ficha Cadastral:</label>
                <input type="file" name="ficha_cadastral" class="form-control" required>
            </div>
            <div class="document-box">
                <label for="dependente">Dependente:</label>
                <input type="file" name="dependente" class="form-control">
            </div>
            <div class="document-box">
                <label for="outros_I">Outros Documentos:</label>
                <input type="file" name="outros_I" class="form-control">
            </div>
            <div class="document-box">
                <label for="outros_II">Outros Documentos:</label>
                <input type="file" name="outros_II" class="form-control">
            </div>

            <div class="mb-3">
                <button type="button" class="btn btn-info" onclick="toggleProponente()">Adicionar Documentos do Proponente</button>
            </div>

            <div id="proponente_fields">

                <h2>Documentos dos Proponentes</h2>
                <div class="document-box">
                    <label for="rg_cpf_prop">RG/CPF do Proponente:</label>
                    <input type="file" name="rg_cpf_prop" class="form-control">
                </div>
                <div class="document-box">
                    <label for="carteira_trabalho_prop">Carteira de Trabalho do Proponente:</label>
                    <input type="file" name="carteira_trabalho_prop" class="form-control">
                </div>
                <div class="document-box">
                    <label for="holerites_prop">Holerites do Proponente:</label>
                    <input type="file" name="holerites_prop" class="form-control">
                </div>
                <div class="document-box">
                    <label for="fgts_prop">FGTS do Proponente:</label>
                    <input type="file" name="fgts_prop" class="form-control">
                </div>
                <div class="document-box">
                    <label for="imposto_renda_prop">Imposto de Renda do Proponente:</label>
                    <input type="file" name="imposto_renda_prop" class="form-control">
                </div>
                
            </div>
                
            <button type="submit" class="btn btn-primary">Enviar Documentos</button>
        </form>
    </div>
    
    <div class="mt-4 text-center">
        <a href="clientes.php" class="btn btn-secondary" onclick="return confirmLogout()">Sair</a>
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
