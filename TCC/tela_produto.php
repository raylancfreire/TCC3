<?php
    $includeNavbar = true;
    if ($includeNavbar) {
        include("navbar.php"); // Inclui a navbar
    }
    ?>
<?php
require("conn.php");

// Get the ID from the URL parameter
$comprar = $_GET['comprar'];

// Query the data for the given ID
$sql = "SELECT id_produto, path, nome_produto, descricao, preco FROM produtos WHERE id_produto = :comprar";
$stmt = $pdo->prepare($sql);
$stmt->execute(['comprar' => $comprar]);
$row = $stmt->fetch();

// Display the product details
?>

<head>
    <link rel="stylesheet" href="CSS/tela_compra.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Página Inicial</title>
</head>
    <body>
    <div class='product-details'>
        <div class='row'>
            <div class='col-md-6'>
                <div class='image-container'>
                    <img class='imagem' src='upload/<?php echo $row['path']; ?>' alt='Product image'>
                </div>
            </div>
            <div class='col-md-6'>
                <div class="letras">
                    <p type="text" name='id_produto'> <?php echo $row['id_produto']; ?></p>

                    <h3 class='product-name'><?php echo $row['nome_produto']; ?></h3>
                    <p class='product-price'>R$ <?php echo $row['preco']; ?></p>
                    <p class='product-description'><?php echo $row['descricao']; ?></p>
                    <a href="carrinho.php?comprar=<?php echo $row['id_produto']; ?>" class="btn btn-success">COMPRAR</a>
                </div>
            </div>
    </div>
    
</div>
<div>
</div>


</body>
</html>
