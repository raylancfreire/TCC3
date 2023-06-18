<?php
require("../conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirmarPedido'])) {
        $idPedido = $_POST['idPedido'];

        // Consulta o id da empresa responsável pelo pedido
        $sql = "SELECT id_empresa FROM pedidos WHERE id_pedido = :idPedido";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idPedido', $idPedido);
        $stmt->execute();
        $pedido = $stmt->fetch(PDO::FETCH_ASSOC);

        $idEmpresa = $pedido['id_empresa'];

        // Consulta a chave PIX da empresa
        $sql = "SELECT chave_pix FROM empresas WHERE id_empresa = :idEmpresa";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idEmpresa', $idEmpresa);
        $stmt->execute();
        $empresa = $stmt->fetch(PDO::FETCH_ASSOC);

        $pixEmpresa = $empresa['chave_pix'];

        // Atualiza o status do pedido para "Confirmado" e insere a chave PIX da empresa no banco de dados
        $sql = "UPDATE pedidos SET status_pedido = 'Confirmado', pix_empresa = :pixEmpresa WHERE id_pedido = :idPedido";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':pixEmpresa', $pixEmpresa);
        $stmt->bindParam(':idPedido', $idPedido);
        $stmt->execute();

        // Redireciona para a página de pedidos
        echo "<script>
        alert('Pedido confirmado com sucesso!');
        window.location.href='../pedidos.php';
        </script>";
    } elseif (isset($_POST['pixRecebido'])) {
        $idPedido = $_POST['idPedido'];

        // Atualiza o status do pedido para "Finalizado" no banco de dados
        $sql = "UPDATE pedidos SET status_pedido = 'Finalizado' WHERE id_pedido = :idPedido";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idPedido', $idPedido);
        $stmt->execute();

        // Redireciona para a página de pedidos
        echo "<script>
        alert('Pedido finalizado com sucesso!');
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
?>
