<?php

if (file_exists(__DIR__ . "/local_env.php")) {
    require_once __DIR__ . "/local_env.php";
}

$host = getenv("DB_HOST") ?: "localhost";
$banco = getenv("DB_NAME") ?: "gestao_animais";
$usuario = getenv("DB_USER") ?: "root";
$senha = getenv("DB_PASS") !== false ? getenv("DB_PASS") : "";
$porta = getenv("DB_PORT") ?: "3306";

try {

    $pdo = new PDO(
        "mysql:host=$host;port=$porta;dbname=$banco;charset=utf8mb4",
        $usuario,
        $senha
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch (PDOException $e) {

    die("Erro ao conectar com o banco: " . $e->getMessage());

}

?>