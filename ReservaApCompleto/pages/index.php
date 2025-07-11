<?php
session_start();
$erro = $_SESSION['erro'] ?? '';
unset($_SESSION['erro']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login - ReservaLazer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div class="container">
    <h2>Login</h2>
    <?php if (isset($erro)) echo "<p class='error'>$erro</p>"; ?>
    <form method="POST">
      <input type="email" name="email" placeholder="E-mail" required>
      <input type="password" name="senha" placeholder="Senha" required>
      <button type="submit">Entrar</button>
    </form>
    <p style="text-align:center; margin-top:15px;">
      Não tem conta? <a href="cadastro.php">Cadastre-se</a>
    </p>
  </div>
</body>
</html>