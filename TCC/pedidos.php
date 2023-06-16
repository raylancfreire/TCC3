<?php
$includeNavbar = true;
if ($includeNavbar) {
    include("navbar.php"); // Inclui a navbar
}

require("conn.php");

// Query the orders for the company
$sql = "SELECT id_pedido, u.nome_usuario, p.nome_produto, o.quantidade, o.valor_total, o.endereco_entrega, o.status_pedido
        FROM pedidos o
        INNER JOIN produtos p ON o.id_produto = p.id_produto
        INNER JOIN usuarios u ON o.id_usuario = u.id_usuario
        WHERE o.id_empresa = :id_empresa_cad";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_empresa_cad', $_SESSION['id_empresa']);
$stmt->execute();
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="CSS/pedidos.css">
    
    <title>Pedidos</title>
</head>

<body>
    <div class="container">
        <h1>Pedidos</h1>
        <?php if (count($pedidos) > 0) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Valor Total</th>
                        <th>Endereço de Entrega</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $pedido) : ?>
                        <tr>
                            <td><?php echo $pedido['nome_usuario']; ?></td>
                            <td><?php echo $pedido['nome_produto']; ?></td>
                            <td><?php echo $pedido['quantidade']; ?></td>
                            <td>R$ <?php echo $pedido['valor_total']; ?></td>
                            <td><?php echo $pedido['endereco_entrega']; ?></td>
                            <td><?php echo $pedido['status_pedido']; ?></td>
                            <td>
                                <?php if ($pedido['status_pedido'] !== 'Confirmado' && $pedido['status_pedido'] !== 'Recusado') : ?>
                                    <form action="CRUD/processar_pedido.php" method="POST">
                                        <input type="hidden" name="idPedido" value="<?php echo $pedido['id_pedido']; ?>">
                                        <button type="submit" name="confirmarPedido" class="btn btn-success">Confirmar Pedido</button>
                                        <button type="submit" name="recusarPedido" class="btn btn-danger">Recusar Pedido</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Não há pedidos.</p>
        <?php endif; ?>
    </div>
</body>

</html>
