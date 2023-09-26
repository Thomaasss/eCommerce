<?php
require_once("db.php");
session_start();
require_once("header.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com/%22%3E"/>
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/item.css"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title>FootballShoes - Chaussure de foot</title>
    </head>
    <body class="background-color">
        <div class="container-item">
        <a href="index.php">Retourner à l'accueil</a>
        <br><br>
        <div class="container-flex">
            <?php
            if (isset($_GET['recherche'])) {
                $recherche = $_GET['recherche'];

                if ($recherche == "") {
                    echo "Aucun terme de recherche n'est spécifié.";
                } else {
                    $recherche = htmlspecialchars($recherche);

                    $sql = "SELECT * FROM product WHERE shoesName LIKE :recherche";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':recherche', '%' . $recherche . '%');
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $id = $row["ID_Product"];
                            $name = $row["shoesName"];
                            $price = $row["shoesPrice"];
                            $type = $row["typeOfShoes"];
                            $image = "img/item/" . $id . ".png";

                            echo "<div class='container-product'>";
                            echo "<div class='img-product'><a href='spe-product.php?id=" . $id . "'><img src='" . $image . "' /></a></div>";
                            echo "<div class='product-name'>" . $name . "</div>";
                            echo "<div class='product-price'>" . $price . ' €' . "</div>";
                            echo "<div class='product-type'>" . $type . "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "Aucun résultat trouvé pour '" . $recherche . "'.";
                    }
                }
            }
            ?>
            </div>
        </div>
    
    </body>
</html>
