<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }

    .form-container {
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    form input[type="text"],
    form input[type="email"],
    form input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }

    form button {
      width: 100%;
      padding: 12px;
      background-color: #007bff;
      border: none;
      border-radius: 6px;
      color: white;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s;
    }

    form button:hover {
      background-color: #0056b3;
    }

    form p {
      margin-top: 15px;
      text-align: center;
      font-size: 14px;
    }

    form a {
      color: #007bff;
      text-decoration: none;
    }

    form a:hover {
      text-decoration: underline;
    }

    .mensagem {
      text-align: center;
      margin-bottom: 15px;
      color: green;
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h2>Cadastro</h2>

    <?php if (isset($mensagem)) echo "<p class='mensagem'>$mensagem</p>"; ?>

    <form method="POST">
      <input type="text" name="nome" placeholder="Nome" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="senha" placeholder="Senha" required>
      <button type="submit">Cadastrar</button>
      <p>Já tem conta? <a href="index.php">Faça login</a></p>
    </form>
  </div>

</body>
</html>
