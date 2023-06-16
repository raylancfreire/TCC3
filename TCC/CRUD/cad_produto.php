<?php
require("../conn.php");

if (isset($_FILES['imagem'])) {
    $arquivo = $_FILES['imagem'];
    $nome_produto = $_POST['nome_produto'];
    $descricao = $_POST['descricao'];
    $marca = $_POST['marca'];
    $categoria = $_POST['categoria'];
    $preco = $_POST['preco'];
    $quantidade_produto = $_POST['quantidade_produto'];
    $empresa = $_POST['empresa'];
    $id_empresa_cad = $_POST['id_empresa_cad'];
    
    $preco = str_replace(",", "", $preco);
    $preco = str_replace(".", "", $preco);
    $preco = substr_replace($preco, ".", -2, 0);


    if ($arquivo['error']) {
        die('Falha ao enviar o arquivo.');
    }

    if ($arquivo['size'] > 4097152) {
        die('Arquivo muito grande! O tamanho máximo permitido é 4MB.');
    }

    $pasta = "../upload/";
    $nomeDoArquivo = $arquivo['name'];
    $novoNomeDoArquivo = uniqid();
    $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

    if ($extensao != "jpg" && $extensao != "png") {
        die("Formato de arquivo não aceito. Apenas arquivos JPG e PNG são permitidos.");
    }

    $path = $pasta . $novoNomeDoArquivo . "." . $extensao;

    $funciona = move_uploaded_file($arquivo["tmp_name"], $path);
    if ($funciona) {
        $cad_prod = $pdo->prepare("INSERT INTO produtos (nome_produto, descricao, marca, categoria, preco, quantidade_produto, imagem, path, empresa, id_empresa_cad) VALUES (:nome_produto, :descricao, :marca, :categoria, :preco, :quantidade_produto, :imagem, :path, :empresa, :id_empresa_cad)");
        $cad_prod->bindParam(':nome_produto', $nome_produto);
        $cad_prod->bindParam(':descricao', $descricao);
        $cad_prod->bindParam(':marca', $marca);
        $cad_prod->bindParam(':categoria', $categoria);
        $cad_prod->bindParam(':preco', $preco);
        $cad_prod->bindParam(':quantidade_produto', $quantidade_produto);
        $cad_prod->bindParam(':imagem', $nomeDoArquivo);
        $cad_prod->bindParam(':path', $path);
        $cad_prod->bindParam(':empresa', $empresa);
        $cad_prod->bindParam(':id_empresa_cad', $id_empresa_cad);
        $cad_prod->execute();
    }
        ?>
    
    <!DOCTYPE html>
    <html>
    <head>
        <title>Pop-up</title>
        <!DOCTYPE html>
    <html>
    <head>
        <link rel="stylesheet" href="../CSS/popup.css">
        <title>Pop-up</title>
    </head>
    <body>
        <div class="popup-wrapper">
            <div class="popup">
                <img src="../IMAGENS/cadastro2.png" alt="" class="popup-img">
                <div class="texto">
                <h2>Produto cadastrado com sucesso</h2>
                <p>O seu produto foi cadastrado com sucesso.</p>
                <div class="close">
                <a href="../catalogo_luan.php">Fechar</a>
                </div>
                </div>
            </div>
        </div>
    </body>
    </html>
    
    
    <?php        
        } else {
            echo "<p>Falha ao enviar o arquivo.</p>";
        }
    ?>
