<?php
require("../conn.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pedidoId = $_POST["id_pedido"];
    $comprovante = $_FILES["comprovante"];

    // Verificar se o arquivo foi enviado com sucesso
    if ($comprovante["error"] === UPLOAD_ERR_OK) {
        $fileTmpName = $comprovante["tmp_name"];
        $fileName = basename($comprovante["name"]);

        // Diretório onde os comprovantes serão salvos
        $uploadDir = "../comprovantes/";

        // Caminho completo do arquivo no servidor
        $uploadPath = $uploadDir . $fileName;

        // Salvar o arquivo na pasta de comprovantes
        if (move_uploaded_file($fileTmpName, $uploadPath)) {
            // Atualizar o banco de dados com o conteúdo do comprovante e o caminho do arquivo
            $sql = "UPDATE pedidos SET status_pedido = 'Pix Enviado', comprovante_pix = :comprovante, path = :path WHERE id_pedido = :pedidoId";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':comprovante', file_get_contents($uploadPath));
            $stmt->bindParam(':path', $uploadPath);
            $stmt->bindParam(':pedidoId', $pedidoId);
            $stmt->execute();

            // Redirecionar de volta para a página de Meus Pedidos
            echo "<script>
                alert('Comprovante enviado com sucesso!');
                window.location.href='../meus_pedidos.php';
            </script>";
        } else {
            echo "<script>
                alert('Falha ao enviar o comprovante.');
                window.location.href='../meus_pedidos.php';
            </script>";
        }
    }
}
?>
