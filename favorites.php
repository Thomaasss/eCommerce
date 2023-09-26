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
        <title>Favoris</title>
    </head>
    <body>
        <?php
            require_once("header.php");
        ?>
        <div class="container-basket-and-favorites">
            <?php
            echo "<h1>Favoris</h1>";
            if (isset($_SESSION['id'])) {
                $userID = $_SESSION['id'];
                $sql = "SELECT p.ID_Product, p.shoesName, p.shoesPrice, f.shoesSize FROM favorites f INNER JOIN product p ON f.ID_Product = p.ID_Product WHERE f.ID_User = :userID";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':userID', $userID);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $productID = $row['ID_Product'];
                        $name = $row['shoesName'];
                        $price = $row['shoesPrice'];
                        $size = $row['shoesSize'];
                        $image = "img/item/" . $productID . ".png";

                        echo "<div class='container-product-basket-and-favorites'>";
                        echo "<p>$name</p>";
                        echo "<p>Prix du produit : " . $price . " €</p>";
                        echo "<p>Taille : " . $size . "</p>";
                        echo "<img src='" . $image . "' />";
                        echo "<div class='flex-img-trash-basket'>";
                        echo "<a href='requete/remove_product_f.php?productID=$productID'><img src='img/main-picture/trash.png' class='img-trash'></a>";
                        echo "<a href='requete/send_f_to_b.php?productID=$productID&shoesSize=$size'><img src='img/main-picture/basket.png' class='img-trash'></a>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<br>";
                    echo "<p style='color:white; font-weight:300'>Vos favoris sont vides.</p>";
                }
            } else {
                echo "<br>";
                echo "<p style='color:white; font-weight:300'>Vous devez être connecté pour accéder aux favoris.</p>";
            }
            ?>
        </div>
        <!-- <footer>
            <p>© 2023 - FootballShoes</p>
        </footer> -->
    </body>
</html>