<?php
$includeNavbar = true;
if ($includeNavbar) {
    include("navbar.php"); // Inclui a navbar
}

// Dados do banco de dados (faça a conexão com o seu banco)
require("conn.php");

try {
    // Consultar os dados do usuário no banco de dados
    $idUsuario = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuarios WHERE id_usuario = :idUsuario";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idUsuario', $idUsuario);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/perfil.css">
    <title>Perfil</title>
</head>

<body>
    <h1>Seu Perfil</h1>

    <form action="CRUD/editar_perfil.php" method="POST">
        <input type="hidden" name="idUsuario" value="<?php echo $usuario['id_usuario']; ?>">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo $usuario['nome_usuario']; ?>" disabled><br>

        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" id="cpf" value="<?php echo $usuario['cpf']; ?>" disabled readonly><br>

        <label for="endereco">Endereço:</label>
        <input type="text" name="endereco" id="endereco" value="<?php echo $usuario['endereco']; ?>" disabled><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $usuario['email']; ?>" disabled readonly><br>
        <br>
        <button type="button" onclick="habilitarEdicao()">Atualizar dados</button>
        <button type="submit" name="salvar" id="salvar" disabled>Salvar alterações</button>
    </form>

    <script>
        function habilitarEdicao() {
            document.getElementById("nome").disabled = false;
            document.getElementById("cpf").disabled = false;
            document.getElementById("endereco").disabled = false;
            document.getElementById("email").disabled = false;
            document.getElementById("salvar").disabled = false;
        }
    </script>
</body>

</html>
