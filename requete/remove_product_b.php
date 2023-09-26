<?php
require_once("../db.php");
if (isset($_GET['productID'])) {
    $productID = $_GET['productID'];

    $sql = "DELETE FROM basket WHERE ID_Product = :productID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':productID', $productID);
    $result = $stmt->execute();

    if ($result) {
        sleep(1);
        header("Location: /Vente/basket.php");
    } else {
        echo "Une erreur s'est produite lors de la suppression du produit.";
    }
} else {
    echo "ID du produit non spécifié.";
}
?>
