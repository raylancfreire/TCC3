<?php
$includeNavbar = true;
if ($includeNavbar) {
    include("navbar.php"); // Inclui a navbar
}
require("conn.php");

// Verifica se o cookie foi definido para exibir o pop-up
if (!isset($_COOKIE["popupShown"])) {
    setcookie("popupShown", "true", time() + (86400 * 1), "/"); // Define o cookie por 30 dias
    $showPopup = true;
} else {
    $showPopup = false;
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="CSS/main.css">
    <title>Pop-up com Janela Modal</title>
</head>
<body>
    <div class="centered-image">
        <img src="IMAGENS/card.png" alt="Minha Imagem">
    </div>
    <?php if ($showPopup) : ?>
    <div id="myModal" class="modal center-modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Login efetuado com sucesso!</p>
        </div>
    </div>

    <script>
        // Função para exibir o pop-up
        function showModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "block";

            var span = document.getElementsByClassName("close")[0];

            // Função para fechar o pop-up ao clicar no botão Fechar (x)
            span.onclick = function() {
                modal.style.display = "none";
            }

            // Função para fechar o pop-up ao clicar fora da janela modal
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }

        // Chamar a função showModal quando a página for carregada
        window.onload = showModal;
    </script>
    <?php endif; ?>
</body>
</html>