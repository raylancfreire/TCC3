<?php
session_start(); // Adiciona o session_start()

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
    window.location.href='login.php';
    </script>";
} else {
    if (!empty($usuariosResult)) {
        $usuario = $usuariosResult[0];
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['endereco'] = $usuario['endereco'];
        $_SESSION['email'] = $usuario['email'];

        // Código para exibir o pop-up
        echo "<script>
        window.onload = function() {
            showModal();
        };

        function showModal() {
            var modal = document.getElementById('myModal');
            modal.style.display = 'block';

            var span = document.getElementsByClassName('close')[0];

            span.onclick = function() {
                modal.style.display = 'none';
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            }
        }
        </script>";
    } elseif (!empty($empresasResult)) {
        $empresa = $empresasResult[0];
        $_SESSION['id_empresa'] = $empresa['id_empresa'];
        $_SESSION['email'] = $empresa['email'];
    }
    
    echo "<script>
    window.onload = function() {
        alert('Login efetuado com sucesso!');
    }
    </script>";

    header("Location: main.php");
}

?>

