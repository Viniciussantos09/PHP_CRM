<?php
session_start();
require('conexao.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $stmt = $con->prepare("DELETE FROM orcamentos WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
    
    header('Location: index.php');
    exit();
}
?>
