<?php
require_once '../config/db.php';
redirectIfNotLoggedIn();

// Busca os apartamentos
$apartamentos = $pdo->query("SELECT id, nome FROM apartamentos")->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Agendar Reserva</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f9fc;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        label {
            display: block;
            margin-top: 20px;
            font-weight: bold;
        }
        select, input[type="date"], button {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-top: 8px;
            font-size: 16px;
        }
        button {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            margin-top: 30px;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Agendar Reserva</h2>
        <form action="../php/agendar.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

            <label for="espaco">Apartamento:</label>
            <select name="espaco" required>
                <option value="1">Apartamento #1 - Avenida Paulista</option>
                <option value="2">Apartamento #2 - Faria Lima</option>
                <option value="3">Apartamento #3 - Jardins</option>
                <option value="4">Apartamento #4 - Morumbi</option>
                <option value="5">Apartamento #5 - Vila Olímpia</option>
                <option value="6">Apartamento #6 - Tatuapé</option>
                <option value="7">Apartamento #7 - Centro</option>
            </select>

            <label for="data">Data:</label>
            <input type="date" name="data" required>

            <button type="submit">Reservar</button>
        </form>
    </div>
</body>
</html>
