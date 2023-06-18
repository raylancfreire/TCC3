<?php

// Inclua o arquivo de conexão com o banco de dados
require("../conn.php");

// Verificar se o formulário foi enviado
if (isset($_POST['salvar'])) {
    $idEmpresa = $_POST['idEmpresa'];
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $cnpj = $_POST['cnpj'];
    $chave_pix = $_POST['chave_pix'];
    $email = $_POST['email'];

    // Atualizar os dados do usuário no banco de dados
    $sql = "UPDATE empresas SET nome = :nome, endereco = :endereco, telefone = :telefone, cnpj = :cnpj, chave_pix = :chave_pix,  email = :email WHERE id_empresa = :idEmpresa";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idEmpresa', $idEmpresa);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':cnpj', $cnpj);
    $stmt->bindParam(':chave_pix', $chave_pix);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    echo "<script>
            alert('Dados atualizados com sucesso!!!');
            window.location.href='../perfil_empresa.php';
        </script>";
} else {
    echo "<script>
            alert('Erro ao atualizar os dados!');
            window.location.href='../perfil_empresa.php';
        </script>";
}
?>
