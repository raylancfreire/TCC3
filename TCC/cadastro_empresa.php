<!DOCTYPE html>
<html>

<head>
    <title>Cadastro de Loja</title>
    <link rel="stylesheet" href="CSS/login.css">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        // Função para formatar o CNPJ
        function formatarCNPJ(cnpj) {
            cnpj = cnpj.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
            cnpj = cnpj.replace(/(\d{2})(\d)/, '$1.$2'); // Adiciona um ponto após os primeiros dois dígitos
            cnpj = cnpj.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona um ponto após os próximos três dígitos
            cnpj = cnpj.replace(/(\d{3})(\d)/, '$1/$2'); // Adiciona uma barra após os próximos três dígitos
            cnpj = cnpj.replace(/(\d{4})(\d)/, '$1-$2'); // Adiciona um traço antes do último dígito
            return cnpj;
        }

        $(document).ready(function() {
            $('#cnpj').on('input', function() {
                var cnpj = $(this).val();
                cnpj = formatarCNPJ(cnpj);
                $(this).val(cnpj);
            });

            $('#telefone').on('input', function() {
                var telefone = $(this).val();
                telefone = telefone.replace(/\D/g, '');
                telefone = telefone.replace(/(\d{2})(\d{1})(\d{1,4})(\d{1,4})$/, '($1) $2 $3-$4');
                $(this).val(telefone);
            });

            $("#formulario").submit(function(event) {
                event.preventDefault();
                var dados = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: 'CRUD/cad_empresa.php',
                    data: dados,
                    success: function(data) {
                        $("#resultado").html(data);
                    }
                });
            });
        });
    </script>
</head>

<body>
    <div class="container">
        <div class="form-image">
            <img src="IMAGENS/ICONE-LOGO2.png" alt="">
        </div>
        <div class="form">
            <form action="" method="post" id="formulario">
                <div class="form-header">
                    <div class="title">
                        <h1>Cadastre sua Loja</h1>
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>
                    </div>

                    <div class="input-box">
                        <label for="endereco">Endereço:</label>
                        <input type="text" id="endereco" name="endereco" placeholder="Digite seu endereço" required>
                    </div>

                    <div class="input-box">
                        <label for="telefone">Celular:</label>
                        <input type="text" id="telefone" name="telefone" placeholder="(XX) X XXXX-XXXX" maxlength="16" required>
                    </div>

                    <div class="input-box">
                        <label for="cnpj">CNPJ:</label>
                        <input type="text" id="cnpj" name="cnpj" placeholder="Digite seu nome" maxlength="18" required>
                    </div>

                    <div class="input-box">
                        <label for="chave_pix">PIX da Loja:</label>
                        <input type="text" id="chave_pix" name="chave_pix" placeholder="Digite o PIX" maxlength="50" required>
                    </div>


                    <div class="input-box">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" placeholder="Digite seu nome" required>
                    </div>

                    <div class="input-box">
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="senha" placeholder="Digite seu senha" maxlength="40" required>
                    </div>
                </div>

                <div class="continue-button">
                    <br>
                    <input type="submit" class="btn-cadastrar" value="CONTINUAR">
                </div>
                <div>
                    <br><br>
                    <p>Já possui uma conta? <a href="login.php" class="link-entrar">Entrar</a></p>
                </div>
            </form>
            <div id="resultado"></div>
        </div>
    </div>
</body>

</html>
