<?php
require("../conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirmarPedido'])) {
        $idPedido = $_POST['idPedido'];

        // Atualiza o status do pedido para "Confirmado" no banco de dados
        $sql = "UPDATE pedidos SET status_pedido = 'Confirmado' WHERE id_pedido = :idPedido";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idPedido', $idPedido);
        $stmt->execute();

        // Redireciona para a página de pedidos
        echo "<script>
        alert('Pedido confirmado com sucesso!');
        window.location.href='../pedidos.php';
        </script>";
    } elseif (isset($_POST['recusarPedido'])) {
        $idPedido = $_POST['idPedido'];

        // Recupera a quantidade do produto associado ao pedido
        $sql = "SELECT id_produto, quantidade FROM pedidos WHERE id_pedido = :idPedido";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idPedido', $idPedido);
        $stmt->execute();
        $pedido = $stmt->fetch(PDO::FETCH_ASSOC);

        $idProduto = $pedido['id_produto'];
        $quantidade = $pedido['quantidade'];

        // Atualiza o status do pedido para "Recusado" no banco de dados
        $sql = "UPDATE pedidos SET status_pedido = 'Recusado' WHERE id_pedido = :idPedido";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idPedido', $idPedido);
        $stmt->execute();

        // Devolve a quantidade do produto ao estoque
        $sql = "UPDATE produtos SET quantidade_produto = quantidade_produto + :quantidade WHERE id_produto = :idProduto";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':idProduto', $idProduto);
        $stmt->execute();

        // Redireciona para a página de pedidos
        echo "<script>
        alert('Pedido cancelado com sucesso!');
        window.location.href='../pedidos.php';
        </script>";
    }
}
