<?php
    $includeNavbar = true;
    if ($includeNavbar) {
        include("navbar.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="CSS/main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            <?php
            session_start();
            if (isset($_SESSION['login_status'])) {
                if ($_SESSION['login_status'] === 'success') {
                    $nome_usuario = $_SESSION['nome_usuario'];
                    echo "showPopup('Bem-vindo, $nome_usuario!', 'success-popup');";
                } elseif ($_SESSION['login_status'] === 'error') {
                    echo "showPopup('Usuário e/ou senha inválidos!', '');";
                }
                unset($_SESSION['login_status']);
            }
            ?>

            function showPopup(message, styleClass) {
                var popup = $('<div></div>').addClass('popup').addClass(styleClass);
                var popupMessage = $('<p></p>').text(message);

                popup.append(popupMessage);

                $('body').append(popup);

                setTimeout(function() {
                    popup.addClass('fadeOut');
                    setTimeout(function() {
                        popup.remove();
                    }, 1000);
                }, 8000);
            }
        });
    </script>
</head>
<body>
</body>
</html>
