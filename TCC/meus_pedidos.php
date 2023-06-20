<?php
$includeNavbar = true;
if ($includeNavbar) {
    include("navbar.php"); // Inclui a navbar
}

require("conn.php");

// Query the orders for the logged-in user
$sql = "SELECT p.nome_produto, id_pedido, o.quantidade, o.valor_total, o.endereco_entrega, o.status_pedido, o.pix_empresa, o.comprovante_pix
        FROM pedidos o
        INNER JOIN produtos p ON o.id_produto = p.id_produto
        WHERE o.id_usuario = :idUsuario";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':idUsuario', $_SESSION['id_usuario']);
$stmt->execute();
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="CSS/meus_pedidos.css">

    <title>Meus Pedidos</title>
</head>

<body>
    <div class="container">
        <h1>Meus Pedidos</h1>
        <?php if (count($pedidos) > 0) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Valor Total</th>
                        <th>Endereço de Entrega</th>
                        <th>Status</th>
                        <th>Pix da Empresa</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $pedido) :
                        $precoFormatado = number_format($pedido['valor_total'], 2, ',', '.');
                        $statusPedido = $pedido['status_pedido'];
                        $pixEmpresa = $pedido['pix_empresa'];
                    ?>

                        <tr>
                            <td><?php echo $pedido['nome_produto']; ?></td>
                            <td><?php echo $pedido['quantidade']; ?></td>
                            <td>R$ <?php echo $precoFormatado; ?></td>
                            <td><?php echo $pedido['endereco_entrega']; ?></td>
                            <td><?php echo $statusPedido; ?></td>
                            <td><?php echo ($statusPedido === 'Confirmado' || $statusPedido === 'Finalizado') ? $pixEmpresa : ''; ?></td>
                            <td>
                                <?php if ($statusPedido === 'Confirmado') : ?>
                                    <form action="CRUD/enviar_comprovante.php" method="post" enctype="multipart/form-data">
                                        <input type="file" name="comprovante" accept=".pdf" required>
                                        <input type="hidden" name="id_pedido" value="<?php echo $pedido['id_pedido']; ?>">
                                        <input type="submit" value="Enviar Comprovante">
                                    </form>
                                <?php elseif ($statusPedido === 'Finalizado') : ?>
                                                                  
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Você não possui pedidos.</p>
        <?php endif; ?>
    </div>
</body>




</html>