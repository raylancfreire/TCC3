<?php
require ('../conn.php');
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pedidoId = $_POST["id_pedido"];
    $comprovante = $_FILES["comprovante"];

    // Verificar se o arquivo foi enviado com sucesso
    if ($comprovante["error"] === UPLOAD_ERR_OK) {
        $fileTmpName = $comprovante["tmp_name"];

        // Define o diretório de destino
        $destino = "../comprovante/";

        // Define o novo nome do arquivo
        $novoNomeDoArquivo = uniqid() . "." . pathinfo($comprovante["name"], PATHINFO_EXTENSION);

        // Move o arquivo para o diretório de destino
        $funciona = move_uploaded_file($fileTmpName, $destino . $novoNomeDoArquivo);

        if ($funciona) {
            // Atualizar o banco de dados com o nome do arquivo de comprovante
            $sql = "UPDATE pedidos SET status_pedido = 'Pix Enviado', comprovante_pix = :comprovante WHERE id_pedido = :pedidoId";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':comprovante', $novoNomeDoArquivo);
            $stmt->bindParam(':pedidoId', $pedidoId);
            $stmt->execute();

            // Redirecionar de volta para a página de Meus Pedidos
            echo "<script>
                alert('Comprovante enviado com sucesso!!!');
                window.location.href='../meus_pedidos.php';
            </script>";
        } else {
            echo "Falha ao enviar o comprovante.";
        }
    }
}
?>

// ...
