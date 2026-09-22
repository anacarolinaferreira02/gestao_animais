<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function verificarLogin()
{
    if (!isset($_SESSION["usuario_id"])) {

        header("Location: /gestao_animais/login.php");

        exit;
    }
}

function verificarAdmin()
{
    verificarLogin();

    if ($_SESSION["usuario_tipo"] !== "admin") {

        header("Location: /gestao_animais/dashboard.php");

        exit;
    }
}

?>