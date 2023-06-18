<?php
include("conn.php");
$email = $_POST['email'];
$senha = $_POST['senha'];

$usuariosQuery = $pdo->prepare('SELECT * FROM usuarios WHERE email = :email AND senha = :senha');
$usuariosQuery->execute(array(':email' => $email, ':senha' => $senha));
$usuariosResult = $usuariosQuery->fetchAll();

$empresasQuery = $pdo->prepare('SELECT * FROM empresas WHERE email = :email AND senha = :senha');
$empresasQuery->execute(array(':email' => $email, ':senha' => $senha));
$empresasResult = $empresasQuery->fetchAll();

if (empty($usuariosResult) && empty($empresasResult)) {
    echo "<script>
    alert('Login inválido, Email ou Senha não encontrados');
    window.location.href='login.php';
    </script>";
} else {
    if (!isset($_SESSION)) {
        $_SESSION['id_usuario'] = $user['id_usuario'];
        $_SESSION['nome_usuario'] = $user['nome_usuario'];
        $_SESSION['email'] = $user['email'];
        session_start();
    }

    if (!empty($usuariosResult)) {
        $usuario = $usuariosResult[0];
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['endereco'] = $usuario['endereco'];
        $_SESSION['email'] = $usuario['email'];
    } elseif (!empty($empresasResult)) {
        $empresa = $empresasResult[0];
        $_SESSION['id_empresa'] = $empresa['id_empresa'];
        $_SESSION['email'] = $empresa['email'];
    }

    header("Location: main.php");
}
?>