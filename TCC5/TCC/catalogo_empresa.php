<?php
    $includeNavbar = true;
    if ($includeNavbar) {
        include("navbar_empresa.php"); // Inclui a navbar
    }

    include("conn.php");
    // Verifica se o formulário de busca foi enviado
    if (isset($_GET['nome_produto'])) {
      $nomeProduto = $_GET['nome_produto'];
      
      // Consulta os dados da tabela "produtos" com base no nome do produto
      $sql = "SELECT path, nome_produto, descricao, preco FROM produtos WHERE nome_produto LIKE '%$nomeProduto%'";
      $result = $pdo->query($sql);
      
      // Exibe os produtos em forma de catálogo
      if ($result->rowCount() > 0) {
          foreach ($result as $row) {
              echo "<div class='product'>";
              echo "<img class='product-image' src='upload/{$row['path']}' alt='Imagem'>";
              echo "<h3 class='product-name'>{$row['nome_produto']}</h3>";
              echo "<p class='product-description'>{$row['descricao']}</p>";
              echo "<p class='product-price'>Preço: R$ {$row['preco']}</p>";
              echo "<button class='botao-comprar'>Comprar</button>";
              echo "</div>";
          }
      } else {
          echo "<p>Nenhum produto encontrado.</p>";
      }
  }  
?>
<html lang="pt-br">
<head>
  <link rel="stylesheet" href="catalogo.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
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
</body>
</html>
