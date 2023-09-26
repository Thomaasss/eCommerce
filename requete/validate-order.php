<?php
require_once("../db.php");

// Récupérer la quantité commandée pour cette commande
$sqlQuantity = "SELECT ID_Product, quantity FROM orders WHERE ID_Order = :orderID";
$stmtQuantity = $pdo->prepare($sqlQuantity);
$stmtQuantity->bindParam(':orderID', $_POST['orderID']);
$stmtQuantity->execute();
$orderData = $stmtQuantity->fetch(PDO::FETCH_ASSOC);

if ($orderData) {
    $productID = $orderData['ID_Product'];
    $quantityOrdered = $orderData['quantity'];

    // Récupérer le stock actuel du produit
    $sqlStock = "SELECT stock FROM product WHERE ID_Product = :productID";
    $stmtStock = $pdo->prepare($sqlStock);
    $stmtStock->bindParam(':productID', $productID);
    $stmtStock->execute();
    $productData = $stmtStock->fetch(PDO::FETCH_ASSOC);

    if ($productData) {
        $currentStock = $productData['stock'];

        if ($currentStock >= $quantityOrdered) {
            // Mettre à jour le stock après validation
            $updatedStock = $currentStock - $quantityOrdered;

            $sqlUpdateStock = "UPDATE product SET stock = :updatedStock WHERE ID_Product = :productID";
            $stmtUpdateStock = $pdo->prepare($sqlUpdateStock);
            $stmtUpdateStock->bindParam(':updatedStock', $updatedStock);
            $stmtUpdateStock->bindParam(':productID', $productID);
            $resultUpdateStock = $stmtUpdateStock->execute();

            if (!$resultUpdateStock) {
                echo "Une erreur s'est produite lors de la mise à jour du stock du produit.";
            }
        } else {
            echo "Erreur : Le stock actuel du produit est insuffisant pour valider la commande.";
        }
    } else {
        echo "Erreur : Impossible de récupérer les informations du produit.";
    }
} else {
    echo "Erreur : Impossible de récupérer les informations de la commande.";
}

// Mettre à jour le statut de la commande comme "Validée" (statut = 2)
$sqlUpdateStatus = "UPDATE orders SET status = 2 WHERE ID_Order = :orderID";
$stmtUpdateStatus = $pdo->prepare($sqlUpdateStatus);
$stmtUpdateStatus->bindParam(':orderID', $_POST['orderID']);
$resultUpdateStatus = $stmtUpdateStatus->execute();

if ($resultUpdateStatus) {
    sleep(1);
    header("Location: ../admin-panel.php");
} else {
    echo "Une erreur s'est produite lors de la validation de la commande.";
}

