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

// Estágios disponíveis
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

// Recuperar todos os usuários
$usuarios = [];
$stmt = $con->prepare("SELECT idUser, NomeCompleto FROM usuarios");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $usuarios[] = $row;
}
$stmt->close();

// Verifica se um usuário foi selecionado
$idUsuarioSelecionado = isset($_GET['user_id']) ? intval($_GET['user_id']) : null;

// Verifica se um estágio foi selecionado
$estagioSelecionado = isset($_GET['estagio']) ? intval($_GET['estagio']) : null;

// Recupera os clientes do usuário selecionado no estágio especificado
$clientes = [];
if ($idUsuarioSelecionado && $estagioSelecionado) {
    $stmt = $con->prepare("SELECT * FROM cliente WHERE Estagio = ? AND idUser = ?");
    $stmt->bind_param('ii', $estagioSelecionado, $idUsuarioSelecionado); // O idUser é um inteiro
    $stmt->execute();
    $result = $stmt->get_result();
    $clientes = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

// Verifica se um botão de ação foi acionado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_cliente'])) {
    // A variável 'id_cliente' agora é tratada como uma string
    $id_cliente = $_POST['id_cliente']; // Não usamos intval, pois id_cliente é uma string
    $novoEstagio = null;

    // Verifica qual botão foi clicado e define o novo estágio
    if (isset($_POST['acao'])) {
        switch ($_POST['acao']) {
            case 'aprovado':
                $novoEstagio = 7; // 'Aprovado'
                break;
            case 'reprovado':
                $novoEstagio = 6; // 'Reprovado'
                break;
            case 'analise':
                $novoEstagio = 5; // 'Análise'
                break;
            default:
                $_SESSION['error_message'] = "Ação inválida.";
                header("Location: clientes.php");
                exit;
        }
    }

    // Atualiza o estágio do cliente, se um novo estágio foi definido
    if ($novoEstagio !== null) {
        // Para id_cliente ser uma string, usamos 's' no bind_param
        $stmt = $con->prepare("UPDATE cliente SET Estagio = ? WHERE Id_cliente = ?");
        $stmt->bind_param('is', $novoEstagio, $id_cliente); // 'i' para Estagio (inteiro) e 's' para Id_cliente (string)

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Cliente movido para o estágio " . $estagios[$novoEstagio] . " com sucesso!";
        } else {
            $_SESSION['error_message'] = "Erro ao mover cliente: " . $stmt->error;
        }
        $stmt->close();
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
        <h1>Documentação de Clientes</h1>
        <form method="GET" class="mt-3">
            <select name="user_id" onchange="this.form.submit()">
                <option value="">Selecione um usuário</option>
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?php echo $usuario['idUser']; ?>" <?php echo $usuario['idUser'] == $idUsuarioSelecionado ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($usuario['NomeCompleto']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <select name="estagio" onchange="this.form.submit()">
                <option value="">Selecione o estágio</option>
                <?php foreach ($estagios as $codigo => $descricao): ?>
                    <option value="<?php echo $codigo; ?>" <?php echo $codigo == $estagioSelecionado ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($descricao); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>

    <div class="container mt-4">
        <?php if ($idUsuarioSelecionado && $estagioSelecionado): ?>
            <h3>Clientes no estágio: <?php echo htmlspecialchars($estagios[$estagioSelecionado]); ?></h3>
            <?php if (!empty($clientes)): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome Completo</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $cliente): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($cliente['Nome_Completo']); ?></td>
                                <td>
                                    <a href="ver_documentacao.php?cliente_id=<?php echo $cliente['Id_cliente']; ?>" class="btn btn-info">Ver Documentação</a>
                                    
                                    <?php if ($estagioSelecionado == 5): ?>
                                        <!-- Botões específicos para o estágio "Análise" -->
                                        <form method="POST" style="display:inline;">
                                            <input type="hidden" name="id_cliente" value="<?php echo $cliente['Id_cliente']; ?>">
                                            <button type="submit" name="acao" value="aprovado" class="btn btn-success">Aprovado</button>
                                            <button type="submit" name="acao" value="reprovado" class="btn btn-danger">Reprovado</button>
                                        </form>
                                    <?php else: ?>
                                        <!-- Botão "Análise" para mover o cliente para o estágio 5 -->
                                        <form method="POST" style="display:inline;">
                                            <input type="hidden" name="id_cliente" value="<?php echo $cliente['Id_cliente']; ?>">
                                            <button type="submit" name="acao" value="analise" class="btn btn-warning">Análise</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Nenhum cliente encontrado no estágio selecionado.</p>
            <?php endif; ?>
        <?php else: ?>
            <p>Selecione um usuário e um estágio para ver os clientes.</p>
        <?php endif; ?>
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

