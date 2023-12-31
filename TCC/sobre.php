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
        <div class="title">Sobre Nós</div>
        <div class="text" style="text-align:justify">
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
    </div>
    
    <div class="team-section">
        <div class="team-title">Alunos</div>
        <div class="team-members">
            <div class="team-member">
                <div class="member-image">
                    <img src="IMAGENS/CHARLES.png" alt="Charles Eduardo Meireles Silva">
                </div>
                <div class="member-info">
                    <div class="member-name">Charles Eduardo Meireles Silva</div>
                    <div class="member-role">Front-End</div>
                </div>
            </div>
            <div class="team-member">
                <div class="member-image">
                    <img src="IMAGENS/LANGLEBER.png" alt="Nome do Desenvolvedor">
                </div>
                <div class="member-info">
                    <div class="member-name">Langleber das Chagas Moreira</div>
                    <div class="member-role">Front-End</div>
                </div>
            </div>
            <div class="team-member">
                <div class="member-image">
                    <img src="IMAGENS/Dlucca.png" alt="Nome do Desenvolvedor">
                </div>
                <div class="member-info">
                    <div class="member-name">Luan Dlucca Santos Ramalho</div>
                    <div class="member-role">Back-End</div>
                </div>
            </div>
            <div class="team-member">
                <div class="member-image">
                    <img src="IMAGENS/PEDRINI.png" alt="Nome do Desenvolvedor">
                </div>
                <div class="member-info">
                    <div class="member-name">Pedrini Henrique Coelho Pedrini</div>
                    <div class="member-role">Escritor Técnico</div>
                </div>
            </div>
            <div class="team-member">
                <div class="member-image">
                    <img src="IMAGENS/RAYLAN.png" alt="Nome do Desenvolvedor">
                </div>
                <div class="member-info">
                    <div class="member-name">Raylan da Conceição Freire</div>
                    <div class="member-role">Back-End</div>
                </div>
            </div>
        </div>
    </div>

    <div class="team-section">
        <div class="team-title">Instrutores</div>
        <div class="team-members">
            <div class="team-member">
                <div class="member-image">
                    <img src="IMAGENS/RENISSON.png" alt="Nome do Desenvolvedor">
                </div>
                <div class="member-info">
                    <div class="member-name">Renisson</div>
                    <div class="member-role">Orientador Técnico</div>
                </div>
            </div>
            <div class="team-member">
                <div class="member-image">
                    <img src="IMAGENS/ISABEL.png" alt="Nome do Desenvolvedor">
                </div>
                <div class="member-info">
                    <div class="member-name">Isabel</div>
                    <div class="member-role">Orientadora Técnico</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
