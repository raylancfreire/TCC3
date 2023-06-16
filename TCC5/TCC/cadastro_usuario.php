<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Cadastro de Usuários</title>
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="stylesheet" href="CSS/login2.css">
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
                        <h1>Cadastro de Cliente</h1>
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label for="nome_usuario">Nome</label>
                        <input id="nome_usuario" type="text" name="nome_usuario" placeholder="Digite seu nome" required>
                    </div>

                    <div class="input-box">
                        <label for="cpf">CPF</label>
                        <input id="cpf" type="text" name="cpf" maxlength="14" placeholder="Digite seu CPF" required>
                    </div>
                    
                    <div class="input-box">
                        <label for="endereco">Endereço</label>
                        <input id="endereco" type="text" name="endereco" placeholder="Digite seu endereço" required>
                    </div>

                    <div class="input-box">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" placeholder="Digite seu email" required>
                    </div>

                    <div class="input-box">
                        <label for="senha">Senha</label>
                        <input id="senha" type="password" name="senha" placeholder="Digite sua senha" required>
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

    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    
    <script>
        // Função para formatar o CPF com pontos e traço
        function formatarCPF(cpf) {
            cpf = cpf.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona um ponto após os primeiros três dígitos
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona um ponto após os segundos três dígitos
            cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); // Adiciona um traço antes dos dois últimos dígitos
            return cpf;
        }

        // Formata o CPF enquanto o usuário digita e limita a 14 dígitos
        $('#cpf').on('input', function() {
            var cpf = $(this).val();
            cpf = formatarCPF(cpf);
            $(this).val(cpf);

            // Limita o campo a 14 dígitos
            if ($(this).val().length > 14) {
                $(this).val($(this).val().slice(0, 14));
            }
        });

        $("#formulario").submit(function(event) {
            event.preventDefault();
            var dados = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: 'CRUD/cad_usuario.php',
                data: dados,
                success: function(data) {
                    $("#resultado").html(data);
                }
            });
        });
    </script>
</body>

</html>
