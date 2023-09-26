<?php
require_once("db.php");
session_start();

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $sql = "SELECT * FROM product WHERE ID_Product = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $productId);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        $currentStock = $product['stock'];
    }
}
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
        <link rel="stylesheet" href="css/user.css"/>
        <title>Détails de la chaussure</title>
    </head>
    <body>
        <?php require_once("header.php"); ?>

        <?php if ($product) : ?>
            <div class="container-shoe-details">
                <div class="shoe-info">
                    <h2><?= $product['shoesName']; ?></h2>
                    <h3><a href='admin-panel.php'>Retourner</a></h3>
                    <br>
                    <p>Prix : <?= $product['shoesPrice']; ?> €</p>
                    <p>Chaussure n° : <?= $product['ID_Product']; ?></p>
                    <p>Type de chaussures : <?= $product['typeOfShoes']; ?></p>
                    <br>
                    <p>Description : <?= $product['shoesDescription']; ?></p>
                    <br>
                    <form action="requete/update-stock.php" method="POST">
                        <label for="stock">Stock disponible :</label>
                        <input type="number" id="stock" name="stock" value="<?= $currentStock; ?>" min="0">
                        <input type="hidden" name="productId" value="<?= $productId; ?>">
                        <button type="submit">Mettre à jour le stock</button>
                    </form>
                </div>
            </div>
        <?php else : ?>
            <p>La chaussure demandée n'existe pas.</p>
        <?php endif; ?>
    </body>
</html>
