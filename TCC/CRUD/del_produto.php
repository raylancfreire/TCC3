<?php

// Inclua o arquivo de conexão com o banco de dados
require("../conn.php");

// Verificar se o ID do produto foi enviado
if (isset($_POST['produtoId'])) {
    $produtoId = $_POST['produtoId'];

    // Excluir o produto do banco de dados
    $sql = "DELETE FROM produtos WHERE id_produto = :produtoId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':produtoId', $produtoId);
    $stmt->execute();

    echo "<script>
            alert('Produto excluido com sucesso!!!');
            window.location.href='../meus_produtos.php';
        </script>";
} else {
    echo "<script>
            alert('Erro ao excluir o produto!!!');
            window.location.href='../meus_produtos.php';
        </script>";
}
?>
