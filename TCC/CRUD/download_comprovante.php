<?php
require("../conn.php");

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["pedido_id"])) {
    $pedidoId = $_GET["pedido_id"];

    // Query the order from the database
    $sql = "SELECT comprovante_pix FROM pedidos WHERE id_pedido = :pedidoId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':pedidoId', $pedidoId);
    $stmt->execute();
    $pedido = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the comprovante_pix exists
    if (!empty($pedido['comprovante_pix'])) {
        $fileName = basename($pedido['comprovante_pix']);
        $filePath = "comprovantes/" . $fileName;

        // Check if the file exists on the server
        if (file_exists($filePath)) {
            // Set headers for file download
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$fileName");
            header("Content-Type: application/octet-stream");
            header("Content-Transfer-Encoding: binary");

            // Read the file and output it to the browser
            readfile($filePath);
            exit;
        } else {
            echo "O arquivo não está disponível para download.";
        }
    } else {
        echo "O comprovante não está disponível.";
    }
} else {
    echo "Pedido inválido.";
}
?>
