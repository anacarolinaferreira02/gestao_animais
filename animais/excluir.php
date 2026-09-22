<?php

require_once "../config/auth.php";
verificarAdmin();

require_once "../config/conexao.php";

$id = intval($_GET["id"] ?? 0);

if ($id > 0) {

    $stmt = $pdo->prepare("
        DELETE FROM animais
        WHERE id = ?
    ");

    $stmt->execute([$id]);
}

header(
    "Location: ../admin/animais.php"
);

exit;
?>