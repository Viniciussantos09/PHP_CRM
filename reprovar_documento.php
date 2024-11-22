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

// Verifica se os parâmetros foram enviados
$id_cliente = isset($_POST['id_cliente']) ? $_POST['id_cliente'] : null; // Não usar intval para string
$documento = isset($_POST['documento']) ? $_POST['documento'] : null;

if ($id_cliente && $documento) {
    // Cria a consulta SQL para definir o campo do documento como NULL
    $query = "UPDATE documentos SET $documento = NULL WHERE Id_cliente = ?";
    $stmt = $con->prepare($query);
    
    if ($stmt === false) {
        $_SESSION['mensagem'] = "Erro ao preparar a consulta SQL.";
        header("Location: ver_documentacao.php?cliente_id=" . $id_cliente);
        exit;
    }

    $stmt->bind_param('s', $id_cliente); // Usar 's' para string

    if ($stmt->execute()) {
        // Atualiza o estágio do cliente para "Reprovado"
        $estagio_reprovado = 6; // Considerando que o ID do estágio "Reprovado" é 6
        $update_estagio_query = "UPDATE cliente SET Estagio = ? WHERE Id_cliente = ?";
        $stmt_estagio = $con->prepare($update_estagio_query);

        if ($stmt_estagio === false) {
            $_SESSION['mensagem'] = "Erro ao preparar a consulta para atualizar o estágio.";
            $stmt->close();
            header("Location: ver_documentacao.php?cliente_id=" . $id_cliente);
            exit;
        }

        $stmt_estagio->bind_param('is', $estagio_reprovado, $id_cliente); // 'i' para inteiro e 's' para string
        
        if ($stmt_estagio->execute()) {
            $_SESSION['mensagem'] = "Documento reprovado e removido com sucesso. Estágio do cliente alterado para 'Reprovado'.";
        } else {
            $_SESSION['mensagem'] = "Documento reprovado, mas não foi possível atualizar o estágio do cliente.";
        }

        $stmt_estagio->close();
    } else {
        $_SESSION['mensagem'] = "Erro ao reprovar o documento.";
    }

    $stmt->close();
} else {
    $_SESSION['mensagem'] = "Dados insuficientes para reprovar o documento.";
}

// Redireciona de volta para a página de documentos do cliente
header("Location: ver_documentacao.php?cliente_id=" . $id_cliente);
exit;
?>
