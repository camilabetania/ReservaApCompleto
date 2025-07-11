<?php
session_start();
require_once '../config/db.php';

// Verifica login e redireciona se necessário
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../pages/index.php");
    exit();
}

// Processa cancelamento se existir
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancelar'])) {
    require_once '../php/cancelar_reserva.php';
}

// Consulta as reservas
$sql = "SELECT r.id, a.nome AS apartamento, 
               DATE_FORMAT(r.data, '%d/%m/%Y') AS data_formatada,
               r.status, a.descricao
        FROM reservas r
        JOIN apartamentos a ON r.id_apartamento = a.id
        WHERE r.id_usuario = ?
        ORDER BY r.data DESC
        LIMIT 20"; // Limite para paginação

$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['usuario_id']]);
$reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Reservas</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* Estilos otimizados */
        .reservas-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .reserva-card {
            background: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-left: 4px solid;
            transition: transform 0.2s;
        }

        .reserva-card:hover {
            transform: translateY(-3px);
        }

        .pendente { border-color: #FFC107; color: #FFC107; }
        .aprovado { border-color: #28A745; color: #28A745; }
        .cancelado { border-color: #DC3545; color: #DC3545; }
        .rejeitado { border-color: #6C757D; color: #6C757D; }

        .card-actions {
            margin-top: 15px;
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 12px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-cancelar {
            background: #DC3545;
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            grid-column: 1 / -1;
        }

        @media (max-width: 768px) {
            .reservas-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav class="dashboard-nav">
        <span>Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
        <a href="dashboard.php">Início</a>
        <a href="agendamento.php">Nova Reserva</a>
        <a href="../php/logout.php">Sair</a>
    </nav>

    <main class="container">
        <h1>Minhas Reservas</h1>
        
        <?php if (isset($_GET['cancelamento'])): ?>
            <div class="alert <?= $_GET['cancelamento'] === 'sucesso' ? 'success' : 'error' ?>">
                <?= $_GET['cancelamento'] === 'sucesso' ? 'Reserva cancelada!' : 'Erro ao cancelar' ?>
            </div>
        <?php endif; ?>

        <?php if (empty($reservas)): ?>
            <div class="empty-state">
                <p>Nenhuma reserva encontrada.</p>
                <a href="agendamento.php" class="btn primary">Agendar Visita</a>
            </div>
        <?php else: ?>
            <div class="reservas-container">
                <?php foreach ($reservas as $reserva): ?>
                    <article class="reserva-card <?= $reserva['status'] ?>">
                        <h2><?= htmlspecialchars($reserva['apartamento']) ?></h2>
                        <p><strong>Data:</strong> <?= $reserva['data_formatada'] ?></p>
                        <p><strong>Status:</strong> <span class="<?= $reserva['status'] ?>">
                            <?= ucfirst($reserva['status']) ?>
                        </span></p>
                        
                        <?php if (!empty($reserva['descricao'])): ?>
                            <p class="descricao"><?= htmlspecialchars($reserva['descricao']) ?></p>
                        <?php endif; ?>

                        <?php if ($reserva['status'] === 'pendente'): ?>
                            <div class="card-actions">
                                <form method="POST" onsubmit="return confirm('Cancelar esta reserva?')">
                                    <input type="hidden" name="reserva_id" value="<?= $reserva['id'] ?>">
                                    <button type="submit" name="cancelar" class="btn btn-cancelar">
                                        Cancelar Reserva
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <script>
        // Confirmação para cancelamento
        document.querySelectorAll('.btn-cancelar').forEach(btn => {
            btn.addEventListener('click', (e) => {
                if (!confirm('Tem certeza que deseja cancelar esta reserva?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>