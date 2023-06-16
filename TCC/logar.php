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
    alert('Usuário e/ou senha inválidos!');
    window.location.href='TCC/login.php';
    </script>";
} else {
    if (!isset($_SESSION)) {
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

    header("Location: catalogo_luan.php");
}
?>