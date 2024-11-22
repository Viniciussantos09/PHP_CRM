<?php
session_start();
require('conexao.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Obtém o ID do cliente
$id_cliente = $_GET['id'];
$cliente = null;

// Busca os dados do cliente
if ($id_cliente) {
    $query = $con->prepare("SELECT * FROM cliente WHERE Id_cliente = ?");
    $query->bind_param('s', $id_cliente);
    $query->execute();
    $result = $query->get_result();
    $cliente = $result->fetch_assoc();
}

// Busca os imóveis disponíveis (não será utilizado para edição, apenas para visualização)
$imoveis = [];
$query = $con->query("SELECT IdImovel, NomeImovel FROM cadimovel");
if ($query) {
    $imoveis = $query->fetch_all(MYSQLI_ASSOC);
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
<body style="margin-top: 145px;">

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
        </div>
    </header>

    <div class="container-user">
        <h1>Informações do Cliente</h1>
        <div class="form-group">
            <label>Nome Completo:</label>
            <p><?php echo htmlspecialchars($cliente['Nome_Completo']); ?></p>
        </div>
        <div class="form-group">
            <label>Telefone Celular:</label>
            <p><?php echo htmlspecialchars($cliente['Telefone']); ?></p>
        </div>
        <div class="form-group">
            <label>E-mail:</label>
            <p><?php echo htmlspecialchars($cliente['E_MAIL']); ?></p>
        </div>
        <div class="form-group">
            <label>Empreendimento:</label>
            <p>
                <?php
                $imovel_nome = '';
                foreach ($imoveis as $imovel) {
                    if ($imovel['IdImovel'] == $cliente['IdImovel']) {
                        $imovel_nome = $imovel['NomeImovel'];
                        break;
                    }
                }
                echo htmlspecialchars($imovel_nome);
                ?>
            </p>
        </div>
        <div class="form-group">
            <label>Descrição:</label>
            <p><?php echo nl2br(htmlspecialchars($cliente['Descricao'])); ?></p>
        </div>
        <div class="form-group">
            <label>Estágio:</label>
            <p>
                <?php
                $estagio_nome = '';
                switch ($cliente['Estagio']) {
                    case 1: $estagio_nome = 'Prospecção'; break;
                    case 2: $estagio_nome = 'Agendamento'; break;
                    case 3: $estagio_nome = 'Atendimento'; break;
                    case 4: $estagio_nome = 'Documentação'; break;
                    case 5: $estagio_nome = 'Análise'; break;
                    case 6: $estagio_nome = 'Reprovado'; break;
                    case 7: $estagio_nome = 'Aprovado'; break;
                    case 8: $estagio_nome = 'Venda'; break;
                    case 9: $estagio_nome = 'Descarte'; break;
                    case 10: $estagio_nome = 'Remarketing'; break;
                    default: $estagio_nome = 'Não definido'; break;
                }
                echo htmlspecialchars($estagio_nome);
                ?>
            </p>
        </div>
        <a href="clientes.php" class="btn btn-secondary">Voltar</a>
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
