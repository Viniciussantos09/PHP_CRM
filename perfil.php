<?php
session_start(); // Inicia a sessão
require("conexao.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php"); // Redireciona para a página de login se não estiver logado
    exit;
}

// Obtém o ID do usuário da sessão
$user_id = $_SESSION['user_id']; // Supondo que você armazena o ID do usuário na sessão

$query = "SELECT * FROM usuarios WHERE idUser = '$user_id'";
$result = mysqli_query($con, $query);

// Verificar se a consulta foi bem-sucedida
if (!$result) {
    die("Erro na consulta: " . mysqli_error($con));
}

// Verificar se os dados do usuário foram encontrados
if (mysqli_num_rows($result) > 0) {
    $user_data = mysqli_fetch_assoc($result);
} else {
    echo "Usuário não encontrado.";
    exit;
}

// Atualizar senha e imagem do usuário
if (isset($_POST['submit'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validação das senhas
    if ($new_password != $confirm_password) {
        echo "As senhas não coincidem.";
    } else {
        // Criptografar a nova senha
        $senha = password_hash($new_password, PASSWORD_DEFAULT);

        // Atualizar senha no banco de dados
        $query = "UPDATE usuarios SET SenhaUser = '$senha' WHERE idUser = '$user_id'";
        if (mysqli_query($con, $query)) {
            echo "Senha atualizada com sucesso.";
        } else {
            echo "Erro ao atualizar a senha: " . mysqli_error($con);
        }
    }
}
if (isset($_POST['upload_image']) && isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
    $imagemPrincipal = $_FILES['profile_image'];
    $pasta = "arquivos/";
    $nomeDoArquivo = $imagemPrincipal['name'];
    $novoNomeDoArquivo = uniqid();
    $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

    // Validar extensão do arquivo
    if ($extensao != "jpg" && $extensao != "png") {
        echo "Tipo de arquivo não aceito: $nomeDoArquivo";
    } else {
        $path = $pasta . $novoNomeDoArquivo . "." . $extensao;
        $deu_certo = move_uploaded_file($imagemPrincipal["tmp_name"], $path);
        if (!$deu_certo) {
            echo "Falha ao enviar arquivo: $nomeDoArquivo";
        } else {
            // Atualizar o caminho da imagem no banco de dados
            $query_imagem = "UPDATE usuarios SET path = '$path', nomeFoto = '$nomeDoArquivo' WHERE idUser = '$user_id'";
            if (!mysqli_query($con, $query_imagem)) {
                echo 'Erro ao cadastrar imagem: ' . mysqli_error($con);
            } else {
                // Redireciona para a página de perfil após o upload
                header("Location: perfil.php");
                exit;
            }
        }
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
    <script>
        function toggleImageUpload() {
            const uploadDiv = document.getElementById('uploadDiv');
            uploadDiv.style.display = uploadDiv.style.display === 'none' ? 'block' : 'none';
        }

        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('imagePreview');
                output.src = reader.result;
                document.getElementById('fileName').textContent = file.name;
            };
            reader.readAsDataURL(file);
        }
    </script>
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
        </div>
    </header>

    <div class="container-user">
        <form method="POST" enctype="multipart/form-data" class="profile-form">
            <h1><strong>PERFIL</strong></h1>

            <div class="profile-image">
                <img id="imagePreview" src="<?php echo htmlspecialchars($user_data['path']); ?>" alt="Imagem de perfil" style="max-width: 200px; max-height: 200px;">
            </div>

            <button type="button" class="btn btn-primary btn-sm m-2" onclick="toggleImageUpload()">Alterar Foto</button>

            <!-- Div oculta para upload de imagem -->
            <div id="uploadDiv" style="display: none;">
                <label for="profile_image">Selecione a nova imagem de perfil</label>
                <input type="file" id="profile_image" name="profile_image" accept="image/*" onchange="previewImage(event)">
                <p id="fileName"></p>
                <button type="submit" name="upload_image" class="btn btn-secondary btn-sm mt-2">Confirmar</button>
            </div>

            <div class="form-group">
                <label for="name">Nome completo</label>
                <p class="form-control"><?php echo htmlspecialchars($user_data['NomeCompleto']); ?></p>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <p class="form-control"><?php echo htmlspecialchars($user_data['EmailUser']); ?></p>
            </div>

            <div class="form-group">
                <label for="cargo">Cargo</label>
                <p class="form-control"><?php echo htmlspecialchars($user_data['cargo']); ?></p>
            </div>

            <div class="form-group">
                <label for="new_password">Nova Senha</label>
                <input type="password" class="form-control" id="new_password" name="new_password">
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirmar nova senha</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            </div>

            <div class="mt-3">
                <button type="submit" name="submit" class="btn btn-warning">Salvar</button>
            </div>
        </form>
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
