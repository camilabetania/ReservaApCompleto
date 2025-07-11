<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit();
}
$nome = htmlspecialchars($_SESSION['usuario_nome']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/style.css">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
    }

    nav {
      background-color: #007bff;
      color: white;
      padding: 15px 20px;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      gap: 15px;
    }

    nav strong {
      margin-right: 10px;
    }

    nav a {
      color: white;
      text-decoration: none;
      font-weight: bold;
      padding: 6px 12px;
      transition: background 0.3s;
      border-radius: 5px;
    }

    nav a:hover {
      background-color: rgba(255, 255, 255, 0.2);
    }

    .container {
      padding: 40px 20px;
      text-align: center;
    }

    .paragrafo-maior {
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 20px;
      color: #2c3e50;
    }

    h2 {
      margin-top: 30px;
      margin-bottom: 20px;
      font-size: 24px;
      color: #333;
    }

    .apartamentos-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }

    .card {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 300px;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: scale(1.03);
    }

    .card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .card-content {
      padding: 15px;
    }

    .card h3 {
      margin-top: 0;
      font-size: 18px;
      color: #333;
    }

    .card p {
      font-size: 14px;
      color: #555;
    }

    /* RESPONSIVO */
    @media (max-width: 768px) {
      .paragrafo-maior {
        font-size: 24px;
      }

      h2 {
        font-size: 20px;
      }

      nav {
        flex-direction: column;
        gap: 10px;
        padding: 15px;
        text-align: center;
      }

      nav strong {
        margin: 0;
      }
    }

    @media (max-width: 480px) {
      .paragrafo-maior {
        font-size: 20px;
      }

      h2 {
        font-size: 18px;
      }

      .card-content {
        padding: 10px;
      }

      .card h3 {
        font-size: 16px;
      }

      .card p {
        font-size: 13px;
      }
    }
  </style>
</head>
<body>

  <nav>
    <strong>Olá, <?= htmlspecialchars($nome) ?></strong>
    <a href="agendamento.php">Agendar</a>
    <a href="reservas.php">Minhas Reservas</a>
    <a href="../php/logout.php">Sair</a>
  </nav>

  <div class="container">
    <p class="paragrafo-maior">Bem-vindo ao Sistema de Reservas</p>
    <p class="paragrafo-maior">Aqui encontra os melhores apartamentos com os melhores preços</p>

    <h2>Veja nossos Apartamentos disponíveis</h2>

    <div class="apartamentos-container">

      <!-- Apartamento #1 -->
      <div class="card" id="apto-1">
        <img src="https://tse2.mm.bing.net/th/id/OIP.ZQN2biFIlvmZ2i3ZFY0BAQHaE8?r=0&rs=1&pid=ImgDetMain" alt="Apartamento na Paulista">
        <div class="card-content">
          <h3>Apartamento #1 - Avenida Paulista</h3>
          <p>O Edifício Paulista, localizado na Rua Genebra, Bela Vista, foi inspirado na paisagem natural da Riviera de São Lourenço. Ambientes acolhedores proporcionam momentos únicos de tranquilidade.</p>
        </div>
      </div>

      <!-- Apartamento #2 -->
      <div class="card" id="apto-2">
        <img src="https://images.ctfassets.net/cfexf643femz/cgakOklGBSb2kWLv8kILH/db176743e3430d6b818c52d545ade6ab/recife_apartamentos_gallery_d6536224119e24baad3b.jpg" alt="Apartamento na Faria Lima">
        <div class="card-content">
          <h3>Apartamento #2 - Faria Lima</h3>
          <p>Morar na Faria Lima é sinônimo de praticidade. Próximo a comércios, cultura e gastronomia, oferece conforto e conveniência na Rua dos Pinheiros.</p>
        </div>
      </div>

      <!-- Apartamento #3 -->
      <div class="card" id="apto-3">
        <img src="https://swellconstrucoes.com.br/wp-content/uploads/2020/11/SWELL_SILVA_duplex_v04_01-1.jpg" alt="Apartamento no Morumbi">
        <div class="card-content">
          <h3>Apartamento #3 - Morumbi</h3>
          <p>Sofisticação e natureza em um só lugar. No Condomínio Vista Verde, você encontra segurança, vista privilegiada e tranquilidade no coração do Morumbi.</p>
        </div>
      </div>

      <!-- Apartamento #4 -->
      <div class="card" id="apto-4">
        <img src="https://eeon9q568x2.exactdn.com/wp-content/uploads/2024/06/Os-Apartamentos-de-Luxo-Mais-Cobicados-de-Sao-Paulo-Uma-Experiencia-de-Vida-Unica-1.jpg?strip=all&lossy=1&ssl=1&fit=726,408" alt="Apartamento em Moema">
        <div class="card-content">
          <h3>Apartamento #4 - Moema</h3>
          <p>Com estilo contemporâneo, o Moema Life oferece sacada gourmet, estrutura moderna e proximidade ao Ibirapuera. Ideal para famílias.</p>
        </div>
      </div>

      <!-- Apartamento #5 -->
      <div class="card" id="apto-5">
        <img src="https://swellconstrucoes.com.br/wp-content/uploads/2020/11/SWELL_SILVA_duplex_v04_01-1.jpg" alt="Apartamento na Vila Mariana">
        <div class="card-content">
          <h3>Apartamento #5 - Vila Mariana</h3>
          <p>O Jardim da Vila está próximo ao metrô e centros culturais. Perfeito para quem busca mobilidade, conforto e sofisticação.</p>
        </div>
      </div>

      <!-- Apartamento #6 -->
      <div class="card" id="apto-6">
        <img src="https://eeon9q568x2.exactdn.com/wp-content/uploads/2024/06/Os-Apartamentos-de-Luxo-Mais-Cobicados-de-Sao-Paulo-Uma-Experiencia-de-Vida-Unica-1.jpg?strip=all&lossy=1&ssl=1&fit=726,408" alt="Apartamento no Tatuapé">
        <div class="card-content">
          <h3>Apartamento #6 - Tatuapé</h3>
          <p>Espaço, segurança e lazer. O Tatuapé Classic é ideal para quem quer viver bem com fácil acesso a shoppings e escolas.</p>
        </div>
      </div>

      <!-- Apartamento #7 -->
      <div class="card" id="apto-7">
        <img src="https://swellconstrucoes.com.br/wp-content/uploads/2020/11/SWELL_SILVA_duplex_v04_01-1.jpg" alt="Apartamento no Centro">
        <div class="card-content">
          <h3>Apartamento #7 - Centro</h3>
          <p>Viva no coração da cidade! O Edifício República une localização estratégica com modernidade e praticidade no dia a dia.</p>
        </div>
      </div>

    </div>
  </div>

</body>
</html>
