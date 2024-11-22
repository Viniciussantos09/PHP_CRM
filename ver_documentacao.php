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

if (isset($_SESSION['mensagem'])): ?>
    <div class="alert alert-info">
        <?php echo $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?>
    </div>
<?php endif;

// Captura o idUser da sessão
$id_user = $_SESSION['user_id'];

// Verifica se o ID do cliente foi fornecido
$id_cliente = isset($_GET['cliente_id']) ? $_GET['cliente_id'] : null;

$nome_cliente = '';

// Verifica se o cliente_id foi fornecido e existe
if ($id_cliente) {
    // Prepara a consulta para buscar o nome do cliente
    $stmt = $con->prepare("SELECT c.Nome_Completo
                           FROM documentos d
                           JOIN cliente c ON d.Id_cliente = c.Id_cliente
                           WHERE d.Id_cliente = ?");
    
    if ($stmt === false) {
        die('Erro na preparação da consulta SQL: ' . $con->error);
    }
    $stmt->bind_param('s', $id_cliente);
    $stmt->execute();
    $stmt->bind_result($nome_cliente);
    $stmt->fetch();
    $stmt->close();
    if (!$nome_cliente) {
        echo "Cliente não encontrado.";
        exit;
    }
} else {
    header("Location: ver_documentacao.php");
    exit;
}

// Recupera os documentos do cliente selecionado
$documentos = [];
$stmt = $con->prepare("SELECT * FROM documentos WHERE Id_cliente = ?");
$stmt->bind_param('s', $id_cliente); // Ajustado para string
$stmt->execute();
$result = $stmt->get_result();
$documentos = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
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

<div class="container mt-4">
    <h1>Documentos do Cliente</h1>

    <?php if (!empty($documentos)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome do Documento</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Lista dos campos de documentos com os nomes amigáveis
                $documentFields = [
                    'RG_CPF' => 'RG/CPF',
                    'Carteira_Trabalho' => 'Carteira de Trabalho',
                    'Certidao_Casamento_Nascimento' => 'Certidão de Casamento/Nascimento',
                    'Holerites' => 'Holerites',
                    'Comprovante_Residencia' => 'Comprovante de Residência',
                    'FGTS' => 'FGTS',
                    'Imposto_Renda' => 'Imposto de Renda',
                    'Ficha_COHAB' => 'Ficha COHAB',
                    'Ficha_MOP' => 'Ficha MOP',
                    'Ficha_Cadastral' => 'Ficha Cadastral',
                    'RG_CPF_prop' => 'RG/CPF do Proponente',
                    'Carteira_Trabalho_prop' => 'Carteira de Trabalho do Proponente',
                    'Holerites_prop' => 'Holerites do Proponente',
                    'FGTS_prop' => 'FGTS do Proponente',
                    'Imposto_Renda_prop' => 'Imposto de Renda do Proponente',
                    'Dependente' => 'Dependente',
                    'outros_I' => 'Outros Documentos I',
                    'outros_II' => 'Outros Documentos II'
                ];

                // Iterando sobre os campos para gerar a lista de documentos
                foreach ($documentFields as $field => $label): ?>
                    <tr>
                        <td><?php echo $label; ?></td>
                        <td>
                            <?php if (!empty($documentos[0][$field])): ?>
                                <!-- Link para download com nome do cliente e nome do documento -->
                                <a href="<?php echo htmlspecialchars($documentos[0][$field]); ?>" 
                                download="<?php echo htmlspecialchars($label . ' - ' . $nome_cliente); ?>.pdf" 
                                class="btn btn-primary">Baixar</a>

                                <form action="reprovar_documento.php" method="post" class="d-inline">
                                    <input type="hidden" name="id_cliente" value="<?php echo htmlspecialchars($id_cliente); ?>">
                                    <input type="hidden" name="documento" value="<?php echo htmlspecialchars($field); ?>">
                                    <button type="submit" class="btn btn-danger">Reprovar</button>
                                </form>
                            <?php else: ?>
                                <span class="text-muted">Documento não disponível</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum documento encontrado para este cliente.</p>
    <?php endif; ?>

    <a href="clientes_docs.php" class="btn btn-secondary">Voltar</a>
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
