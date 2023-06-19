<?php
$includeNavbar = true;
if ($includeNavbar) {
    include("navbar.php"); // Inclui a navbar
}
require("conn.php");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="CSS/sobre.css">
</head>
<body>
    <br><br><br>
    <div class="centered-container">
        <div class="title">Resumo</div>
        <div class="text">
            <p>
                Este sistema inovador foi desenvolvido como parte do nosso Trabalho de Conclusão de Curso no SENAI, no curso de Desenvolvimento de Sistemas. 
                Com foco na otimização do processo de compra de peças e produtos para carros, o sistema apresenta funcionalidades avançadas para atender às necessidades dos usuários. 
                É o resultado de uma pesquisa aprofundada e um trabalho dedicado para oferecer uma solução eficiente e prática no campo do desenvolvimento de sistemas.
            </p>
            <p>
                Primeiramente, o sistema disponibiliza aos usuários um catálogo abrangente de peças, oferecendo opções de busca pelo nome do produto. Isso permite que os usuários encontrem facilmente as peças desejadas, agilizando o processo de pesquisa e seleção.

                Além disso, o sistema implementa um sistema de comparação de preços entre diferentes fornecedores. 
                Essa funcionalidade auxilia os usuários na escolha da opção mais conveniente, permitindo que eles identifiquem as melhores ofertas e economizem dinheiro.

                Outro objetivo é agilizar o processo de compra em si. Os usuários têm a possibilidade de adicionar as peças desejadas ao carrinho de compras, visualizar um resumo detalhado dos itens selecionados e concluir a compra de forma eficiente. 
                Isso proporciona uma experiência mais ágil e conveniente para os usuários.
            </p>
            <p>
                Por fim, o sistema busca realizar melhorias contínuas com base no feedback dos usuários. 
                Isso envolve aprimorar a usabilidade do sistema, tornando-o mais intuitivo e fácil de usar, além de adicionar novas funcionalidades que possam agregar valor aos usuários.

                Os desenvolvedores desse sistema dedicaram-se intensamente, trabalhando incansavelmente dia e noite, para torná-lo uma realidade. Com comprometimento e esforço, 
                conseguiram criar uma solução avançada e eficiente, visando facilitar a compra de peças e produtos para carros, resultando em um projeto de TCC de sucesso.
            </p>
        </div>
        <div class="responsibles">
            <div class="responsibles-title">Responsáveis:</div>
            <div class="profile-container">
                <img class="profile-image" src="IMAGENS/CHARLES.png" alt="Responsável 1">
                <div class="profile-name">Charles Eduardo Meireles Silva</div>
            </div>
            <div class="profile-container">
                <img class="profile-image" src="IMAGENS/LANGLEBER.png" alt="Responsável 2">
                <div class="profile-name">Langleber das Chagas Moreira</div>
            </div>
            <div class="profile-container">
                <img class="profile-image" src="IMAGENS/DLUCCA.png" alt="Responsável 3">
                <div class="profile-name">Luan D'Lucca Santos Ramalho</div>
            </div>
            <div class="profile-container">
                <img class="profile-image" src="IMAGENS/PEDRINI.png" alt="Responsável 4">
                <div class="profile-name">Pedro Henrique Coelho Pedrini</div>
            </div>
            <div class="profile-container">
                <img class="profile-image" src="IMAGENS/RAYLAN.png" alt="Responsável 5">
                <div class="profile-name">Raylan da Conceição Freire</div>
            </div>
            <div class="responsibles-title">Responsáveis Técnicos:</div>
            <div class="profile-container">
                <img class="profile-image" src="IMAGENS/FOTO.png" alt="Responsável 6">
                <div class="profile-name">Renisson</div>
            </div>
            <div class="profile-container">
                <img class="profile-image" src="IMAGENS/ISABEL.png" alt="Responsável 6">
                <div class="profile-name">Isabel Bustamante</div>
            </div>
        </div>
    </div>
</body>
</html>
