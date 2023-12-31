<?php
$includeNavbar = true;
if ($includeNavbar) {
    include("navbar.php"); // Inclui a navbar
}

require("conn.php");

// Get the ID from the URL parameter
$comprar = $_GET['comprar'];

// Query the data for the given ID
$sql = "SELECT id_produto, path, nome_produto, descricao, preco, quantidade_produto, id_empresa_cad FROM produtos WHERE id_produto = :comprar";
$stmt = $pdo->prepare($sql);
$stmt->execute(['comprar' => $comprar]);
$row = $stmt->fetch();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quantidade = $_POST['quantidade'];

    // Insert a new record into the "pedidos" table
    $sql = "INSERT INTO pedidos (id_usuario, id_produto, quantidade, valor_total, endereco_entrega, status_pedido, id_empresa)
            VALUES (:idUsuario, :idProduto, :quantidade, :valorTotal, :enderecoEntrega, 'Pendente', :idEmpresa)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'idUsuario' => $_SESSION['id_usuario'],
        'idProduto' => $row['id_produto'],
        'quantidade' => $quantidade,
        'valorTotal' => $row['preco'] * $quantidade,
        'enderecoEntrega' => $_SESSION['endereco'],
        'idEmpresa' => $row['id_empresa_cad']
    ]);

    // Update the "produtos" table to decrement the quantity
    $sql = "UPDATE produtos SET quantidade_produto = quantidade_produto - :quantidade WHERE id_produto = :idProduto";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'quantidade' => $quantidade,
        'idProduto' => $row['id_produto']
    ]);

    // Display a popup with the company's phone number
    $telefoneEmpresa = "123456789"; // Replace with the actual phone number from the database
    echo "<script>alert('Entre em contato com a empresa pelo telefone: $telefoneEmpresa');</script>";

    // Redirect to the "meus_pedidos.php" page
    header("Location: meus_pedidos.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="CSS/tela_compra.css">
    <title>Página Inicial</title>
</head>
<body>
    <?php if ($tipoUsuario === 'empresa') : ?>
        <div class='product-details'>
            <div class='row'>
                <div class='col-md-6'>
                    <div class='image-container'>
                        <img class='product-image' src='upload/<?php echo $row['path']; ?>' alt='Product image'>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class="product-info">
                        <p class='product-id'>ID: <?php echo $row['id_produto']; ?></p>
                        <h3 class='product-name'><?php echo $row['nome_produto']; ?></h3>
                        <p class='product-price'>R$ <?php echo $row['preco']; ?></p>
                        <p class='product-description'><?php echo $row['descricao']; ?></p>

                        <!-- Form for entering the quantity and finalizing the order -->
                        <form method="POST">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php elseif ($tipoUsuario !== 'empresa') : ?>
        <div class='product-details'>
            <div class='row'>
                <div class='col-md-6'>
                    <div class='image-container'>
                        <img class='product-image' src='upload/<?php echo $row['path']; ?>' alt='Product image'>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class="product-info">
                        <p class='product-id'>ID: <?php echo $row['id_produto']; ?></p>
                        <h3 class='product-name'><?php echo $row['nome_produto']; ?></h3>
                        <p class='product-price'>R$ <?php echo $row['preco']; ?></p>
                        <p class='product-description'><?php echo $row['descricao']; ?></p>

                        <!-- Form for entering the quantity and finalizing the order -->
                        <form method="POST">
                            <label for="quantidade">Quantidade:</label>
                            <select id="quantidade" name="quantidade" class="quantity-input" required>
                                <?php
                                $maxQuantidade = $row['quantidade_produto'];
                                for ($i = 1; $i <= $maxQuantidade; $i++) {
                                    echo "<option value=\"$i\">$i</option>";
                                }
                                ?>
                            </select>

                            <br><br>
                            <button type="submit" class="btn btn-primary">Finalizar Pedido</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>
