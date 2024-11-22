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

require('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emailUser = trim($_POST['emailUser']);
    $senhaUser = password_hash($_POST['senhaUser'], PASSWORD_DEFAULT);
    $nomeCompleto = trim($_POST['nomeCompleto']);
    $cargo = trim($_POST['cargo']);
    $dataUpload = date("Y-m-d H:i:s");

    // Insere o novo usuário no banco de dados
    $stmt = $con->prepare("INSERT INTO usuarios (EmailUser, SenhaUser, NomeCompleto, cargo, data_upload) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $emailUser, $senhaUser, $nomeCompleto, $cargo, $dataUpload);

    if ($stmt->execute()) {
        $sucesso = "Usuário cadastrado com sucesso!";
    } else {
        $erro = "Erro ao cadastrar usuário: " . $stmt->error;
    }
    $stmt->close();
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
<body style="margin-top: 125px;">

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

    <div class="topo_crm">
        <h1>Inserir Usuários:</h1>
    </div>

        <div class="container-docs">

        <?php if (isset($sucesso)): ?>
            <div class="alert alert-success text-center"><?php echo $sucesso; ?></div>
        <?php elseif (isset($erro)): ?>
            <div class="alert alert-danger text-center"><?php echo $erro; ?></div>
        <?php endif; ?>

        <h2 style="margin-bottom: 30px;">Adicionar usuário</h2>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="nomeCompleto" class="form-label">Nome Completo</label>
                <input type="text" class="form-control" id="nomeCompleto" name="nomeCompleto" placeholder="Nome Completo" required>
            </div>
            <div class="mb-3">
                <label for="emailUser" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="emailUser" name="emailUser" placeholder="usuario@email.com" required>
            </div>
            <div class="mb-3">
                <label for="senhaUser" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senhaUser" name="senhaUser" placeholder="Senha" required>
            </div>
            <div class="mb-4">
                <label for="cargo" class="form-label">Cargo</label>
                <select class="form-select" id="cargo" name="cargo" required>
                    <option selected disabled>Selecione o cargo</option>
                    <option value="Corretor">Corretor</option>
                    <option value="Administrador">Administrador</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar Usuário</button>
        </form>
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
