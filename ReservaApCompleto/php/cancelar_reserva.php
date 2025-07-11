<?php
session_start();
require_once '../config/db.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../pages/index.php");
    exit();
}

// Obtém o ID da reserva a ser cancelada
$reserva_id = $_POST['reserva_id'] ?? null;
$usuario_id = $_SESSION['usuario_id'];

// Validação básica
if (!$reserva_id) {
    $_SESSION['erro'] = "Reserva inválida";
    header("Location: ../pages/reservas.php");
    exit();
}

try {
    // Atualiza apenas reservas do próprio usuário
    $stmt = $pdo->prepare("UPDATE reservas SET status = 'cancelado' 
                          WHERE id = ? AND id_usuario = ? AND status = 'pendente'");
    $stmt->execute([$reserva_id, $usuario_id]);
    
    if ($stmt->rowCount() > 0) {
        $_SESSION['sucesso'] = "Reserva cancelada com sucesso!";
    } else {
        $_SESSION['erro'] = "Reserva não encontrada ou já cancelada";
    }
    
} catch (PDOException $e) {
    $_SESSION['erro'] = "Erro ao cancelar reserva";
}

header("Location: ../pages/reservas.php");
exit();
?>