<?php

require_once "../config/auth.php";
verificarAdmin();

require_once "../config/conexao.php";

$totalAnimais = $pdo
    ->query("SELECT COUNT(*) FROM animais")
    ->fetchColumn();

$totalUsuarios = $pdo
    ->query("SELECT COUNT(*) FROM usuarios")
    ->fetchColumn();

$pendentes = $pdo
    ->query("
        SELECT COUNT(*)
        FROM ocorrencias
        WHERE status_verificacao = 'Pendente'
    ")
    ->fetchColumn();

$aprovadas = $pdo
    ->query("
        SELECT COUNT(*)
        FROM ocorrencias
        WHERE status_verificacao = 'Aprovada'
    ")
    ->fetchColumn();

$rejeitadas = $pdo
    ->query("
        SELECT COUNT(*)
        FROM ocorrencias
        WHERE status_verificacao = 'Rejeitada'
    ")
    ->fetchColumn();

$perdidos = $pdo
    ->query("
        SELECT COUNT(*)
        FROM animais
        WHERE status = 'Perdido'
    ")
    ->fetchColumn();

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Painel Administrativo</title>

<link rel="stylesheet"
href="../assets/css/style.css">

</head>

<body>

<div class="admin-layout">

<aside class="sidebar">

<div class="brand">
🐾 Minha Patinha
</div>

<div class="admin-label">
PAINEL ADMINISTRATIVO
</div>

<nav>

<a href="index.php">
📊 Dashboard
</a>

<a href="animais.php">
🐕 Animais
</a>

<a href="ocorrencias.php">
🚨 Ocorrências
</a>

<a href="usuarios.php">
👥 Usuários
</a>

<a href="../mapa/index.php">
🗺️ Mapa
</a>

<a href="../dashboard.php">
🏠 Sistema
</a>

<a href="../logout.php">
🚪 Sair
</a>

</nav>

</aside>


<main class="admin-content">

<div class="topbar">

<div>

<h1>Painel Administrativo</h1>

<p>
Gerencie o sistema Minha Patinha.
</p>

</div>

<div class="admin-user">
👨‍💼
<?= htmlspecialchars($_SESSION["usuario_nome"]) ?>
</div>

</div>


<div class="stats-grid">

<div class="stat-card blue">

<div class="stat-icon">
🐕
</div>

<div>

<span>Animais</span>

<strong>
<?= $totalAnimais ?>
</strong>

</div>

</div>


<div class="stat-card orange">

<div class="stat-icon">
🚨
</div>

<div>

<span>Pendentes</span>

<strong>
<?= $pendentes ?>
</strong>

</div>

</div>


<div class="stat-card green">

<div class="stat-icon">
✅
</div>

<div>

<span>Aprovadas</span>

<strong>
<?= $aprovadas ?>
</strong>

</div>

</div>


<div class="stat-card red">

<div class="stat-icon">
❌
</div>

<div>

<span>Rejeitadas</span>

<strong>
<?= $rejeitadas ?>
</strong>

</div>

</div>


<div class="stat-card purple">

<div class="stat-icon">
👥
</div>

<div>

<span>Usuários</span>

<strong>
<?= $totalUsuarios ?>
</strong>

</div>

</div>


<div class="stat-card dark">

<div class="stat-icon">
🔎
</div>

<div>

<span>Animais perdidos</span>

<strong>
<?= $perdidos ?>
</strong>

</div>

</div>

</div>


<div class="admin-grid">

<div class="admin-panel">

<h2>⚡ Ações rápidas</h2>

<a class="admin-action"
href="animais.php">

🐕 Gerenciar animais

</a>

<a class="admin-action"
href="ocorrencias.php">

🚨 Ver ocorrências

</a>

<a class="admin-action"
href="../mapa/index.php">

🗺️ Abrir mapa

</a>

<a class="admin-action"
href="../animais/cadastrar.php">

➕ Cadastrar animal

</a>

</div>


<div class="admin-panel">

<h2>🔐 Segurança das ocorrências</h2>

<p>

Todas as ocorrências novas ficam
como <strong>Pendente</strong>.

</p>

<p>

Somente ocorrências analisadas e
<strong>aprovadas pelo administrador</strong>
ficam visíveis no mapa público.

</p>

<p>

Isso reduz significativamente
o risco de informações falsas
serem divulgadas.

</p>

</div>

</div>

</main>

</div>

</body>

</html>