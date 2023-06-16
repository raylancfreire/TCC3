<?php
$includeNavbar = true;
if ($includeNavbar) {
    include("navbar.php"); // Inclui a navbar
}
require("conn.php");

// Verifique se a sessão está iniciada
if (!isset($_SESSION)) {
    session_start();
}

// Recupere o nome da empresa da sessão
$empresa = $_SESSION['nome'];

// Realize a consulta SQL unindo as tabelas "produtos" e "empresas" com base no campo "empresa"
$sql = "SELECT produtos.* FROM produtos INNER JOIN empresas ON produtos.empresa = empresas.nome WHERE empresas.nome = :empresa";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':empresa', $empresa);
$stmt->execute();

// Obtenha os resultados da consulta
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/meus_produtos.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="catalogo.css">
</head>
<body>
<div class="container">
    <h1>Produtos da Empresa <?php echo $empresa; ?></h1>
    <?php foreach ($resultados as $produto) : ?>
        <div>
    <a href="tela_produto.php?comprar=<?php echo $produto['id_produto']; ?>">
        <img class="product-image" src="upload/<?php echo $produto['path']; ?>" alt="Imagem do produto">
    </a>
    <h2>Nome: <?php echo $produto['nome_produto']; ?></h2>
    <p>Descrição: <?php echo $produto['descricao']; ?></p>
    <p>Marca: <?php echo $produto['marca']; ?></p>
    <p>Quantidade: <?php echo $produto['quantidade_produto']; ?></p>
    <p>Preço: R$<?php echo $produto['preco']; ?></p>

    <!-- Outras informações do produto -->

    <a href="javascript:void(0);" onclick="openPopup(<?php echo $produto['id_produto']; ?>);" class="btn btn-primary">Atualizar Produto</a>
        <br>
        <br>
</div>
    <?php endforeach; ?>
</div>
</body>
</html>
<script>
function openPopup(produtoId) {
  // Obtenha os valores do produto atual
  var nome = "<?php echo $produto['nome_produto']; ?>";
  var descricao = "<?php echo $produto['descricao']; ?>";
  var marca = "<?php echo $produto['marca']; ?>";
  var quantidade = "<?php echo $produto['quantidade_produto']; ?>";
  var preco = "<?php echo $produto['preco']; ?>";

  // Crie o elemento do pop-up
  var popupOverlay = document.createElement('div');
  popupOverlay.className = 'popup-overlay';

  var popupContent = document.createElement('div');
  popupContent.className = 'popup-content';

  var closeButton = document.createElement('span');
  closeButton.innerHTML = '&times;';
  closeButton.className = 'popup-close';
  closeButton.addEventListener('click', closePopup);

  // Crie os elementos para exibir os valores do produto
  var nomeElement = document.createElement('p');
  nomeElement.innerHTML = 'Nome: ' + nome;

  var descricaoElement = document.createElement('p');
  descricaoElement.innerHTML = 'Descrição: ' + descricao;

  var marcaElement = document.createElement('p');
  marcaElement.innerHTML = 'Marca: ' + marca;

  var quantidadeInput = document.createElement('input');
  quantidadeInput.type = 'number';
  quantidadeInput.value = quantidade;

  var precoInput = document.createElement('input');
  precoInput.type = 'number';
  precoInput.value = preco;

  var updateButton = document.createElement('button');
  updateButton.innerHTML = 'Atualizar';
  updateButton.addEventListener('click', updateProduto);

  // Adicione os elementos ao pop-up
  popupContent.appendChild(closeButton);
  popupContent.appendChild(nomeElement);
  popupContent.appendChild(descricaoElement);
  popupContent.appendChild(marcaElement);
  popupContent.appendChild(quantidadeInput);
  popupContent.appendChild(precoInput);
  popupContent.appendChild(updateButton);

  popupOverlay.appendChild(popupContent);
  document.body.appendChild(popupOverlay);

  // Função para fechar o pop-up
  function closePopup() {
    document.body.removeChild(popupOverlay);
  }

  // Função para atualizar o produto com os valores modificados
  function updateProduto() {
    // Obtenha os novos valores
    var novaQuantidade = quantidadeInput.value;
    var novoPreco = precoInput.value;

    // Faça o envio dos valores para o servidor (implemente essa parte de acordo com sua lógica)
    // ...

    // Feche o pop-up
    closePopup();
  }
}
</script>


