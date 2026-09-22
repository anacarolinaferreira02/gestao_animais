<?php

require_once "config/auth.php";

verificarLogin();

require_once "config/conexao.php";

$totalAnimais = $pdo
    ->query("SELECT COUNT(*) FROM animais")
    ->fetchColumn();

$totalPerdidos = $pdo
    ->query("SELECT COUNT(*) FROM animais WHERE status = 'Perdido'")
    ->fetchColumn();

$totalEncontrados = $pdo
    ->query("SELECT COUNT(*) FROM animais WHERE status = 'Encontrado'")
    ->fetchColumn();

$totalAdocao = $pdo
    ->query("SELECT COUNT(*) FROM animais WHERE status = 'Disponível para adoção'")
    ->fetchColumn();

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Minha Patinha</title>

</head>

<body>
<nav class="main-nav">

    <a href="dashboard.php">
        🏠 Início
    </a>

    <a href="mapa/index.php">
        🗺️ Mapa
    </a>

    <a href="animais/index.php">
        🐾 Animais
    </a>

    <a href="ocorrencias/index.php">
        🚨 Ocorrências
    </a>

    <?php if (isset($_SESSION["usuario_tipo"]) && $_SESSION["usuario_tipo"] === "admin"): ?>

        <a href="admin/index.php" class="admin-button">
            ⚙️ Painel Admin
        </a>

    <?php endif; ?>

    <a href="logout.php">
        🚪 Sair
    </a>

</nav>
</body>

</html>