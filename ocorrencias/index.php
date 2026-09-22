<?php

require_once "../config/auth.php";
verificarLogin();

require_once "../config/conexao.php";

$stmt = $pdo->prepare("
    SELECT *
    FROM ocorrencias
    WHERE usuario_id = ?
    ORDER BY criado_em DESC
");

$stmt->execute([
    $_SESSION["usuario_id"]
]);

$ocorrencias =
    $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Minhas ocorrências</title>

<link
rel="stylesheet"
href="../assets/css/style.css"
>

</head>

<body>
<script src="assets/js/script.js"></script>
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

<a href="cadastrar.php">
Nova ocorrência
</a>

</nav>

</header>


<main class="map-page">

<h1>🚨 Minhas ocorrências</h1>

<div class="animal-grid">

<?php foreach ($ocorrencias as $ocorrencia): ?>

<div class="animal-card">

<img
src="../uploads/ocorrencias/<?= htmlspecialchars($ocorrencia["foto"]) ?>"
>

<div class="animal-card-content">

<h2>
<?= htmlspecialchars($ocorrencia["titulo"]) ?>
</h2>

<p>

<?= htmlspecialchars($ocorrencia["tipo"]) ?>

</p>

<?php if (
    $ocorrencia["status_verificacao"]
    === "Pendente"
): ?>

<span class="badge badge-orange">
⏳ Em análise
</span>

<?php elseif (
    $ocorrencia["status_verificacao"]
    === "Aprovada"
): ?>

<span class="badge badge-green">
✅ Aprovada
</span>

<?php else: ?>

<span class="badge badge-red">
❌ Rejeitada
</span>

<?php endif; ?>


<br><br>

<a
class="btn-small"
href="visualizar.php?id=<?= $ocorrencia["id"] ?>"
>

Detalhes

</a>

</div>

</div>

<?php endforeach; ?>

</div>

</main>

</body>

</html>