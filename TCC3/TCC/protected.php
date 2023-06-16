<?php
require("conn.php");

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id_usuario']) && !isset($_SESSION['id_empresa'])) {
    die('Você não pode acessar esta página porque não está logado.<p><a href="login.php">Entrar</a></p>');
}

if (isset($_SESSION['id_empresa'])) {
    $idEmpresa = $_SESSION['id_empresa'];

    // Consulta o nome do usuário com base no id_empresa
    $sql = "SELECT nome FROM empresas WHERE id_empresa = '$idEmpresa'";
    $result = $pdo->query($sql);

    if ($result->rowCount() > 0) {
        // Obtém o nome do usuário e o id_empresa
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $nome = $row['nome'];
        $idEmpresa = $_SESSION['id_empresa'];

        // Armazena o nome do usuário e o id_empresa na variável de sessão
        $_SESSION['nome'] = $nome;
        $_SESSION['id_empresa'] = $idEmpresa;
    } else {
        // Caso o id_empresa não seja encontrado, você pode lidar com isso de acordo com a lógica do seu sistema
    }

    // O usuário é uma empresa
    $tipoUsuario = 'empresa';
} else {
    // O usuário é um usuário normal
    $tipoUsuario = 'usuario';
}
