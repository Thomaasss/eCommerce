<?php
require_once("db.php");
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com/%22%3E"/>
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/main.css"/>
        <script src="js/main.js"></script>
        <title>Panier</title>
    </head>
    <body>
        <?php
            require_once("header.php");
        ?>
        <div class="container-basket-and-favorites">
            <?php
            echo "<h1>Panier</h1>";
            if (isset($_SESSION['id'])) {
                $userID = $_SESSION['id'];
                $sql = "SELECT p.ID_Product, p.shoesName, p.shoesPrice, b.quantity, b.shoesSize, p.stock FROM basket b INNER JOIN product p ON b.ID_Product = p.ID_Product WHERE b.ID_User = :userID";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':userID', $userID);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $productID = $row['ID_Product'];
                        $name = $row['shoesName'];
                        $price = $row['shoesPrice'];
                        $quantity = $row['quantity'];
                        $size = $row['shoesSize'];
                        $image = "img/item/" . $productID . ".png";
                        $availableStock = $row['stock'];

                        echo "<div class='container-product-basket-and-favorites'>";
                        echo "<p>$name</p>";
                        echo "<p>Prix du produit : " . $price . " €</p>";
                        echo "<p>Taille : " . $size . "</p>";
                        echo "<br>";
                        echo "<form action='requete/update-quantity.php' method='POST'>";
                        echo "<input type='hidden' name='productID' value='$productID'>";
                        echo "<p>Quantité : <input type='text' name='quantity' maxlength='1' max='$availableStock' value='$quantity'><input type='submit' value='Mettre à jour'></p>";
                        echo "</form>";
                        echo "<img src='" . $image . "' />";
                        echo "<div class='flex-img-trash-basket'>";
                        echo "<a href='requete/remove_product_b.php?productID=$productID'><img src='img/main-picture/trash.png' class='img-trash'></a>";
                        echo "</div>";
                        echo "</div>";

                    }
                    echo "<br><br>";
                    echo "<div class='send-order'>";
                    echo "<form action='requete/order.php' method='POST'>";
                    echo "<input type='submit' value='Commander'>";
                    echo "</form>";
                    echo "</div>";
                    echo "<br>";
                    if (isset($_GET['quantityError']) && $_GET['quantityError'] == 1) {
                        echo "<p style='color:red; font-weight:300'>La quantité demandée dépasse la quantité disponible.</p>";
                    }
                } else {
                    echo "<br>";
                    echo "<p style='color:white; font-weight:300'>Le panier est vide.</p>";
                }
            } else {
                echo "<br>";
                echo "<p style='color:white; font-weight:300'>Vous devez être connecté pour accéder au panier.</p>";
            }
            ?>
        </div>
        <!-- <footer>
            <p>© 2023 - FootballShoes</p>
        </footer> -->
    </body>
</html>