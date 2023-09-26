<?php
require_once("../db.php");
session_start();

if (isset($_SESSION['id'])) {
    $userID = $_SESSION['id'];

    if (isset($_GET['productID'])) {
        $productID = $_GET['productID'];

        $sql = "SELECT ID_Product, shoesSize FROM favorites WHERE ID_User = :userID AND ID_Product = :productID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':productID', $productID);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $shoesSize = $row['shoesSize'];

            $sql = "INSERT INTO basket (ID_User, ID_Product, quantity, shoesSize) VALUES (:userID, :productID, 1, :shoesSize)";
            $stmtTransfer = $pdo->prepare($sql);
            $stmtTransfer->bindParam(':userID', $userID);
            $stmtTransfer->bindParam(':productID', $productID);
            $stmtTransfer->bindParam(':shoesSize', $shoesSize);
            $transferResult = $stmtTransfer->execute();

            $sql = "DELETE FROM favorites WHERE ID_User = :userID AND ID_Product = :productID";
            $stmtDelete = $pdo->prepare($sql);
            $stmtDelete->bindParam(':userID', $userID);
            $stmtDelete->bindParam(':productID', $productID);
            $deleteResult = $stmtDelete->execute();

            if ($transferResult && $deleteResult) {
                sleep(1);
                header("Location: /Vente/basket.php");
            } else {
                echo "Une erreur s'est produite lors du transfert du produit.";
            }
        } else {
            echo "Ce produit n'existe pas dans votre liste de favoris.";
        }
    } else {
        echo "Aucun produit spécifié.";
    }
} else {
    echo "Vous devez être connecté pour effectuer cette action.";
}
?>