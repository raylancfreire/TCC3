<?php
session_start();
$includeNavbar = true;
if ($includeNavbar) {
  include("navbar.php"); // Inclui a navbar
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <link rel="stylesheet" href="catalogo.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Index</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="catalogo.css">
</head>

<style>
  /* Estilo para botão verde */
  .btn-verde {
    margin-bottom: 60px;
    background-color: #28a745;
    color: #fff;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    text-decoration: none;
  }

  .product-name {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 5px;
    color: black;
    text-decoration: none;
  }

  .btn-verde:hover {
    background-color: #218838;
  }

  /* Estilo para botão azul */
  .btn-azul {
    background-color: #007bff;
    color: #fff;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    text-decoration: none;
  }

  .btn-azul:hover {
    background-color: #0069d9;
  }
</style>

<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col">
        <form method="GET" action="catalogo.php">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="nome_produto" placeholder="Digite o nome do produto">
            <button class="btn btn-primary" type="submit">Buscar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col mt-5">
        <!-- Conteúdo do catálogo -->
        <div class="catalog">
          <div class="row">
            <?php
            require("conn.php");

            if (isset($_GET['nome_produto'])) {
              $nomeProduto = $_GET['nome_produto'];

              // Consulta os dados da tabela "produtos" com base no nome do produto
              $sql = "SELECT path, nome_produto, descricao, preco FROM produtos WHERE nome_produto LIKE '%$nomeProduto%'";
              $result = $pdo->query($sql);

              // Exibe os produtos em forma de catálogo
              if ($result->rowCount() > 0) {
                foreach ($result as $row) {
            ?>
                  <div class="product">
                    <img class="product-image" src="upload/<?php echo $row['path']; ?>" alt="Imagem">
                    <h3 class="product-name"><?php echo $row['nome_produto']; ?></h3>
                    <p class="product-description"><?php echo $row['descricao']; ?></p>
                    <p class="product-price">Preço: R$ <?php echo $row['preco']; ?></p>
                    <button class="botao-comprar">Comprar</button>
                  </div>
                <?php
                }
              } else {
                echo "<p>Nenhum produto encontrado.</p>";
              }
            }

            // Consulta os dados da tabela "produtos"
            $sql = "SELECT id_produto, path, quantidade_produto, nome_produto, descricao, preco FROM produtos";
            $result = $pdo->query($sql);

            // Exibe os produtos em forma de catálogo
            if ($result->rowCount() > 0) {
              foreach ($result as $row) {
                ?>
                <div class="col-md-3 mb-4">
                  <div class="product">
                    <a href="tela_produto.php?comprar=<?php echo $row['id_produto']; ?>">
                      <img class="product-image" src="upload/<?php echo $row['path']; ?>" alt="Imagem do produto">
                    </a>
                    <h3 class="product-name">
                      <a href="tela_produto.php?comprar=<?php echo $row['id_produto']; ?>">
                        <?php echo $row['nome_produto']; ?>
                      </a>
                    </h3>
                    <p class="product-description"><?php echo $row['descricao']; ?></p>
                    <p class="product-price">Preço: R$ <?php echo $row['preco']; ?></p>
                    <br>
                    <a href="tela_produto.php?comprar=<?php echo $row['id_produto']; ?>" class="btn-verde">COMPRAR</a>
                    <br>
                    <br>
                    <a href="#" class="btn-azul add-to-cart" data-produto="<?php echo $row['id_produto']; ?>">ADD CARRINHO</a>
                  </div>
                </div>
            <?php
              }
            } else {
              echo '<div class="col">';
              echo '<p>Nenhum produto encontrado.</p>';
              echo '</div>';
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('click', function(event) {
      if (event.target.classList.contains('add-to-cart')) {
        event.preventDefault();
        var produtoId = event.target.getAttribute('data-produto');
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState === 4 && this.status === 200) {
            alert('Produto enviado ao carrinho com sucesso');
          }
        };
        xhttp.open('GET', 'carrinho.php?carrinho=' + produtoId, true);
        xhttp.send();
      }
    });
  </script>
</body>

</html>