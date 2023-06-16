<?php
$includeNavbar = true;
if ($includeNavbar) {
    include("navbar.php"); // Inclui a navbar
}
require("conn.php");

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id_usuario']) && !isset($_SESSION['id_empresa'])) {
    die('Você não pode acessar esta página porque não está logado.<p><a href="login.php">Entrar</a></p>');
}

if (isset($_SESSION['id_empresa'])) {
    $idEmpresa = $_SESSION['id_empresa'];

    // Consulta os dados da tabela "empresas" com base no id_empresa
    $sql = "SELECT * FROM empresas WHERE id_empresa = :idEmpresa";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idEmpresa', $idEmpresa);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Obtém os dados da empresa
        $empresa = $stmt->fetch(PDO::FETCH_ASSOC);
        $nome = $empresa['nome'];
        $endereco = $empresa['endereco'];
        $telefone = $empresa['telefone'];
        $cnpj = $empresa['cnpj'];
        $email = $empresa['email'];

        // Exiba os dados da empresa
        echo "Nome: $nome<br>";
        echo "Endereço: $endereco<br>";
        echo "Telefone: $telefone<br>";
        echo "CNPJ: $cnpj<br>";
        echo "Email: $email<br>";

        // Você pode adicionar mais campos aqui, se necessário

    } else {
        echo "Nenhum dado de empresa encontrado.";
    }
} else {
    echo "Usuário inválido.";
}
?>
