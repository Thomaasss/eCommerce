<?php
require_once("../db.php");

$productID = $_POST['productID'];
$quantity = $_POST['quantity'];

$sql = "SELECT stock FROM product WHERE ID_Product = :productID";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':productID', $productID);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $availableQuantity = $result['stock'];
    if ($quantity <= $availableQuantity) {
        $sqlUpdate = "UPDATE basket SET quantity = :quantity WHERE ID_Product = :productID";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':quantity', $quantity);
        $stmtUpdate->bindParam(':productID', $productID);
        $resultUpdate = $stmtUpdate->execute();

        if ($resultUpdate) {
            sleep(1);
            header("Location: /Vente/basket.php");
        }
    } else {
        // La quantité demandée dépasse la quantité disponible, affichez un message d'erreur
        header("Location: /Vente/basket.php?quantityError=1");
    }
}
?>
