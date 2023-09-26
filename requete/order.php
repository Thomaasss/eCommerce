<?php
require_once("../db.php");
session_start();

if (isset($_SESSION['id'])) {
    $userID = $_SESSION['id'];

    // Récupérer les produits dans le panier de l'utilisateur
    $sql = "SELECT b.ID_Product, b.quantity, p.stock, p.shoesName, p.shoesPrice, b.shoesSize FROM basket b INNER JOIN product p ON b.ID_Product = p.ID_Product WHERE b.ID_User = :userID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();

    // Tableau pour stocker les produits commandés
    $orderedProducts = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $productID = $row['ID_Product'];
        $quantity = $row['quantity'];
        $availableStock = $row['stock'];
        $size = $row['shoesSize'];
        $name = $row['shoesName'];
        $price = $row['shoesPrice'];

        if ($quantity <= $availableStock) {
            // Ajouter le produit commandé au tableau
            $orderedProducts[] = array('productID' => $productID, 'quantity' => $quantity);
        } else {
            // La quantité demandée dépasse la quantité disponible, affichez un message d'erreur
            header("Location: /Vente/basket.php?quantityError=1");
            exit();
        }
    }

    // Ajouter les produits commandés dans la table des commandes en attente
    if (!empty($orderedProducts)) {
        foreach ($orderedProducts as $orderedProduct) {
            $productID = $orderedProduct['productID'];
            $quantity = $orderedProduct['quantity'];
            // Vous pouvez également stocker d'autres informations ici, comme l'ID de l'utilisateur, la date de la commande, etc.

            // Insérer la commande en attente dans la nouvelle table "orders" par exemple
            $sqlInsert = "INSERT INTO orders (ID_User, ID_Product, shoesName, shoesPrice, shoesSize, quantity) VALUES (:userID, :productID, :name, :price, :size, :quantity)";
            $stmtInsert = $pdo->prepare($sqlInsert);
            $stmtInsert->bindParam(':userID', $userID);
            $stmtInsert->bindParam(':productID', $productID);
            $stmtInsert->bindParam(':name', $name);
            $stmtInsert->bindParam(':price', $price);
            $stmtInsert->bindParam(':size', $size);
            $stmtInsert->bindParam(':quantity', $quantity);
            $resultInsert = $stmtInsert->execute();

            if (!$resultInsert) {
                echo "Une erreur s'est produite lors de l'enregistrement de la commande en attente.";
            }
        }

        // Supprimer les produits du panier après validation
        $sqlDelete = "DELETE FROM basket WHERE ID_User = :userID";
        $stmtDelete = $pdo->prepare($sqlDelete);
        $stmtDelete->bindParam(':userID', $userID);
        $resultDelete = $stmtDelete->execute();

        if ($resultDelete) {
            // Mettre à jour le nombre de commandes de l'utilisateur
            $sqlUpdateUser = "UPDATE user SET nb_order = nb_order + 1 WHERE ID_User = :userID";
            $stmtUpdateUser = $pdo->prepare($sqlUpdateUser);
            $stmtUpdateUser->bindParam(':userID', $userID);
            $resultUpdateUser = $stmtUpdateUser->execute();
            
            if ($resultUpdateUser) {
                echo "Commande passée avec succès. Votre commande est en attente de validation.";
                echo "<br><a href='../index.php'>Accueil</a>";
            } else {
                echo "Une erreur s'est produite lors de la mise à jour du nombre de commandes.";
            }
        } else {
            echo "Une erreur s'est produite lors du traitement de la commande.";
        }
    } else {
        echo "Votre panier est vide. Veuillez ajouter des produits avant de passer une commande.";
    }
} else {
    echo "Vous devez être connecté pour passer une commande.";
}
?>
