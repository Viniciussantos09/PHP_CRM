<?php
session_start();
require('conexao.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['IdImovel'])) {
    $IdImovel = $con->real_escape_string($_GET['IdImovel']);

    // Consulta SQL para obter os detalhes do imóvel junto com a imagem principal e o book
    $sql = "SELECT cadimovel.IdImovel, cadimovel.NomeImovel, cadimovel.Estado, cadimovel.Cidade, cadimovel.Bairro, cadimovel.Estagio, cadimovel.Tipo, cadimovel.Preco, cadimovel.Area, cadimovel.Descricao, imagemprincipal.path AS imagemPrincipal, book.path AS bookPath
            FROM cadimovel
            INNER JOIN imagemprincipal ON cadimovel.IdImovel = imagemprincipal.IdImovel
            LEFT JOIN book ON cadimovel.IdImovel = book.IdImovel
            WHERE cadimovel.IdImovel = $IdImovel";

    $result = $con->query($sql);

    // Verifique se a consulta falhou
    if (!$result) {
        die("Erro na consulta SQL: " . $con->error);
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<p>Imóvel não encontrado.</p>";
        exit();
    }

    // Consulta SQL para obter as imagens do imóvel
    $sql_images = "SELECT path FROM imagensimovel WHERE IdImovel = $IdImovel";
    $result_images = $con->query($sql_images);

    if (!$result_images) {
        die("Erro na consulta SQL para imagens: " . $con->error);
    }

} else {
    echo "<p>ID do imóvel não foi fornecido.</p>";
    exit();
}

// Fecha a conexão com o banco de dados
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
<body>
    
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

    <div class="carousel-fluid">
        <div class="carousel-fluid__list carousel-fluid__list--center">
            <?php
            if ($result_images->num_rows > 0) {
                while ($image = $result_images->fetch_assoc()) {
                    echo '<img src="' . $image['path'] . '" class="carousel-fluid__image" alt="Imagem do Imóvel">';
                }
            } else {
                echo '<img src="' . $row['imagemPrincipal'] . '" class="carousel-fluid__image" alt="Imagem Principal do Imóvel">';
            }
            ?>
        </div>
        <button class="carousel-fluid__button carousel-fluid__button--prev" onclick="scrollCarousel(-1)">
            <span class="carousel-fluid__icon">‹</span>
        </button>
        <button class="carousel-fluid__button carousel-fluid__button--next" onclick="scrollCarousel(1)">
            <span class="carousel-fluid__icon">›</span>
        </button>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="property-details">
                <h2><?php echo htmlspecialchars($row['NomeImovel']); ?></h2>
                <p><strong>Localização:</strong> <?php echo htmlspecialchars($row['Estado'] . ', ' . $row['Cidade'] . ', ' . $row['Bairro']); ?></p>
                <p><strong>Preço:</strong> R$ <?php echo number_format($row['Preco'], 2, ',', '.'); ?></p>
                <p><strong>Área:</strong> <?php echo htmlspecialchars($row['Area']); ?> m²</p>
                <p><strong>Estágio:</strong> <?php echo htmlspecialchars($row['Estagio']); ?></p>
                <p><strong>Descrição:</strong> <?php echo htmlspecialchars($row['Descricao']); ?></p>

                <?php
                // Lógica para exibir o botão de download do PDF, caso o arquivo esteja disponível
                $bookFilePath = $row['bookPath']; // Caminho do arquivo PDF no banco de dados

                if (!empty($bookFilePath) && file_exists($bookFilePath)) {
                    echo '<div class="download-section">';
                    echo '<h3>Book:</h3>';
                    echo '<a href="' . $bookFilePath . '" class="btn btn-primary" download>Baixar Book</a>'; // Link para download do PDF
                    echo '</div>';
                } else {
                    echo '<p style="margin-top: 60px;"><strong>Nenhum documento disponível para download.</strong></p>';
                }
                ?>
            </div>
        </div>
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
