<!DOCTYPE html>
<html>
<head>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .error-message {
            text-align: center;
            font-size: 20px;
            padding: 20px;
            background-color: #fde3a7d7;
            border: 1px solid whitesmoke;
            margin-bottom: 150px;

        }

        .center-image {
            max-width: calc(75% - 75px);
            margin-bottom: 20px;
        }

        .error-message a {
            color: #721c24;
            text-decoration: underline;
        }
        
        .login-button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            margin-top: 10px;
        }
        
        .login-button-blue {
            background-color: #8ba9c7;
            
        }
    </style>
</head>
<body>
<?php
require("conn.php");

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id_usuario']) && !isset($_SESSION['id_empresa'])) {
    echo '<img src="IMAGENS/ICONE-LOGO.png" alt="Imagem" class="center-image">';
    echo '<div class="error-message">Você não pode acessar esta página porque não está logado.<p><a href="login.php"><button class="login-button login-button-blue">Ir para login</button></a></p></div>';
    exit;
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
?>
</body>
</html>
