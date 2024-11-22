<?php
session_start();
require('conexao.php');

// Verifique se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$id_cliente = $_GET['id'] ?? null;

// Verifica se o ID do cliente foi fornecido
if (!$id_cliente) {
    $_SESSION['error_message'] = "ID do cliente não fornecido.";
    header("Location: clientes.php");
    exit;
}

// Função para gerar um nome de arquivo único
function gerarNomeUnico($arquivo) {
    $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
    return uniqid() . '.' . $extensao;
}

// Processa o reenvio dos documentos se o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cliente = $_POST['id_cliente'] ?? null;

    if (!$id_cliente) {
        $_SESSION['error_message'] = "ID do cliente não fornecido.";
        header("Location: reenviar_documentos.php");
        exit;
    }

    // Processa cada documento reenviado
    foreach ($_FILES as $campo => $arquivo) {
        if ($arquivo['error'] === UPLOAD_ERR_OK) {
            // Gera um nome único e define o caminho do arquivo
            $nome_arquivo = gerarNomeUnico($arquivo);
            $caminho_arquivo = 'documentos/' . $nome_arquivo;

            // Mover o arquivo para a pasta de uploads
            if (move_uploaded_file($arquivo['tmp_name'], $caminho_arquivo)) {
                // Atualizar o caminho do arquivo no banco de dados usando uma query preparada
                $stmt = $con->prepare("UPDATE documentos SET $campo = ? WHERE Id_cliente = ?");
                if ($stmt) {
                    $stmt->bind_param('ss', $caminho_arquivo, $id_cliente); // Usar 'ss' para dois parâmetros string
                    $stmt->execute();
                    $stmt->close();
                } else {
                    $_SESSION['error_message'] = "Erro ao preparar a query: " . $con->error;
                }
            } else {
                $_SESSION['error_message'] = "Erro ao mover o arquivo para a pasta de upload.";
            }
        } else {
            $_SESSION['error_message'] = "Erro no upload do arquivo: " . $arquivo['error'];
        }
    }

    $_SESSION['mensagem'] = "Documentos reenviados com sucesso!";
}

// Obter documentos reprovados do cliente
$stmt = $con->prepare("SELECT * FROM documentos WHERE Id_cliente = ?");
if ($stmt) {
    $stmt->bind_param('s', $id_cliente); // Usar 's' para string
    $stmt->execute();
    $result = $stmt->get_result();
    $documentos = $result->fetch_assoc();
    $stmt->close();
} else {
    $_SESSION['error_message'] = "Erro ao preparar a consulta: " . $con->error;
}
$con->close();
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
    
    <header class="custom-header">
        <!-- Menu Toggle e Logo à esquerda -->
        <div class="logo">
            <a href="javascript:void(0);" class="menu-icon" onclick="toggleMenu()">&#9776;</a>
            <a href="pgi.php"><img src="imgs/endless3DsemFundo.png" alt="ENDLESS IMOBILIÁRIA" class="header-logo"></a>
        </div>

        <!-- Menu Responsivo -->
        <div id="menu-links" class="menu-links">
            <!-- Ícone de fechar -->
            <a href="javascript:void(0);" class="close-menu" onclick="toggleMenu()">&#10006;</a>
            <a href="pgi.php">Empreendimentos</a>
            <a href="clientes.php">CRM</a>
            <a href="perfil.php"><img src="imgs/user.png" alt="perfil" class="user-logo">Perfil</a>
        </div>
    </header>

    <div class="container-docs">
        <h2>Documentos ausentes</h2>
        <p>Enviar somente os documentos informados como reprovados</p>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_cliente" value="<?php echo htmlspecialchars($id_cliente); ?>">

            <?php
            // Lista dos documentos para reenviar (apenas os campos nulos)
            foreach ($documentos as $campo => $valor) {
                if ($valor === null) { // Exibe somente os campos vazios
                    echo '<div class="form-group">';
                    echo '<label>' . htmlspecialchars($campo) . ':</label>';
                    echo '<input type="file" name="' . htmlspecialchars($campo) . '" class="form-control">';
                    echo '</div>';
                }
            }
            ?>

            <button type="submit" class="btn btn-primary">Enviar Documentos</button>
        </form>
    </div>

    <div class="text-center" style="margin-top: 20px;">
        <a href="clientes.php" class="btn btn-secondary">Voltar</a>
    </div>


    <?php if (isset($_SESSION['mensagem'])): ?>
        <div class="alert alert-success mt-3">
            <?php echo $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?>
        </div>
    <?php endif; ?>

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
