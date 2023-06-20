<?php
require("../conn.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pedidoId = $_POST["id_pedido"];
    $comprovante = $_FILES["comprovante"];

    // Verificar se o arquivo foi enviado com sucesso
    if ($comprovante["error"] === UPLOAD_ERR_OK) {
        $fileTmpName = $comprovante["tmp_name"];

        // Abrir o arquivo em modo binário
        $fileHandle = fopen($fileTmpName, 'rb');

        // Ler o conteúdo do arquivo
        $fileContent = fread($fileHandle, filesize($fileTmpName));

        // Fechar o arquivo
        fclose($fileHandle);

        // Atualizar o banco de dados com o conteúdo do comprovante
        $sql = "UPDATE pedidos SET status_pedido = 'Pix Enviado', comprovante_pix = :comprovante WHERE id_pedido = :pedidoId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':comprovante', $fileContent, PDO::PARAM_LOB);
        $stmt->bindParam(':pedidoId', $pedidoId);
        $stmt->execute();

        // Redirecionar de volta para a página de Meus Pedidos

        echo "<script>
            alert('Comprovante enviado com sucesso!!!');
            window.location.href='../meus_pedidos.php';
        </script>";
    }
}
?>