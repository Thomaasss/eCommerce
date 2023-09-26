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
        <?php
        $id = $_GET["id"];
        $sql = "SELECT shoesName FROM product WHERE ID_Product = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $name = $row["shoesName"];
            echo "<title>" . $name . " </title>";
        }
        ?>
    </head>
    <body class="background-color">
        <?php
            require_once("header.php");
        ?>
        <div class="container-spe-item">
            <a href="index.php">Accueil</a>
            <?php
            $id = $_GET["id"];
            $sql = "SELECT brand, shoesCategory, pagePrefix, shoesName, typeOfShoes, typePrefix FROM product WHERE ID_Product = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $brand = $row["brand"];
                $category = $row["shoesCategory"];
                $prefix = $row["pagePrefix"];
                $name = $row["shoesName"];
                $type = $row["typeOfShoes"];
                $typeprefix = $row["typePrefix"];
                echo " / <a href='$prefix.php'>" . $brand . " - " . $category . "</a>";
                echo " / <a href='$typeprefix.php'>" . $type . "</a>";
                echo " / <a href='spe-product.php?id=$id'>" . $name . "</a>";
            }
            ?>
            <div class="container-spe-left">
                <div class="container-spe-right">
                <?php
                $id = $_GET["id"];

                // Récupérer les informations principales du produit
                $sql = "SELECT brand, shoesCategory, typeOfShoes, shoesName, shoesPrice FROM product WHERE ID_Product = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $brand = $row["brand"];
                    $category = $row["shoesCategory"];
                    $typeofshoes = $row["typeOfShoes"];
                    $name = $row["shoesName"];
                    $price = $row["shoesPrice"];
                    echo "<h1>" . $name . "</h1>";
                    echo "<h4>" . $typeofshoes . "</h4>";
                    echo "<br>";
                    echo "<h4>" . $price . " €</h4>";
                    echo "<br>";
                    
                    echo "<div class='container-different-shoes'>";
                    // Récupérer les autres chaussures du même modèle
                    $sql = "SELECT brand, shoesCategory, shoesName, typeOfShoes, stock, ID_Product FROM product 
                            WHERE shoesName = (SELECT shoesName FROM product WHERE ID_Product = :id) 
                            AND typeOfShoes = (SELECT typeOfShoes FROM product WHERE ID_Product = :id)
                            AND shoesCategory = (SELECT shoesCategory FROM product WHERE ID_Product = :id)
                            AND ID_Product != :id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    if ($stmt->rowCount() > 0) {
                        echo "<h4>Chaussures disponibles sous différentes couleurs:</h4>";
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $image = "img/item/" . $row['ID_Product'] . ".png";
                            $stock = $row['stock'];
                            $isAvailable = ($stock > 0) ? true : false;
                            $class = $isAvailable ? "" : "unavailable-shoe";
                            echo "<a href='spe-product.php?id=" . $row['ID_Product'] . "' class='" . $class . "'><img src='" . $image . "' /></a>";
                        }
                    }
                    echo "</div>";
                    echo "<br/>";
                    
                    echo "<div class='container-size'>";
                    echo "<h4>Sélectionner la taille<h4>";
                    // Récupérer les tailles disponibles pour le produit
                    $sql = "SELECT p.ID_Product as 'IdProd', p.shoesName as 'nomProd', p.shoesPrice as 'priceProd', t.size as 'theSize' 
                            FROM product p 
                            JOIN shoesize t ON p.ID_Product = t.ID_Product 
                            WHERE p.ID_Product = :id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    $currentSize = "Aucune";
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<button onclick='updateSize(\"" . $row['theSize'] . "\")'>" . $row['theSize'] . "</button>";
                    }
                    echo "<h4>Taille choisie: <span id='currentSize'>$currentSize</span></h4>";
                    echo "</div>";
                    echo "<br/>";
                    
                    echo "<div class='button-basket-favorites'>";
                    echo "<div id='size-warning'></div>";
                    echo "<form method='POST' action='requete/add-to-basket.php' onsubmit='return checkSize()'>";
                    echo "<input type='hidden' name='get-id-product' value='$id'>";
                    echo "<input type='hidden' name='get-name' value='$name'>";
                    echo "<input type='hidden' name='get-price' value='$price'>";
                    echo "<input type='hidden' name='get-size' id='size-for-basket'>";
                    echo "<button type='submit'>Ajouter au panier</button>";
                    echo "</form>";

                    echo "<form method='POST' action='requete/add-to-favorites.php' onsubmit='return checkSize()'>";
                    echo "<input type='hidden' name='get-id-product' value='$id'>";
                    echo "<input type='hidden' name='get-name' value='$name'>";
                    echo "<input type='hidden' name='get-price' value='$price'>";
                    echo "<input type='hidden' name='get-size' id='size-for-favorites'>";
                    echo "<button type='submit'>Ajouter au favoris</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "</br>";
                    
                    echo "<div>";
                    // Récupérer la description et les détails du produit
                    $sql = "SELECT shoesDescription, shoesDetails FROM product WHERE ID_Product = :id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $description = $row["shoesDescription"];
                        $details = $row["shoesDetails"];
                        echo "<h3>Description</h3>";
                        echo "</br>";
                        $description = preg_replace("/\.\s/", ".</br></br>", $description);
                        echo "<h4>" . $description . "</h4>";
                        echo "</br>";
                        echo "<h3>Détails</h3>";
                        echo "</br>";
                        $details = preg_replace("/\.\s/", ".</br></br>", $details);
                        echo "<h4>" . $details . "</h4>";
                    }
                    echo "</div>";
                    echo "</br>";
                    echo "<h3>Note du produit</h3>";
                    echo "</br>";
                    
                    if (isset($_SESSION['id'])) {
                        $userId = $_SESSION['id'];
                    
                        // Vérifier si l'utilisateur a déjà noté ce produit
                        $sqlCheckRating = "SELECT * FROM rating WHERE ID_Product = :productId AND ID_User = :userId";
                        $stmtCheckRating = $pdo->prepare($sqlCheckRating);
                        $stmtCheckRating->bindParam(':productId', $id, PDO::PARAM_INT);
                        $stmtCheckRating->bindParam(':userId', $userId, PDO::PARAM_INT);
                        $stmtCheckRating->execute();
                    
                        if ($stmtCheckRating->rowCount() > 0) {
                            echo "<p>Vous avez déjà noté ce produit.</p>";
                        } else {
                            // Vérifier si l'utilisateur a commandé ce produit
                            $sqlCheckOrder = "SELECT * FROM orders WHERE ID_User = :userId AND ID_Product = :productId";
                            $stmtCheckOrder = $pdo->prepare($sqlCheckOrder);
                            $stmtCheckOrder->bindParam(':userId', $userId, PDO::PARAM_INT);
                            $stmtCheckOrder->bindParam(':productId', $id, PDO::PARAM_INT);
                            $stmtCheckOrder->execute();
                    
                            if ($stmtCheckOrder->rowCount() > 0) {
                                // L'utilisateur a commandé le produit, afficher le formulaire de notation
                                echo "<div class='rating'>";
                                echo "<form method='POST' action='requete/save-rating.php?id=" . $id . "'>";
                                echo "<input type='number' name='rating' min='1' max='5'>";
                                echo "<button type=submit class='rating-submit'>Enregistrer la note</button>";
                                echo "</form>";
                                echo "</div>";
                            } else {
                                // L'utilisateur n'a pas commandé le produit, afficher un message
                                echo "<p>Vous devez commander le produit pour pouvoir le noter.</p>";
                            }
                        }
                        $sqlProductInfo = "SELECT ID_Product FROM product WHERE ID_Product = :productId";
                        $stmtProductInfo = $pdo->prepare($sqlProductInfo);
                        $stmtProductInfo->bindParam(':productId', $id, PDO::PARAM_INT);
                        $stmtProductInfo->execute();

                        if ($rowProduct = $stmtProductInfo->fetch(PDO::FETCH_ASSOC)) {
                            $productId = $rowProduct['ID_Product'];

                            // Requête pour calculer la moyenne des notes pour ce produit en utilisant la table "rating"
                            $sqlAvgRating = "SELECT AVG(Rating) AS avgRating FROM rating WHERE ID_Product = :productId";
                            $stmtAvgRating = $pdo->prepare($sqlAvgRating);
                            $stmtAvgRating->bindParam(':productId', $productId, PDO::PARAM_INT);
                            $stmtAvgRating->execute();

                            // Récupérer le résultat de la requête (la moyenne des notes pour ce produit)
                            $rowAvgRating = $stmtAvgRating->fetch(PDO::FETCH_ASSOC);

                            // Vérifier si la moyenne des notes n'est pas nulle (c'est-à-dire qu'il y a des notes pour ce produit)
                            if ($rowAvgRating['avgRating'] !== null) {
                                $avgRating = $rowAvgRating['avgRating'];
                                // Afficher la moyenne des notes arrondie à 1 décimale
                                echo "<p>Moyenne des notes : " . round($avgRating, 1) . " étoiles</p>";
                            } else {
                                echo "<p>Aucune note pour ce produit pour le moment</p>";
                            }
                        } else {
                            echo "<p>Produit non trouvé</p>";
                        }
                    } else {
                        echo "Vous devez être connecté pour noter ce produit.";
                    }
                    
                }
                ?>
                </div>
                <?php
                $id = $_GET["id"];
                $sql = "SELECT * FROM product WHERE ID_Product = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $image = "img/item/" . $id . ".png";
                    echo "<div class='container-spe-img'>";
                    echo "<img src='" . $image . "' />";
                    echo "</div>";
                    for ($i = 1; $i <= 4; $i++) {
                        echo "<div class='container-spe-moreImg'>";
                        $moreImg = "img/item/" . $id . "-" . $i . ".png";
                        echo "<img src='" . $moreImg . "' />";
                        echo "</div>";
                    }
                }
                ?>
            </div>
        </div>
        <!-- <footer>
            <p>© 2023 - FootballShoes</p>
        </footer> -->
    </body>
</html>