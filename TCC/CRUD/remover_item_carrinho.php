<?php
session_start();

if (isset($_GET['id'])) {
  $id_produto = (int)$_GET['id'];

  // Verifica se o carrinho existe na sessão
  if (isset($_SESSION['carrinho'][$_SESSION['id_usuario']])) {
    $carrinho = $_SESSION['carrinho'][$_SESSION['id_usuario']];

    // Verifica se o item a ser removido existe no carrinho
    if (isset($carrinho[$id_produto])) {
      // Remove o item do carrinho
      unset($carrinho[$id_produto]);

      // Atualiza o carrinho na sessão
      $_SESSION['carrinho'][$_SESSION['id_usuario']] = $carrinho;

      echo 'Item removido do carrinho com sucesso!';
    } else {
      echo 'Item não encontrado no carrinho.';
    }
  } else {
    echo 'Carrinho não encontrado.';
  }
} else {
  echo 'ID do produto não fornecido.';
}
?>
