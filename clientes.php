<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

require('conexao.php');

// Estágios definidos
$estagios = [
    1 => 'Prospecção',
    2 => 'Agendamento',
    3 => 'Atendimento',
    4 => 'Documentação',
    5 => 'Análise',
    6 => 'Reprovado',
    7 => 'Aprovado',
    8 => 'Venda',
    9 => 'Descarte',
    10 => 'Remarketing'
];


$clientes = [];
$userId = $_SESSION['user_id']; // Recupera o ID do usuário logado
foreach ($estagios as $estagio_id => $estagio_nome) {
    // Prepara a consulta SQL com JOIN, filtrando pelo idUser
    $stmt = $con->prepare("
        SELECT c.*, im.NomeImovel 
        FROM cliente c
        LEFT JOIN cadimovel im ON c.IdImovel = im.IdImovel 
        WHERE c.Estagio = ? AND c.idUser = ?"); // Adicionando a condição para filtrar pelo idUser
    $stmt->bind_param('is', $estagio_id, $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $clientes[$estagio_nome] = $result->fetch_all(MYSQLI_ASSOC);
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
            
        </div>
    </header>

    <div class="topo_crm">
        <h1>Gerenciamento de Clientes</h1>
        <nav>
            <a href="create.php" class="btn btn-primary">Adicionar Novo Cliente</a>
        </nav>
    </div>

    <div class="row">
        <?php foreach ($clientes as $estagio_nome => $lista_clientes): ?>
            <div class="col-md-2 mb-2">
                <div class="stage">
                    <h5><?php echo htmlspecialchars($estagio_nome); ?></h5>
                    <div class="client-container">
                        <?php if (!empty($lista_clientes)): ?>
                            <?php foreach ($lista_clientes as $index => $cliente): ?>
                                <div class="client">
                                    <strong>
                                        <?php echo htmlspecialchars($cliente['Nome_Completo']); ?>
                                        <a href="informacoes_cliente.php?id=<?php echo htmlspecialchars($cliente['Id_cliente']); ?>" title="Ver Informações">
                                            <i class="ion-eye" style="font-size: 1.4em; margin-left: 5px; color: #007bff;"></i>
                                        </a>
                                    </strong>
                                    
                                    <p>Telefone: <?php echo htmlspecialchars($cliente['Telefone']); ?></p>
                                    <a href="update.php?id=<?php echo htmlspecialchars($cliente['Id_cliente']); ?>" class="btn btn-warning btn-sm">Alterar Estágio
                                    <i class="ion-edit"></i> </a>
                                    
                                    <?php if ($estagio_nome === 'Reprovado'): ?>
                                        <a href="reenviar_documentos.php?id=<?php echo htmlspecialchars($cliente['Id_cliente']); ?>" class="btn btn-danger btn-sm">Enviar Documentos Reprovados</a>
                                    <?php endif; ?>
                                </div>
                                <?php if ($index < count($lista_clientes) - 1): ?>
                                    <hr class="divider">
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Nenhum cliente encontrado neste estágio.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
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

