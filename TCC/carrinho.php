<?php
$includeNavbar = true;
if ($includeNavbar) {
  include("navbar.php"); // Inclui a navbar
}
?>
<html lang="pt-br">

<head>
  <link rel="stylesheet" href="catalogo.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="CSS/carrinho.css">
  <title>Carrinho de Compras</title>
</head>
</head>

<body>


  <div class="container">
    <div class="row">
      <div class="col mt-5">
        <!-- Conteúdo do catálogo -->
        <div class="catalog">
          <div class="row">
            <?php

            if (!isset($_SESSION['id_usuario'])) {
              die('Você não pode acessar esta página porque não está logado.<p><a href="login.php">Entrar</a></p>');
            }

            require("conn.php");

            $idEmpresa = $_SESSION['id_usuario'];

            // Função para adicionar um produto ao carrinho
            function adicionarAoCarrinho($id_usuario, $id_produto, $quantidade, $nome_produto, $preco, $imagem)
            {
              // Verifica se o carrinho já existe na sessão
              if (isset($_SESSION['carrinho'][$id_usuario])) {
                $carrinho = $_SESSION['carrinho'][$id_usuario];
              } else {
                $carrinho = array();
              }

              // Verifica se o produto já está no carrinho
              if (isset($carrinho[$id_produto])) {
                // Atualiza a quantidade do produto
                $carrinho[$id_produto]['quantidade'] += $quantidade;
              } else {
                // Adiciona o produto ao carrinho
                $carrinho[$id_produto] = array(
                  'id_produto' => $id_produto,
                  'quantidade' => $quantidade,
                  'nome_produto' => $nome_produto,
                  'preco' => $preco,
                  'imagem' => $imagem
                );
              }

              // Atualiza o carrinho na sessão
              $_SESSION['carrinho'][$id_usuario] = $carrinho;
            }

            // Verifica se foi solicitada a adição ao carrinho
            if (isset($_GET['carrinho'])) {
              $id_produto = (int)$_GET['carrinho'];

              // Consulta os dados do produto
              $sql = "SELECT id_produto, nome_produto, preco, path FROM produtos WHERE id_produto = :id_produto";
              $stmt = $pdo->prepare($sql);
              $stmt->bindValue(':id_produto', $id_produto);
              $stmt->execute();

              $produto = $stmt->fetch(PDO::FETCH_ASSOC);

              // Verifica se o produto existe
              if ($produto) {
                $quantidade = 1; // Quantidade padrão ao adicionar ao carrinho
                adicionarAoCarrinho($idEmpresa, $id_produto, $quantidade, $produto['nome_produto'], $produto['preco'], $produto['path']);
                echo "O produto foi adicionado ao carrinho";
              } else {
                echo 'Produto não encontrado.';
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container mt-5">
    <div class="row">
      <div class="col">
        <h2>Carrinho de Compras</h2>
        <?php
        // Verifica se o carrinho está vazio
        if (!empty($_SESSION['carrinho'][$idEmpresa])) {
          echo '<table class="table">';
          echo '<thead>';
          echo '<tr>';
          echo '<th>Item</th>';
          echo '<th>Nome do Produto</th>';
          echo '<th>Preço</th>';
          echo '<th>Quantidade</th>';
          echo '<th></th>';
          echo '</tr>';
          echo '</thead>';
          echo '<tbody>';
          foreach ($_SESSION['carrinho'][$idEmpresa] as $id_produto => $item) {
            echo '<tr>';

            // Verifica se as chaves estão definidas no array $item
            if (isset($item['id_produto']) && isset($item['nome_produto']) && isset($item['preco']) && isset($item['quantidade']) && isset($item['imagem'])) {
              echo '<td><img class="" style="width: 60px; height: 60px;" src="upload/' . $item['imagem'] . '" alt="Imagem do produto"></td>';
              echo '<td>' . $item['nome_produto'] . '</td>';
              echo '<td>R$ ' . $item['preco'] . '</td>';
              echo '<td>' . $item['quantidade'] . '</td>';
              echo '<td><a href="tela_produto.php?comprar=' . $item['id_produto'] . '" class="btn-verde">COMPRAR</a></td>';
              echo '<td class="trash-icon">  <img src="IMAGENS/lixeira2.png" class="remove-item" data-id="' . $item['id_produto'] . '"> EXCLUIR</td>';
              
            } else {
              // Alguma chave está faltando no array $item, exiba uma mensagem de erro ou faça o tratamento adequado
              echo '<td colspan="5">Informações do produto indisponíveis</td>';
            }

            echo '</tr>';
          }
          echo '</tbody>';
          echo '</table>';
          // Calcula o total da compra
          $total = 0;
          foreach ($_SESSION['carrinho'][$idEmpresa] as $id_produto => $item) {
            // Verifica se as chaves estão definidas no array $item antes de acessá-las
            if (isset($item['preco']) && isset($item['quantidade'])) {
              $total += $item['preco'] * $item['quantidade'];
            }
          }
          echo '<p>Total: R$ ' . $total . '</p>';
        } else {
          echo '<p>O carrinho está vazio.</p>';
        }
        ?>
      </div>
    </div>
  </div>
  <script>
  // Captura o evento de clique na imagem da lixeira
  const removeItemButtons = document.querySelectorAll('.remove-item');
  removeItemButtons.forEach(button => {
    button.addEventListener('click', function() {
      const itemId = this.getAttribute('data-id');

      // Envia uma solicitação para remover o item do carrinho
      fetch('CRUD/remover_item_carrinho.php?id=' + itemId)
        .then(response => response.text())
        .then(result => {
          // Exibe a resposta da solicitação (opcional)
          console.log(result);

          // Atualiza a página para refletir as alterações no carrinho
          window.location.reload();
        })
        .catch(error => {
          // Manipula erros (opcional)
          console.error(error);
        });
    });
  });
</script>
</body>
</html>
