<head>
  <link rel="stylesheet" href="CSS/index.css">
</head>
<div class="container">
    <div class="form-image">
        <img src="IMAGENS/ICONE-LOGO.png" alt="Imagem de fundo">
    </div>
    <div class="form-split-container">
        <div class="form-split left">
          <br>
            <img src="IMAGENS/ICONE-USUARIO.png" alt="ICONE CLIENTE">
            <br>
            <br>
            <h2 style="border: solid 2px black; border-radius: 5px; background-color: #fde3a7d7; color: black; width: 200px; height: 50px; padding-top: 10px;"> Sou Cliente </h2>
            <button style="border: solid 1px white; border-radius: 5px;" class="btn-entrar" onclick="window.location.href='login.php'">ENTRAR</button>
            <br>
            <a href="cadastro_usuario.php" class="link-cadastrar" style="width: 248px;"> Não possui uma conta? Cadastre-se </a>
        </div>
        <div class="form-split right">
            <img src="IMAGENS/ICONE-LOJA.png" alt="ICONE LOJA">
            <br><br>
            <h2 style="border: solid 2px black; border-radius: 5px; background-color: #fde3a7d7; color: black; width: 200px; height: 50px; padding-top: 10px;"> Sou Loja</h2>
            <button style="border: solid 1px white; border-radius: 5px;" class="btn-entrar" onclick="window.location.href='login.php'">ENTRAR</button>
            <br>
            <a href="cadastro_empresa.php" class="link-cadastrar" style="width: 105px;"> Venda conosco <br> Cadastre-se </a>
        </div>
    </div>
</div>
