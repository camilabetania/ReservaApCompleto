<?php
session_start();
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    // Validações
    if (empty($nome) || empty($email) || empty($senha)) {
        $_SESSION['erro'] = "Preencha todos os campos!";
        header("Location: ../pages/cadastro.php");
        exit();
    }

    // Verifica se o e-mail já existe
    $pdo = DatabaseConfig::getConnection();
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['erro'] = "Este e-mail já está cadastrado!";
        header("Location: ../pages/cadastro.php");
        exit();
    }

    // Cadastra o usuário
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    
    if ($stmt->execute([$nome, $email, $senha_hash])) {
        $_SESSION['sucesso'] = "Cadastro realizado! Faça login.";
        header("Location: ../pages/index.php");
        exit();
    } else {
        $_SESSION['erro'] = "Erro ao cadastrar. Tente novamente.";
        header("Location: ../pages/cadastro.php");
        exit();
    }
} else {
    header("Location: ../pages/cadastro.php");
    exit();
}
?>