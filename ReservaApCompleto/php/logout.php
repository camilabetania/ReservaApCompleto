<?php
session_start();

// Limpa todos os dados da sessão
$_SESSION = array();

// Se desejar matar a sessão completamente, apague também o cookie de sessão
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Destrói a sessão
session_destroy();

// Redireciona para a página inicial
header("Location: ../pages/index.php");
exit;
?>