<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$cargo = $_SESSION['cargo'];
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
            
            <!-- Link para Administradores -->
            <?php if ($cargo === 'Administrador') : ?>
                <a href="administrador.php">Painel de Administração</a>
            <?php endif; ?>
        </div>
    </header>

    <form method="GET" action="pgi.php" id="search-form">
        <h2>Busque pela região ou empreendimento</h2>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <input type="search" name="search" class="form-control" placeholder="Digite o nome ou a cidade do imóvel">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </div>
    </form>

    <div class="text">
        <h2>Breves lançamentos</h2>
    </div>

    <div id="properties">
        <?php

        require('conexao.php');

        $search = isset($_GET['search']) ? $con->real_escape_string($_GET['search']) : '';

        // Construção da consulta SQL com filtro de busca
        $sql = "SELECT cadimovel.IdImovel, cadimovel.NomeImovel, cadimovel.Estado, cadimovel.Cidade, cadimovel.Bairro, cadimovel.Estagio, cadimovel.Tipo, cadimovel.Preco, cadimovel.Area, cadimovel.Descricao, imagemprincipal.path
                FROM cadimovel
                INNER JOIN imagemprincipal
                ON cadimovel.IdImovel = imagemprincipal.IdImovel
                WHERE cadimovel.NomeImovel LIKE '%$search%' OR cadimovel.Cidade LIKE '%$search%'";

        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="produto">';
                echo '<a href="http://localhost/crm/descImovel.php?IdImovel=' . $row["IdImovel"] . '" class="produto-link"></a>';
                echo '<img src="' . $row["path"] . '" alt="' . $row["NomeImovel"] . '" style="width: 200px; height: 200px;">';
                echo '<h3>' . $row["NomeImovel"] . '</h3>';
                echo '<p>Localização: ' . $row["Estado"] . ', ' . $row["Cidade"] . ', ' . $row["Bairro"] . '</p>';
                echo '<p>Preço: R$ ' . number_format($row["Preco"], 2, ',', '.') . '</p>';
                echo '<p>Área: ' . $row["Area"] . ' m²</p>';
                echo '<p>Estágio: ' . $row["Estagio"] . '</p>';
                echo '</div>';
            }
        } else {
            echo "<p>Nenhum imóvel encontrado para sua busca.</p>";
        }

        $con->close();
        
        ?>      
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
