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
        <link rel="stylesheet" href="css/item.css"/>
        <script src="js/main.js"></script>
        <title>En salle - Adidas</title>
    </head>
    <body class="background-color">
        <?php
            require_once("header.php");
        ?>
        <div class="container-item">
            <a href="index.php">Accueil</a> 
            /
            <a href="adidas-m-w.php">Adidas - Homme & Femme</a>
            /
            <a href="5-m-w-a.php">En salle</a>
            <br>
            <br>
            <h2>CHAUSSURES DE FOOTBALL POUR HOMME & FEMME - ADIDAS</h2>
            <br>
            <div class="container-flex">
                <?php
                $sql = "SELECT * FROM product WHERE brand ='Adidas' AND shoesCategory = 'Homme & Femme' AND typeOfShoes = 'En salle' ";
                $stmt = $pdo->query($sql);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $id = $row["ID_Product"];
                    $name = $row["shoesName"];
                    $price = $row["shoesPrice"];
                    $type = $row["typeOfShoes"];
                    $image = "img/item/" . $id . ".png";
                    $stock = $row["stock"];

                    $isAvailable = ($stock > 0) ? true : false;
                    $availabilityClass = ($isAvailable) ? "" : "unavailable";
                    
                    echo "<div class='container-product'>";
                    echo "<div class='img-product'><a href='spe-product.php?id=" . $id . "'><img src='" . $image . "' /></a></div>";
                    if (!$isAvailable) {
                        echo "<div class='overlay-text'>Indisponible</div>";
                    }
                    echo "<div class='product-name'>" . $name . "</div>";
                    echo "<div class='product-price'>" . $price . ' €' . "</div>";
                    echo "<div class='product-type'>" . $type . "</div>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
        <!-- <footer>
            <p>© 2023 - FootballShoes</p>
        </footer> -->
    </body>
</html>