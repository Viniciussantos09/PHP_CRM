<?php
session_start();
require('conexao.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Captura o idUser e o cargo do usuário logado
$idUser = $_SESSION['user_id'];
$cargo = $_SESSION['cargo']; // Certifique-se de que o cargo está armazenado na sessão

function generateUniqueId($length = 16) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $Id_cliente = generateUniqueId();
    $nome_completo = trim($_POST['nome_completo']);
    $telefone_celular = trim($_POST['telefone_celular']);
    $email = trim($_POST['email']);
    $descricao = trim($_POST['descricao']);
    $estagio = intval($_POST['estagio']);
    $id_imovel = intval($_POST['id_imovel']);

    // Valida os dados obrigatórios
    if ($nome_completo && $telefone_celular && $email && $descricao && $estagio && $id_imovel) {
        $stmt = $con->prepare("INSERT INTO cliente (Id_cliente, idUser, Nome_Completo, Telefone, E_MAIL, Descricao, Estagio, IdImovel) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param('sisssssi', $Id_cliente, $idUser, $nome_completo, $telefone_celular, $email, $descricao, $estagio, $id_imovel);
            if ($stmt->execute()) {
                $stmt->close();
                header('Location: clientes.php');
                exit;
            } else {
                echo "Erro ao executar a consulta: " . $stmt->error;
            }
        } else {
            echo "Erro na preparação da consulta: " . $con->error;
        }
    } else {
        echo "Por favor, preencha todos os campos obrigatórios.";
    }
}

// Busca os imóveis disponíveis
$imoveis = [];
$query = $con->query("SELECT IdImovel, NomeImovel FROM cadimovel");
if ($query) {
    $imoveis = $query->fetch_all(MYSQLI_ASSOC);
}

// Define os estágios e oculta alguns se o cargo for "Corretor"
$estagios = [
    "Prospecção" => 1,
    "Agendamento" => 2,
    "Atendimento" => 3,
    "Documentação" => 4,
    "Análise" => 5,
    "Reprovado" => 6,
    "Aprovado" => 7,
    "Venda" => 8,
    "Descarte" => 9,
    "Remarketing" => 10,
];

if ($cargo === "Corretor") {
    unset($estagios["Análise"], $estagios["Reprovado"], $estagios["Aprovado"]);
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

    <div class="container mt-4">
        <h1>Criar Novo Cliente</h1>
        <form method="POST">
            <div class="form-group">
                <label for="nome_completo">Nome Completo:</label>
                <input type="text" id="nome_completo" name="nome_completo" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="telefone_celular">Telefone Celular:</label>
                <input type="text" id="telefone_celular" name="telefone_celular" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="id_imovel">Nome do Imóvel:</label>
                <select id="id_imovel" name="id_imovel" class="form-control" required>
                    <option value="">Selecione um Imóvel</option>
                    <?php foreach ($imoveis as $imovel): ?>
                        <option value="<?php echo htmlspecialchars($imovel['IdImovel']); ?>">
                            <?php echo htmlspecialchars($imovel['NomeImovel']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" class="form-control" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="estagio">Estágio:</label>
                <select id="estagio" name="estagio" class="form-control" required>
                    <option value="">Selecione o Estágio</option>
                    <?php foreach ($estagios as $nome => $numero): ?>
                        <option value="<?php echo htmlspecialchars($numero); ?>">
                            <?php echo htmlspecialchars($nome); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="clientes.php" class="btn btn-secondary">Voltar</a>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
