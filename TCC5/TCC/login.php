<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="stylesheet" href="CSS/login2.css">
    <link rel="stylesheet" href="CSS/login3.css">
</head>

<body>
    <div class="container">
        <div class="form-image">
            <img src="IMAGENS/ICONE-LOGO2.png" alt="">
        </div>
        <div class="form">
            <form action="logar.php" method="post">
                <div class="form-header">
                    <div class="title">
                        <h1>Login</h1>
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label for="email">Email</label>
                        <input id="" type="text" name="email" placeholder="Digite seu email" required>
                    </div>
                    
                    <div class="input-box">
                        <label for="senha">Senha</label>
                        <input id="" type="password" name="senha" placeholder="Digite sua senha" required>
                    </div>
                </div>

                <div class="continue-button">
                    <br>
                    <input type="submit" class="btn-cadastrar" value="CONTINUAR">
                </div>
                <div>
                    <br><br>
                    <p>Não possui uma conta? <a href="index.php" class="link-entrar">Cadastre-se como Cliente ou Loja</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>