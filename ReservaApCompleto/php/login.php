<?php
session_start();
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    $pdo = DatabaseConfig::getConnection();
    $stmt = $pdo->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        header("Location: ../pages/dashboard.php");
        exit();
    } else {
        $_SESSION['erro'] = "E-mail ou senha incorretos!";
        header("Location: ../pages/index.php");
        exit();
    }
} else {
    header("Location: ../pages/index.php");
    exit();
}
?>