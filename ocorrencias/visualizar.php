<?php

require_once "../config/auth.php";
verificarLogin();

require_once "../config/conexao.php";

$id = intval($_GET["id"] ?? 0);

$stmt = $pdo->prepare("
    SELECT *
    FROM ocorrencias
    WHERE id = ?
    AND usuario_id = ?
");

$stmt->execute([
    $id,
    $_SESSION["usuario_id"]
]);

$ocorrencia =
    $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ocorrencia) {

    die("Ocorrência não encontrada.");

}

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
<?= htmlspecialchars($ocorrencia["titulo"]) ?>
</title>

<link
rel="stylesheet"
href="../assets/css/style.css"
>

</head>

<body>
<script src="assets/js/script.js"></script>
<div class="form-page">

<div class="form-container">

<img
src="../uploads/ocorrencias/<?= htmlspecialchars($ocorrencia["foto"]) ?>"
style="
width:100%;
max-height:400px;
object-fit:cover;
border-radius:15px;
"
>

<h1>
<?= htmlspecialchars($ocorrencia["titulo"]) ?>
</h1>

<p>

<strong>Tipo:</strong>

<?= htmlspecialchars($ocorrencia["tipo"]) ?>

</p>

<p>

<strong>Descrição:</strong>

<br>

<?= nl2br(
    htmlspecialchars($ocorrencia["descricao"])
) ?>

</p>

<p>

<strong>Local:</strong>

<?= htmlspecialchars($ocorrencia["localizacao"]) ?>

</p>

<p>

<strong>Data:</strong>

<?= htmlspecialchars($ocorrencia["data_ocorrencia"]) ?>

</p>

<p>

<strong>Status:</strong>

<?= htmlspecialchars(
    $ocorrencia["status_verificacao"]
) ?>

</p>


<?php if (
    $ocorrencia["status_verificacao"]
    === "Rejeitada"
): ?>

<div class="alert-error">

<strong>
Motivo da rejeição:
</strong>

<br>

<?= nl2br(
    htmlspecialchars(
        $ocorrencia["motivo_rejeicao"]
    )
) ?>

</div>

<?php endif; ?>


<a
class="btn-small"
href="index.php">

← Voltar

</a>

</div>

</div>

</body>

</html>