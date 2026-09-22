<?php

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

<title>Animais - Minha Patinha</title>

<link rel="stylesheet"
href="../assets/css/style.css">

</head>

<body>

<header class="public-header">

<div class="public-logo">
🐾 Minha Patinha
</div>

<nav>

<a href="../dashboard.php">
Início
</a>

<a href="../mapa/index.php">
Mapa
</a>

<a href="../ocorrencias/cadastrar.php">
Ocorrência
</a>

</nav>

</header>


<main class="map-page">

<h1>🐕 Animais cadastrados</h1>

<div class="animal-grid">

<?php foreach ($animais as $animal): ?>

<div class="animal-card">

<?php if (!empty($animal["foto"])): ?>

<img
src="../uploads/animais/<?= htmlspecialchars($animal["foto"]) ?>"
>

<?php else: ?>

<div class="animal-placeholder">
🐾
</div>

<?php endif; ?>


<div class="animal-card-content">

<h2>
<?= htmlspecialchars($animal["nome"]) ?>
</h2>

<p>
<?= htmlspecialchars($animal["especie"]) ?>
</p>

<p>
<strong>Raça:</strong>
<?= htmlspecialchars($animal["raca"]) ?>
</p>

<p>
<strong>Status:</strong>
<?= htmlspecialchars($animal["status"]) ?>
</p>

<a
class="btn-small"
href="visualizar.php?id=<?= $animal["id"] ?>">

Ver detalhes

</a>

</div>

</div>

<?php endforeach; ?>

</div>

</main>

</body>

</html>