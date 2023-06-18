<?php

function mostrarMensagemErro($exception) {
    if ($exception->getCode() === '23000') {
        // Erro de chave duplicada (código 23000)

        // Extraia o valor duplicado do campo cpf ou email do erro
        preg_match("/Duplicate entry '(.*?)' for key '(cpf|email)'/", $exception->getMessage(), $matches);
        $valorDuplicado = isset($matches[1]) ? $matches[1] : '';
        $campoDuplicado = isset($matches[2]) ? $matches[2] : '';

        // Exiba uma mensagem de erro mais amigável para o usuário
        if ($campoDuplicado === 'cpf') {
            echo "<script>alert('O CPF: $valorDuplicado já está cadastrado. Por favor, insira um CPF diferente.');</script>";
        } elseif ($campoDuplicado === 'email') {
            echo "<script>alert('O e-mail: $valorDuplicado já está cadastrado. Por favor, insira um e-mail diferente.');</script>";
        }
        
        // Encerre a execução do script para evitar que o restante do código seja executado
        exit;
    } else {
        // Outros erros
        // Exiba o erro padrão
        echo "Erro: " . $exception->getMessage();
        exit;
    }
}


try {
    require('../conn.php');

    $nome_usuario = $_POST['nome_usuario'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if (empty($nome_usuario) || empty($cpf) || empty($endereco) || empty($email) || empty($senha)) {
        echo "Os valores não podem ser vazios";
    } elseif (!preg_match('/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/', $cpf)) {
        echo "CPF inválido. Por favor, insira um CPF válido no formato xxx.xxx.xxx-xx.";
    } else {
        $cad_usuarios = $pdo->prepare("INSERT INTO usuarios(nome_usuario, cpf, endereco, email, senha) 
            VALUES(:nome_usuario, :cpf, :endereco, :email, :senha)");
        $cad_usuarios->execute(array(
            ':nome_usuario' => $nome_usuario,
            ':cpf' => $cpf,
            ':endereco' => $endereco,
            ':email' => $email,
            ':senha' => $senha
        ));

        echo "<script>
                alert('Usuário cadastrado com sucesso!!!');
                window.location.href='login.php';
            </script>";
    }
} catch (PDOException $e) {
    mostrarMensagemErro($e);
}
?>
