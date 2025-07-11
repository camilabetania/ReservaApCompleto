<?php

require_once '../config/db.php';
redirectIfNotLoggedIn();

// Redireciona se não for POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../pages/agendamento.php");
    exit();
}

// Verifica token CSRF
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $_SESSION['erro'] = "Erro de segurança. Tente novamente.";
    header("Location: ../pages/agendamento.php");
    exit();
}

// Dados do formulário
$id_usuario = $_SESSION['usuario_id'];
$id_apartamento = filter_input(INPUT_POST, 'apartamento', FILTER_VALIDATE_INT);
$data = filter_input(INPUT_POST, 'data');

// Validações básicas
if (!$id_apartamento || !$data) {
    $_SESSION['erro'] = "Selecione um apartamento e uma data.";
    header("Location: ../pages/agendamento.php");
    exit();
}

// Verifica data futura
if (strtotime($data) < strtotime(date('Y-m-d'))) {
    $_SESSION['erro'] = "Não é possível agendar para datas passadas.";
    header("Location: ../pages/agendamento.php");
    exit();
}

// Verifica se já existe reserva para este apartamento na data
$stmt = $pdo->prepare("SELECT id FROM reservas WHERE id_apartamento = ? AND data = ?");
$stmt->execute([$id_apartamento, $data]);

if ($stmt->rowCount() > 0) {
    $_SESSION['erro'] = "Este apartamento já está reservado para a data selecionada.";
    header("Location: ../pages/agendamento.php");
    exit();
}

// Verifica limite de reservas do usuário (máximo 3 reservas ativas)
$stmt = $pdo->prepare("SELECT COUNT(*) FROM reservas WHERE id_usuario = ? AND status = 'pendente'");
$stmt->execute([$id_usuario]);
if ($stmt->fetchColumn() >= 3) {
    $_SESSION['erro'] = "Você já tem 3 reservas pendentes. Cancele uma antes de fazer nova reserva.";
    header("Location: ../pages/agendamento.php");
    exit();
}

// Insere a reserva (sem horários)
try {
    $sql = "INSERT INTO reservas (id_usuario, id_apartamento, data, status) 
            VALUES (?, ?, ?, 'pendente')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_usuario, $id_apartamento, $data]);
    
    $_SESSION['sucesso'] = "Reserva agendada com sucesso para dia " . date('d/m/Y', strtotime($data));
    header("Location: ../pages/reservas.php");
    exit();
    
} catch (PDOException $e) {
    error_log("Erro ao agendar: " . $e->getMessage());
    $_SESSION['erro'] = "Erro ao salvar reserva. Tente novamente.";
    header("Location: ../pages/agendamento.php");
    exit();
}