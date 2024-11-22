<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pgi.css">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="imgs/cart.png">
</head>
<body>
    
    <header class="custom-header">
        <div class="logo">
            <a><img src="imgs/endless3DsemFundo.png" alt="ENDLESS IMOBILIÁRIA" class="header-logo"></a>
    </header>

    <div class="container-login">
        <h1 class="m-3">Login</h1>
        <p class="small">Informe o email e senha para entrar</p>

        <form action="" method="post" class="mt-5" id="loginForm">
            <div class="mb-5">
                <label for="email">
                    Email:
                    <br>
                    <input class="form-control" type="email" id="email" name="email" required>
                </label>
            </div>

            <div class="mb-5">
                <label for="senha">
                    Senha:
                    <br>
                    <input class="form-control" type="password" id="senha" name="senha" required>
                </label>
                <div class="mt-2">
                    <input type="checkbox" id="show-password">
                    <label for="show-password">Mostrar senha</label>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Entrar</button>
        </form>
    </div>

    <script>
        const showPasswordCheckbox = document.getElementById('show-password');
        const passwordInput = document.getElementById('senha');

        showPasswordCheckbox.addEventListener('change', function() {
            passwordInput.type = showPasswordCheckbox.checked ? 'text' : 'password';
        });
    </script>

<?php
session_start();
require('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Usando prepared statements para evitar SQL injection
    $query = "SELECT idUser, EmailUser, SenhaUser, Cargo FROM usuarios WHERE EmailUser = ? LIMIT 1";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        // Recupera os dados do usuário
        $user_data = mysqli_fetch_assoc($result);
        
        // Verifica a senha usando password_verify
        if (password_verify($senha, $user_data['SenhaUser'])) {
            // Armazena o ID, email e cargo do usuário na sessão
            $_SESSION['loggedin'] = true;
            $_SESSION['EmailUser'] = $user_data['EmailUser'];
            $_SESSION['user_id'] = $user_data['idUser']; // Armazena o ID do usuário
            $_SESSION['cargo'] = $user_data['Cargo'];    // Armazena o cargo do usuário

            // Redireciona para a página principal ou a página desejada após o login
            header("Location: pgi.php");
            exit;
        } else {
            echo "E-mail ou senha incorretos.";
        }
    } else {
        echo "E-mail ou senha incorretos.";
    }
}
?>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
