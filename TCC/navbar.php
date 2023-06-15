<?php
require("protected.php");
require("conn.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
  // Redireciona o usuário para a página de login
  header("Location: login.php");
  exit();
}

// Faz a conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "tcc");

// Verifica se houve algum erro na conexão
if ($conn->connect_error) {
  die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Recupera o usuário atual da tabela "usuarios"
$email = $_SESSION['email'];
$query = "SELECT * FROM usuarios WHERE email = '$email'";
$result = $conn->query($query);

// Verifica se o usuário existe na tabela "usuarios"
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $usuarioID = $row['id_usuario'];

  // Verifica se o usuário está cadastrado na tabela "empresas"
  $query = "SELECT * FROM empresas WHERE email = '$email'";
  $result = $conn->query($query);

  // Verifica se o usuário é uma empresa
  $isEmpresa = $result->num_rows > 0;

  // Define a variável de sessão 'isEmpresa' com base no resultado
  $_SESSION['isEmpresa'] = $isEmpresa;
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Página Inicial</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="CSS/navbar.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg" style="background-color: #b7d6f5;">
    <div class="container-fluid">
      <img src="IMAGENS/LOGO2.png" class="logo" alt="Logo" onclick="window.location.href='catalogo_luan.php';" style="cursor: pointer;">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="catalogo_luan.php" style="margin-right: 70px; border: 1.5px solid black; border-radius: 5px;">Catálogo</a>
          </li>
          <li class="nav-item">
            <?php if ($tipoUsuario === 'empresa') : ?>
              <a class="nav-link" href="meus_produtos.php" style="margin-right: 70px; width: 190px; border: 1.5px solid black; border-radius: 5px;">Meus Produtos</a>
            <?php else : ?>
              <a class="nav-link" href="pedidos.php" style="margin-right: 70px; width: 190px; border: 1.5px solid black; border-radius: 5px;">Meus Pedidos</a>
            <?php endif; ?>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: 1.5px solid black; border-radius: 5px;">
              Menu
            </a>
            <ul class="dropdown-menu">
              <?php if ($tipoUsuario === 'empresa') : ?>
                <li><a class="dropdown-item" href="cadastrar_produto.php">Cadastrar Produto</a></li>
              <?php endif; ?>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="logout.php">Sair</a></li>
            </ul>
          </li>
        </ul>
        <div class="carrinho">
        <?php if ($tipoUsuario !== 'empresa') : ?>
            <div class="d-flex justify-content-end ms-auto" style="margin-top: 22px;">
              <p><a href="carrinho.php"> <img src="IMAGENS/carrinho3.png" alt=""></a></p>
            </div>
          <?php endif; ?>
  
        </div>
        <div class="container">
          <?php if ($tipoUsuario !== 'empresa') : ?>
            <div class="d-flex justify-content-end ms-auto" style="margin-top: 22px;">
              <p>Seu endereço: <?php echo $_SESSION['endereco']; ?></p>
            </div>
          <?php endif; ?>
        </div>

      </div>
    </div>
  </nav>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>