<?php

$host = getenv("DB_HOST") ?: ($_ENV["DB_HOST"] ?? "localhost");
$banco = getenv("DB_NAME") ?: ($_ENV["DB_NAME"] ?? "gestao_animais");
$usuario = getenv("DB_USER") ?: ($_ENV["DB_USER"] ?? "root");
$senha = getenv("DB_PASS") !== false && getenv("DB_PASS") !== "" ? getenv("DB_PASS") : ($_ENV["DB_PASS"] ?? "");
$porta = getenv("DB_PORT") ?: ($_ENV["DB_PORT"] ?? "3306");

if (file_exists(__DIR__ . "/local_env.php")) {
    require __DIR__ . "/local_env.php";
}

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