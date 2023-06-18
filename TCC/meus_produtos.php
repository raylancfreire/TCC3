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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/meus_produtos.css">
    <h1>Produtos da Empresa <?php echo $empresa; ?></h1>
</head>
<body>
<div class="container">
    <?php foreach ($resultados as $produto):
        $precoFormatado = number_format($produto['preco'], 2, ',', '.');
        ?>
        <div style="border: solid 2px black">
            <a href="tela_produto.php?comprar=<?php echo $produto['id_produto']; ?>">
            <br><br>
                <img class="product-image" style="margin-left: 86px;" src="upload/<?php echo $produto['path']; ?>" alt="Imagem do produto">
                
            </a>
            <br><br>
            <h2 style="margin-left: 20px;">Nome: <?php echo $produto['nome_produto']; ?></h2>
            <p style="margin-left: 20px;">Descrição: <?php echo $produto['descricao']; ?></p>
            <p style="margin-left: 20px;">Marca: <?php echo $produto['marca']; ?></p>
            <p style="margin-left: 20px;">Quantidade: <?php echo $produto['quantidade_produto']; ?></p>
            <p style="margin-left: 20px;">Preço: R$ <?php echo $precoFormatado; ?></p>
            <a href="javascript:void(0);" style="margin-left: 20px;" onclick="openPopup(<?php echo $produto['id_produto']; ?>, '<?php echo $produto['nome_produto']; ?>', '<?php echo $produto['descricao']; ?>', '<?php echo $produto['marca']; ?>', <?php echo $produto['quantidade_produto']; ?>, <?php echo $produto['preco']; ?>);" class="btn btn-primary">Atualizar Produto</a>
            <a href="javascript:void(0);" style="margin-left: 20px;" onclick="openPopupDelete(<?php echo $produto['id_produto']; ?>, '<?php echo $produto['nome_produto']; ?>', '<?php echo $produto['descricao']; ?>', '<?php echo $produto['marca']; ?>', <?php echo $produto['quantidade_produto']; ?>, <?php echo $produto['preco']; ?>);" class="btn btn-danger">Excluir Produto</a>
            <br>
            <br>
        </div>
    <?php endforeach; ?>
</div>

<script>
    function openPopup(produtoId, nome, descricao, marca, quantidade, preco) {
        var popupOverlay = document.createElement('div');
        popupOverlay.className = 'popup-overlay';

        var popupContent = document.createElement('div');
        popupContent.className = 'popup-content';

        var closeButton = document.createElement('span');
        closeButton.innerHTML = '&times;';
        closeButton.className = 'popup-close';
        closeButton.addEventListener('click', closePopup);

        var nomeElement = document.createElement('p');
        nomeElement.innerHTML = 'Nome: ' + nome;

        var descricaoElement = document.createElement('p');
        descricaoElement.innerHTML = 'Descrição: ' + descricao;

        var marcaElement = document.createElement('p');
        marcaElement.innerHTML = 'Marca: ' + marca;

        var quantidadeLabel = document.createElement('label');
        quantidadeLabel.innerHTML = 'Quantidade:';
        var quantidadeInput = document.createElement('input');
        quantidadeInput.type = 'number';
        quantidadeInput.value = quantidade;

        var precoLabel = document.createElement('label');
        precoLabel.innerHTML = 'Preço:';
        var precoInput = document.createElement('input');
        precoInput.type = 'number';
        precoInput.value = preco.toFixed(2);

        var updateButton = document.createElement('button');
        updateButton.innerHTML = 'Atualizar';
        updateButton.addEventListener('click', updateProduto);

        popupContent.appendChild(closeButton);
        popupContent.appendChild(nomeElement);
        popupContent.appendChild(descricaoElement);
        popupContent.appendChild(marcaElement);
        popupContent.appendChild(quantidadeLabel);
        popupContent.appendChild(quantidadeInput);
        popupContent.appendChild(precoLabel);
        popupContent.appendChild(precoInput);
        popupContent.appendChild(updateButton);

        popupOverlay.appendChild(popupContent);
        document.body.appendChild(popupOverlay);

        function closePopup() {
            document.body.removeChild(popupOverlay);
        }

        function updateProduto() {
            var novaQuantidade = quantidadeInput.value;
            var novoPreco = precoInput.value;

            // Faça o envio dos valores para o servidor (implemente essa parte de acordo com sua lógica)
            // ...

            closePopup();
        }
    }
</script>
<script>
    function openPopupDelete(produtoId, nome) {
        var popupOverlay = document.createElement('div');
        popupOverlay.className = 'popup-overlay';

        var popupContent = document.createElement('div');
        popupContent.className = 'popup-content';

        var closeButton = document.createElement('span');
        closeButton.innerHTML = '&times;';
        closeButton.className = 'popup-close';
        closeButton.addEventListener('click', closePopup);

        var nomeElement = document.createElement('h2');
        nomeElement.innerHTML = nome;

        var mensagemElement = document.createElement('p');
        mensagemElement.innerHTML = 'Tem certeza que deseja excluir este produto?';

        var confirmButton = document.createElement('button');
        confirmButton.innerHTML = 'Confirmar';
        confirmButton.addEventListener('click', function() {
            confirmDelete(produtoId);
        });

        popupContent.appendChild(closeButton);
        popupContent.appendChild(nomeElement);
        popupContent.appendChild(mensagemElement);
        popupContent.appendChild(confirmButton);

        popupOverlay.appendChild(popupContent);
        document.body.appendChild(popupOverlay);

        function closePopup() {
            document.body.removeChild(popupOverlay);
        }

        function confirmDelete(produtoId) {
            // Enviar a solicitação para o arquivo del_produto.php usando AJAX
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText); // Exemplo: exibir a resposta no console

                    // Exibir mensagem de sucesso
                    alert("Produto excluído com sucesso!");

                    // Recarregar a página
                    location.reload();
                }
            };
            xhttp.open("POST", "CRUD/del_produto.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("produtoId=" + produtoId);

            // Feche o pop-up
            closePopup();
        }
    }
</script>


</body>
</html>
