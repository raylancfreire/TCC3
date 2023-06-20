<?php
require("protected.php");
$includeNavbar = true;
if ($includeNavbar) {
    include("navbar.php"); // Inclui a navbar
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="CSS/cadastrar_produto.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body><br><br>
    <div class="container">
        <form action="CRUD/cad_produto.php" method="post" enctype="multipart/form-data">
            <h1>Cadastre seu Produto</h1><br>
            <div class="form-group">
                <label for="nome_produto">Nome do Produto</label>
                <input type="text" id="nome_produto" name="nome_produto" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea name="descricao" id="descricao" cols="30" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text" id="marca" name="marca" required>
            </div>
            <div class="form-group">
                <label for="categoria">Categoria</label>
                <input type="text" style="height: 80px;" id="categoria" name="categoria" required>
            </div>

            <div class="form-group">
                <label for="preco">Preço</label>
                <input type="text" id="preco" name="preco" placeholder="" step="0.01" min="0.01" required oninput="formatarValor(this)">
            </div>
            <div class="form-group">
                <label for="quantidade_produto">Quantidade do Produto</label>
                <input type="number"  id="quantidade_produto" name="quantidade_produto" min="1" required>
            </div>
            <div class="form-group">
                <label for="imagem">Imagem</label>
                <input type="file" id="imagem" name="imagem" required>
                <input type="hidden" name="empresa" value="<?php echo $_SESSION['nome']; ?>">
                <input type="hidden" name="id_empresa_cad" value="<?php echo $_SESSION['id_empresa']; ?>">
            </div>
            <div class="form-group">
                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>
    <script>
        function formatarValor(input) {
            // Obtenha o valor digitado no campo de entrada
            let valor = input.value;

            // Remova quaisquer caracteres não numéricos, exceto o ponto decimal
            valor = valor.replace(/[^0-9]/g, '');

            // Divida o valor em parte inteira e decimal
            let parteInteira = valor.slice(0, -2);
            let parteDecimal = valor.slice(-2);

            // Adicione o separador de milhar à parte inteira, se necessário
            parteInteira = parteInteira.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            // Formate o valor final com a parte decimal
            let valorFormatado = parteInteira + ',' + parteDecimal;

            // Defina o valor formatado de volta no campo de entrada
            input.value = valorFormatado;
        }
    </script>
</body>

</html>
