<?php

require_once "../config/auth.php";
verificarAdmin();

require_once "../config/conexao.php";

$id = intval($_GET["id"] ?? 0);

$stmt = $pdo->prepare("
    SELECT
        o.*,
        u.nome AS usuario_nome,
        u.email AS usuario_email,
        a.nome AS animal_nome

    FROM ocorrencias o

    INNER JOIN usuarios u
    ON u.id = o.usuario_id

    LEFT JOIN animais a
    ON a.id = o.animal_id

    WHERE o.id = ?
");

$stmt->execute([$id]);

$ocorrencia = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ocorrencia) {

    die("Ocorrência não encontrada.");

}


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $acao = $_POST["acao"];

    if ($acao === "aprovar") {

        $stmt = $pdo->prepare("
            UPDATE ocorrencias

            SET
                status_verificacao = 'Aprovada',
                verificada_por = ?,
                verificada_em = NOW(),
                motivo_rejeicao = NULL

            WHERE id = ?
        ");

        $stmt->execute([
            $_SESSION["usuario_id"],
            $id
        ]);

        if ($ocorrencia["animal_id"]) {

            $status = $ocorrencia["tipo"] === "Perdido"
                ? "Perdido"
                : "Encontrado";

            $update = $pdo->prepare("
                UPDATE animais
                SET status = ?
                WHERE id = ?
            ");

            $update->execute([
                $status,
                $ocorrencia["animal_id"]
            ]);
        }

    }


    if ($acao === "rejeitar") {

        $motivo = trim($_POST["motivo"]);

        if ($motivo === "") {

            die("Informe o motivo da rejeição.");

        }

        $stmt = $pdo->prepare("
            UPDATE ocorrencias

            SET
                status_verificacao = 'Rejeitada',
                motivo_rejeicao = ?,
                verificada_por = ?,
                verificada_em = NOW()

            WHERE id = ?
        ");

        $stmt->execute([
            $motivo,
            $_SESSION["usuario_id"],
            $id
        ]);

    }


    header("Location: ocorrencias.php");

    exit;
}

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Verificar ocorrência</title>

<link rel="stylesheet"
href="../assets/css/style.css">

</head>

<body>

<div class="admin-layout">

<aside class="sidebar">

<div class="brand">
🐾 Minha Patinha
</div>

<nav>

<a href="index.php">📊 Dashboard</a>

<a href="ocorrencias.php">🚨 Ocorrências</a>

<a href="../mapa/index.php">🗺️ Mapa</a>

<a href="../logout.php">🚪 Sair</a>

</nav>

</aside>


<main class="admin-content">

<h1>🔎 Analisar ocorrência</h1>


<div class="verification-grid">

<div class="verification-photo">

<img
src="../uploads/ocorrencias/<?= htmlspecialchars($ocorrencia["foto"]) ?>"
alt="Foto da ocorrência">

</div>


<div class="verification-info">

<h2>
<?= htmlspecialchars($ocorrencia["titulo"]) ?>
</h2>

<p>

<strong>Tipo:</strong>

<?= htmlspecialchars($ocorrencia["tipo"]) ?>

</p>

<p>

<strong>Descrição:</strong>

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

<strong>Horário:</strong>

<?= htmlspecialchars($ocorrencia["hora_ocorrencia"] ?? "Não informado") ?>

</p>

<p>

<strong>Contato:</strong>

<?= htmlspecialchars($ocorrencia["telefone_contato"]) ?>

</p>

<hr>

<h3>👤 Autor da ocorrência</h3>

<p>

<strong>Nome:</strong>

<?= htmlspecialchars($ocorrencia["usuario_nome"]) ?>

</p>

<p>

<strong>E-mail:</strong>

<?= htmlspecialchars($ocorrencia["usuario_email"]) ?>

</p>

</div>

</div>


<?php if ($ocorrencia["status_verificacao"] === "Pendente"): ?>

<div class="verification-actions">

<form method="POST">

<input
type="hidden"
name="acao"
value="aprovar">

<button
class="btn-approve"
type="submit">

✅ APROVAR OCORRÊNCIA

</button>

</form>


<form method="POST">

<input
type="hidden"
name="acao"
value="rejeitar">

<textarea
name="motivo"
placeholder="Explique por que a ocorrência está sendo rejeitada..."
required></textarea>

<button
class="btn-reject"
type="submit">

❌ REJEITAR OCORRÊNCIA

</button>

</form>

</div>

<?php else: ?>

<div class="alert-box">

Esta ocorrência já foi analisada.

<strong>

<?= htmlspecialchars(
    $ocorrencia["status_verificacao"]
) ?>

</strong>

</div>

<?php endif; ?>

</main>

</div>

</body>

</html>