<?php
session_start();
require_once '../config/db.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['erro'] = "Você precisa estar logado para fazer uma reserva.";
    header("Location: ../pages/index.php");
    exit();
}

// Pega os dados do formulário
$id_usuario = $_SESSION['usuario_id'];
$id_apartamento = $_POST['id_apartamento'] ?? null;
$data = $_POST['data'] ?? null;

// Validação básica
if (!$id_apartamento || !$data) {
    $_SESSION['erro'] = "Selecione um apartamento e uma data.";
    header("Location: ../pages/agendamento.php");
    exit();
}

// Verifica se a data é válida (futura)
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

// Insere a reserva
try {
    $sql = "INSERT INTO reservas (id_usuario, id_apartamento, data, status) 
            VALUES (?, ?, ?, 'pendente')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_usuario, $id_apartamento, $data]);
    
    $_SESSION['sucesso'] = "Reserva agendada com sucesso para " . date('d/m/Y', strtotime($data));
    header("Location: ../pages/reservas.php");
    exit();
    
} catch (PDOException $e) {
    $_SESSION['erro'] = "Erro ao agendar. Tente novamente.";
    header("Location: ../pages/agendamento.php");
    exit();
}