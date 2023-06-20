<?php
require("../conn.php");

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id_pedido"])) {
    $pedidoId = $_GET["id_pedido"];

    // Query the order from the database
    $sql = "SELECT path FROM pedidos WHERE id_pedido = :pedidoId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':pedidoId', $pedidoId);
    $stmt->execute();
    $pedido = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the path exists
    if (!empty($pedido['path'])) {
        $filePath = $pedido['path'];
        $fileName = basename($filePath);

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
        } else {
            echo "<script>
                alert('O arquivo não está disponível para download.');
                window.location.href='../pedidos.php';
            </script>";
        }
    } else {
        echo "O comprovante não está disponível.";
    }
} else {
    echo "Pedido inválido.";
}
?>
