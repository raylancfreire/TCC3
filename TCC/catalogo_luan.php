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
  
  <link rel="stylesheet" href="CSS/catalogo.css">
</head>

<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col">
        <form method="GET" action="catalogo_luan.php">
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
                $precoFormatado = number_format($row['preco'], 2, ',', '.');
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
                    <p class="product-price">Preço: R$ <?php echo $precoFormatado; ?></p><br>
                    <?php if ($tipoUsuario !== 'empresa') : ?>
                      <div class="teste">
                        <a href="tela_produto.php?comprar=<?php echo $row['id_produto']; ?>" class="btn-verde">COMPRAR</a>
                        <br>
                        <br>
                        <a href="#" class="btn-azul add-to-cart" data-produto="<?php echo $row['id_produto']; ?>">ADD CARRINHO</a>
                      </div>
                    <?php endif; ?>
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