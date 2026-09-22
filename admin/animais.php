<?php

require_once "../config/auth.php";
verificarAdmin();

require_once "../config/conexao.php";

$animais = $pdo->query("
    SELECT *
    FROM animais
    ORDER BY id DESC
")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Gerenciar Animais</title>

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

<a class="active" href="animais.php">
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

<h1>🐕 Animais</h1>

<p>
Gerencie os animais cadastrados no sistema.
</p>

</div>

<a
class="btn-small"
href="../animais/cadastrar.php">

➕ Cadastrar animal

</a>

</div>


<div class="table-panel">

<table>

<thead>

<tr>

<th>Foto</th>

<th>Nome</th>

<th>Espécie</th>

<th>Raça</th>

<th>Sexo</th>

<th>Status</th>

<th>Ações</th>

</tr>

</thead>

<tbody>

<?php foreach ($animais as $animal): ?>

<tr>

<td>

<?php if (!empty($animal["foto"])): ?>

<img
class="table-photo"
src="../uploads/animais/<?= htmlspecialchars($animal["foto"]) ?>"
>

<?php else: ?>

🐾

<?php endif; ?>

</td>

<td>
<?= htmlspecialchars($animal["nome"]) ?>
</td>

<td>
<?= htmlspecialchars($animal["especie"]) ?>
</td>

<td>
<?= htmlspecialchars($animal["raca"]) ?>
</td>

<td>
<?= htmlspecialchars($animal["sexo"]) ?>
</td>

<td>

<?php

$status = $animal["status"];

if ($status === "Perdido") {

echo '<span class="badge badge-red">
Perdido
</span>';

} elseif ($status === "Encontrado") {

echo '<span class="badge badge-blue">
Encontrado
</span>';

} elseif ($status === "Disponível para adoção") {

echo '<span class="badge badge-green">
Adoção
</span>';

} else {

echo '<span class="badge badge-orange">
' . htmlspecialchars($status) .
'</span>';

}

?>

</td>

<td>

<a
class="btn-small"
href="../animais/visualizar.php?id=<?= $animal["id"] ?>">

Ver

</a>

<a
class="btn-small"
href="../animais/editar.php?id=<?= $animal["id"] ?>">

Editar

</a>

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