<!DOCTYPE html>
<html lang="pt-br">

<head>
  <script>
    function alterarEndereco() {
      var novoEndereco = prompt("Digite o novo endereço:");
      if (novoEndereco) {
        document.getElementById("endereco").textContent = novoEndereco;
      }
    }
  </script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Página Inicial</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">ExpCars</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="?page=catalogo">Catálogo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=ofertas">Ofertas</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Menu
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="?page=perfil">Perfil</a></li>
              <li><a class="dropdown-item" href="?page=pedidos">Meus Pedidos</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="logout.php">Sair</a></li>
            </ul>
          </li>
        </ul>
        <div class="container">
          <div class="d-flex justify-content-end ms-auto">
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <p id="endereco">Rua Exemplo, 123 - Cidade</p>
            <button class="btn btn-outline-primary" onclick="alterarEndereco()">Alterar Endereço</button>
          </div>
        </div>
      </div>
    </div>

  </nav>

  <div class="container">
    <div class="row">
      <div class="col mt-5">
        <!-- Conteúdo do catálogo -->
        <div class="catalog">
          <h1>Catálogo</h1>
              <?php
              require("conn.php");

              // Consulta os dados da tabela "produtos"
              $sql = "SELECT path, nome_produto, descricao, preco FROM produtos";
              $result = $pdo->query($sql);

              // Exibe os produtos em forma de catálogo
              if ($result->rowCount() > 0) {
                echo "<div class='catalog'>"; // Início do catálogo

                foreach ($result as $row) {
                  // Exibe os detalhes do produto
                  echo "<div class='product'>";
                  echo "<img class='product-image' src='upload/{$row['path']}' alt='Imagem do produto'>";
                  echo "<h3 class='product-name'>{$row['nome_produto']}</h3>";
                  echo "<p class='product-description'>{$row['descricao']}</p>";
                  echo "<p class='product-price'>Preço: R$ {$row['preco']}</p>";
                  echo "<button class='botao-comprar'>Comprar</button>";
                  echo '<button><a href=tela_compra.php?produto='.['id_produto'].' class="btn btn-success">COMPRAR</a></button>';
                  echo "</div>";
                }

                echo "</div>"; // Fim do catálogo
              } else {
                echo "<p>Nenhum produto encontrado.</p>";
              }
              ?>

        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>
