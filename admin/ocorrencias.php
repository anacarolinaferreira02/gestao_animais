<?php

require_once "../config/auth.php";
verificarAdmin();

require_once "../config/conexao.php";

$sql = "
SELECT
    o.*,
    u.nome AS usuario_nome,
    a.nome AS animal_nome

FROM ocorrencias o

INNER JOIN usuarios u
ON u.id = o.usuario_id

LEFT JOIN animais a
ON a.id = o.animal_id

ORDER BY
    CASE
        WHEN o.status_verificacao = 'Pendente'
        THEN 1
        ELSE 2
    END,
    o.criado_em DESC
";

$ocorrencias = $pdo
    ->query($sql)
    ->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Ocorrências</title>

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

<a class="active"
href="ocorrencias.php">
🚨 Ocorrências
</a>

<a href="usuarios.php">
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

<h1>Ocorrências</h1>

<p>
Analise e verifique os registros enviados pelos usuários.
</p>

</div>

</div>


<div class="table-panel">

<table>

<thead>

<tr>

<th>Foto</th>

<th>Tipo</th>

<th>Título</th>

<th>Usuário</th>

<th>Local</th>

<th>Data</th>

<th>Status</th>

<th>Ação</th>

</tr>

</thead>

<tbody>

<?php foreach ($ocorrencias as $o): ?>

<tr>

<td>

<img
class="table-photo"
src="../uploads/ocorrencias/<?= htmlspecialchars($o["foto"]) ?>"
alt="Animal">

</td>

<td>

<?php if ($o["tipo"] === "Perdido"): ?>

<span class="badge badge-red">
🔎 Perdido
</span>

<?php else: ?>

<span class="badge badge-blue">
📍 Encontrado
</span>

<?php endif; ?>

</td>

<td>
<?= htmlspecialchars($o["titulo"]) ?>
</td>

<td>
<?= htmlspecialchars($o["usuario_nome"]) ?>
</td>

<td>
<?= htmlspecialchars($o["localizacao"]) ?>
</td>

<td>
<?= htmlspecialchars($o["data_ocorrencia"]) ?>
</td>

<td>

<?php if ($o["status_verificacao"] === "Pendente"): ?>

<span class="badge badge-orange">
⏳ Pendente
</span>

<?php elseif ($o["status_verificacao"] === "Aprovada"): ?>

<span class="badge badge-green">
✅ Aprovada
</span>

<?php else: ?>

<span class="badge badge-red">
❌ Rejeitada
</span>

<?php endif; ?>

</td>

<td>

<a
class="btn-small"
href="verificar_ocorrencia.php?id=<?= $o["id"] ?>">

Analisar

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