<?php
session_start();
require('conexao.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Verifica o cargo do usuário
$cargo = $_SESSION['cargo'] ?? '';

// Definindo os estágios de acordo com o cargo
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

// Ajustar estágios visíveis para o cargo "Corretor"
if ($cargo === "Corretor") {
    unset($estagios["Análise"], $estagios["Reprovado"], $estagios["Aprovado"]);
}

// Processa o formulário de atualização do cliente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cliente = $_POST['id_cliente']; // Agora é string
    $nome_completo = $_POST['nome_completo'];
    $telefone_celular = $_POST['telefone_celular'];
    $email = $_POST['email'];
    $descricao = $_POST['descricao'] ?? ''; 
    $estagio = (int) $_POST['estagio'];
    $id_imovel = (int) $_POST['id_imovel'];

    $stmt = $con->prepare("UPDATE cliente SET Nome_Completo = ?, Telefone = ?, E_MAIL = ?, Descricao = ?, Estagio = ?, IdImovel = ? WHERE Id_cliente = ?");
    
    if (!$stmt) {
        die("Erro na preparação da consulta: " . $con->error);
    }

    // Ajuste: Id_cliente é string, então o tipo correspondente no bind_param é 's'
    $stmt->bind_param('ssssiss', $nome_completo, $telefone_celular, $email, $descricao, $estagio, $id_imovel, $id_cliente);

    if ($stmt->execute()) {
        $stmt->close();
        
        if ($estagio === 4) {  // Estágio "Documentação"
            header('Location: documentos.php?id_cliente=' . $id_cliente);
            exit();
        } else {
            header('Location: clientes.php');
            exit();
        }
    } else {
        echo "Erro ao executar a consulta: " . $stmt->error;
    }
}

// Obtém o ID do cliente a ser atualizado
$id_cliente = $_GET['id'] ?? '';
$cliente = null;

// Busca os dados do cliente
if ($id_cliente) {
    $query = $con->prepare("SELECT * FROM cliente WHERE Id_cliente = ?");
    $query->bind_param('s', $id_cliente); // Ajuste: Id_cliente é string
    $query->execute();
    $result = $query->get_result();
    $cliente = $result->fetch_assoc();
}

// Busca os imóveis disponíveis
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
        <h1>Atualizar Cliente</h1>
        <form method="POST">
            <input type="hidden" name="id_cliente" value="<?php echo htmlspecialchars($cliente['Id_cliente']); ?>">

            <div class="form-group">
                <label for="nome_completo">Nome Completo:</label>
                <input type="text" id="nome_completo" name="nome_completo" class="form-control" 
                       value="<?php echo htmlspecialchars($cliente['Nome_Completo']); ?>" required>
            </div>
            <div class="form-group">
                <label for="telefone_celular">Telefone Celular:</label>
                <input type="text" id="telefone_celular" name="telefone_celular" class="form-control" 
                       value="<?php echo htmlspecialchars($cliente['Telefone']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control" 
                       value="<?php echo htmlspecialchars($cliente['E_MAIL']); ?>" required>
            </div>
            <div class="form-group">
                <label for="id_imovel">Nome do Imóvel:</label>
                <select id="id_imovel" name="id_imovel" class="form-control" required>
                    <option value="">Selecione um Imóvel</option>
                    <?php foreach ($imoveis as $imovel): ?>
                        <option value="<?php echo htmlspecialchars($imovel['IdImovel']); ?>" 
                            <?php echo ($imovel['IdImovel'] == $cliente['IdImovel']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($imovel['NomeImovel']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" class="form-control" rows="4" required><?php echo htmlspecialchars($cliente['Descricao']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="estagio">Estágio:</label>
                <select id="estagio" name="estagio" class="form-control" required>
                    <option value="">Selecione o Estágio</option>
                    <?php foreach ($estagios as $nome => $numero): ?>
                        <option value="<?php echo htmlspecialchars($numero); ?>"
                            <?php echo ($numero == $cliente['Estagio']) ? 'selected' : ''; ?>>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
