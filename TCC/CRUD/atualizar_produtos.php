<?php
// arquivo atualizar_produtos.php

// Receba os valores enviados pela requisição AJAX
$produtoId = $_POST['produtoId'];
$novaQuantidade = $_POST['novaQuantidade'];
$novoPreco = $_POST['novoPreco'];

// Execute a lógica de atualização no banco de dados aqui
require("../conn.php");

// Atualize os valores na tabela "produtos" usando uma consulta SQL
$sql = "UPDATE produtos SET quantidade_produto = :quantidade, preco = :preco WHERE id_produto = :produtoId";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':quantidade', $novaQuantidade);
$stmt->bindParam(':preco', $novoPreco);
$stmt->bindParam(':produtoId', $produtoId);

if ($stmt->execute()) {
    // Retorne uma resposta de sucesso
    echo "<script>
            alert('Produto Atualizado com sucesso!!!');
            window.location.href='../meus_produtos.php';
        </script>";
} else {
    // Retorne uma resposta de erro, se a atualização falhar
    $response = array('success' => false, 'message' => 'Erro ao atualizar o produto');
}

echo json_encode($response);
?>
