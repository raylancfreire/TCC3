<?php

// Inclua o arquivo de conexão com o banco de dados
require("../conn.php");

// Verificar se o formulário foi enviado
if (isset($_POST['salvar'])) {
    $idUsuario = $_POST['idUsuario'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $email = $_POST['email'];

    // Atualizar os dados do usuário no banco de dados
    $sql = "UPDATE usuarios SET nome_usuario = :nome, cpf = :cpf, endereco = :endereco, email = :email WHERE id_usuario = :idUsuario";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idUsuario', $idUsuario);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    echo "<script>
            alert('Dados atualizados com sucesso!!!');
            window.location.href='../perfil.php';
        </script>";
} else {
    echo "<script>
            alert('Erro ao atualizar os dados!');
            window.location.href='../perfil.php';
        </script>";
}
?>
