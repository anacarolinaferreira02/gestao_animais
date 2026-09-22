<?php

require_once "../config/conexao.php";

$id = intval($_GET["id"] ?? 0);

$stmt = $pdo->prepare("
    SELECT *
    FROM animais
    WHERE id = ?
");

$stmt->execute([$id]);

$animal = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$animal) {

    die("Animal não encontrado.");

}

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
<?= htmlspecialchars($animal["nome"]) ?>
</title>

<link
rel="stylesheet"
href="../assets/css/style.css"
>

</head>

<body>

<div class="form-page">

<div class="form-container">

<?php if (!empty($animal["foto"])): ?>

<img
src="../uploads/animais/<?= htmlspecialchars($animal["foto"]) ?>"
style="width:100%;max-height:400px;object-fit:cover;border-radius:15px;"
>

<?php endif; ?>

<h1>
🐾 <?= htmlspecialchars($animal["nome"]) ?>
</h1>

<p>
<strong>Espécie:</strong>
<?= htmlspecialchars($animal["especie"]) ?>
</p>

<p>
<strong>Raça:</strong>
<?= htmlspecialchars($animal["raca"]) ?>
</p>

<p>
<strong>Sexo:</strong>
<?= htmlspecialchars($animal["sexo"]) ?>
</p>

<p>
<strong>Idade:</strong>
<?= htmlspecialchars($animal["idade"]) ?>
</p>

<p>
<strong>Cor:</strong>
<?= htmlspecialchars($animal["cor"]) ?>
</p>

<p>
<strong>Status:</strong>
<?= htmlspecialchars($animal["status"]) ?>
</p>

<p>

<strong>Descrição:</strong>

<br>

<?= nl2br(
    htmlspecialchars($animal["descricao"])
) ?>

</p>

<a
class="btn-small"
href="index.php">

← Voltar

</a>

</div>

</div>

</body>

</html>