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

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<header class="public-header">

    <div class="public-logo">
        🐾 Minha Patinha
    </div>

    <nav>

        <a href="dashboard.php" class="active">
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

            <a href="admin/index.php" style="background:#2563eb;color:white;padding:6px 12px;border-radius:8px;font-weight:bold;">
                ⚙️ Painel Admin
            </a>

        <?php endif; ?>

        <a href="logout.php">
            🚪 Sair
        </a>

    </nav>

</header>

<main class="map-page" style="max-width:1100px;margin:35px auto;padding:0 20px;">

    <div style="background:white;padding:30px;border-radius:16px;box-shadow:0 5px 20px rgba(0,0,0,.05);margin-bottom:30px;">
        <h1 style="margin:0 0 10px 0;font-size:28px;">
            👋 Olá, <?= htmlspecialchars($_SESSION["usuario_nome"] ?? "Usuário") ?>!
        </h1>

        <p style="margin:0;color:#64748b;font-size:16px;">
            Bem-vindo ao sistema Minha Patinha. Acompanhe abaixo o resumo das ocorrências e animais em tempo real.
        </p>
    </div>

    <div class="stats-grid">

        <div class="stat-card blue">

            <div class="stat-icon">
                🐕
            </div>

            <div>
                <span>Total de Animais</span>
                <strong><?= $totalAnimais ?></strong>
            </div>

        </div>

        <div class="stat-card red">

            <div class="stat-icon">
                🔎
            </div>

            <div>
                <span>Animais Perdidos</span>
                <strong><?= $totalPerdidos ?></strong>
            </div>

        </div>

        <div class="stat-card orange">

            <div class="stat-icon">
                📍
            </div>

            <div>
                <span>Animais Encontrados</span>
                <strong><?= $totalEncontrados ?></strong>
            </div>

        </div>

        <div class="stat-card green">

            <div class="stat-icon">
                🏡
            </div>

            <div>
                <span>Para Adoção</span>
                <strong><?= $totalAdocao ?></strong>
            </div>

        </div>

    </div>

    <div style="margin-top:35px;display:flex;gap:15px;flex-wrap:wrap;">

        <a href="mapa/index.php" style="display:inline-block;padding:14px 24px;background:#2563eb;color:white;border-radius:10px;text-decoration:none;font-weight:bold;box-shadow:0 4px 12px rgba(37,99,235,.3);">
            🗺️ Abrir Mapa Interativo
        </a>

        <a href="ocorrencias/cadastrar.php" style="display:inline-block;padding:14px 24px;background:#ea580c;color:white;border-radius:10px;text-decoration:none;font-weight:bold;box-shadow:0 4px 12px rgba(234,88,12,.3);">
            🚨 Registrar Nova Ocorrência
        </a>

        <?php if (isset($_SESSION["usuario_tipo"]) && $_SESSION["usuario_tipo"] === "admin"): ?>

            <a href="admin/index.php" style="display:inline-block;padding:14px 24px;background:#0f172a;color:white;border-radius:10px;text-decoration:none;font-weight:bold;">
                ⚙️ Gerenciar Painel Admin
            </a>

        <?php endif; ?>

    </div>

</main>

</body>

</html>