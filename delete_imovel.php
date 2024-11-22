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

// Obtém e valida o ID do imóvel
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Verifica se o ID é válido
if ($id <= 0) {
    echo "ID de imóvel inválido.";
    exit;
}

// Começa uma transação
mysqli_begin_transaction($con);

try {
    // Prepara a consulta para excluir imagens associadas
    $queryDeleteImages = "DELETE FROM imagensimovel WHERE IdImovel = ?";
    $stmtDeleteImages = mysqli_prepare($con, $queryDeleteImages);
    if (!$stmtDeleteImages) {
        throw new Exception("Erro ao preparar a consulta de exclusão de imagens: " . mysqli_error($con));
    }
    mysqli_stmt_bind_param($stmtDeleteImages, "i", $id);
    if (!mysqli_stmt_execute($stmtDeleteImages)) {
        throw new Exception("Erro ao excluir imagens: " . mysqli_stmt_error($stmtDeleteImages));
    }
    mysqli_stmt_close($stmtDeleteImages);

    // Prepara a consulta para excluir a imagem principal
    $queryDeleteMainImage = "DELETE FROM imagemprincipal WHERE IdImovel = ?";
    $stmtDeleteMainImage = mysqli_prepare($con, $queryDeleteMainImage);
    if (!$stmtDeleteMainImage) {
        throw new Exception("Erro ao preparar a consulta de exclusão da imagem principal: " . mysqli_error($con));
    }
    mysqli_stmt_bind_param($stmtDeleteMainImage, "i", $id);
    if (!mysqli_stmt_execute($stmtDeleteMainImage)) {
        throw new Exception("Erro ao excluir a imagem principal: " . mysqli_stmt_error($stmtDeleteMainImage));
    }
    mysqli_stmt_close($stmtDeleteMainImage);

    // Prepara a consulta para excluir o imóvel
    $queryDeleteImovel = "DELETE FROM cadimovel WHERE IdImovel = ?";
    $stmtDeleteImovel = mysqli_prepare($con, $queryDeleteImovel);
    if (!$stmtDeleteImovel) {
        throw new Exception("Erro ao preparar a consulta de exclusão do imóvel: " . mysqli_error($con));
    }
    mysqli_stmt_bind_param($stmtDeleteImovel, "i", $id);
    if (!mysqli_stmt_execute($stmtDeleteImovel)) {
        throw new Exception("Erro ao excluir o imóvel: " . mysqli_stmt_error($stmtDeleteImovel));
    }
    mysqli_stmt_close($stmtDeleteImovel);

    // Commit da transação
    mysqli_commit($con);

    // Redireciona após a exclusão
    header("Location: edit_imoveis.php");
    exit;
} catch (Exception $e) {
    // Rollback em caso de erro
    mysqli_rollback($con);
    echo $e->getMessage();
}

// Fecha a conexão
mysqli_close($con);
?>
