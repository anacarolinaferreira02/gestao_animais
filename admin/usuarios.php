<?php

require_once "../config/auth.php";
verificarAdmin();

require_once "../config/conexao.php";

$usuarios = $pdo->query("
    SELECT id, nome, email, tipo, criado_em
    FROM usuarios
    ORDER BY id DESC
")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Usuários</title>

<link rel="stylesheet"
href="../assets/css/style.css">

</head>

<body>
<script src="assets/js/script.js"></script>
<div class="admin-layout">

<aside class="sidebar">

<div class="brand">
🐾 Minha Patinha
</div>

<div class="admin-label">
ADMINISTRADOR
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

<a class="active"
href="usuarios.php">
👥 Usuários
</a>

<a href="../mapa/index.php">
🗺️ Mapa
</a>

<a href="../logout.php">
🚪 Sair
</a>

</nav>

</aside>


<main class="admin-content">

<div class="topbar">

<div>

<h1>👥 Usuários</h1>

<p>
Usuários cadastrados no sistema.
</p>

</div>

</div>


<div class="table-panel">

<table>

<thead>

<tr>

<th>ID</th>

<th>Nome</th>

<th>E-mail</th>

<th>Tipo</th>

<th>Cadastro</th>

</tr>

</thead>

<tbody>

<?php foreach ($usuarios as $usuario): ?>

<tr>

<td>
<?= $usuario["id"] ?>
</td>

<td>
<?= htmlspecialchars($usuario["nome"]) ?>
</td>

<td>
<?= htmlspecialchars($usuario["email"]) ?>
</td>

<td>

<?php if ($usuario["tipo"] === "admin"): ?>

<span class="badge badge-red">
👨‍💼 Administrador
</span>

<?php else: ?>

<span class="badge badge-blue">
👤 Usuário
</span>

<?php endif; ?>

</td>

<td>
<?= htmlspecialchars($usuario["criado_em"] ?? "") ?>
</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</main>

</div>

</body>

</html>