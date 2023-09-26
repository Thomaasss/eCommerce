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
        <link rel="stylesheet" href="css/user.css"/>
        <title>Gestion administration</title>
    </head>
    <body>
        <?php
        require_once("header.php");
        
        $sql = "SELECT * FROM user";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sqlPendingOrders = "SELECT od.*, u.firstName, u.lastName FROM orders od JOIN user u ON od.ID_User = u.ID_User WHERE od.status = 1";
        $stmtPendingOrders = $pdo->prepare($sqlPendingOrders);
        $stmtPendingOrders->execute();
        $pendingOrders = $stmtPendingOrders->fetchAll(PDO::FETCH_ASSOC);

        $sqlAdults = "SELECT ID_Product, shoesName, typeOfShoes FROM product WHERE shoesCategory = 'Homme & Femme'";
        $stmtAdults = $pdo->prepare($sqlAdults);
        $stmtAdults->execute();
        $productsAdults = $stmtAdults->fetchAll(PDO::FETCH_ASSOC);
        
        $sqlChildren = "SELECT ID_Product, shoesName, typeOfShoes FROM product WHERE shoesCategory = 'Enfant'";
        $stmtChildren = $pdo->prepare($sqlChildren);
        $stmtChildren->execute();
        $productsChildren = $stmtChildren->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="container-admin-panel">
            <h1>Liste des utilisateurs</h1>
            <br>
            <div class="container-username">
                <ul>
                    <?php foreach ($users as $user) : ?>
                        <li>
                            <a href="user-details.php?id=<?= $user['ID_User']; ?>">
                                <?= $user['firstName'] . ' ' . $user['lastName']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <br><br>
            <h1>Liste des commandes en attente de validation</h1>
            <br><br><br>
            <div class="container-products">
                <ul>
                    <?php foreach ($pendingOrders as $order) : ?>
                        <li>
                            <p>Nom de l'utilisateur : <?= $order['firstName'] . ' ' . $order['lastName']; ?></p>
                            <p>Nom du produit : <?= $order['shoesName']; ?></p>
                            <p>Prix du produit : <?= $order['shoesPrice']; ?> €</p>
                            <p>Taille : <?= $order['shoesSize']; ?></p>
                            <p>Quantité : <?= $order['quantity']; ?></p>
                            <br>
                            <div class="order-buttons">
                                <div class='order-button-validate'>
                                    <form action="requete/validate-order.php" method="POST">
                                        <input type="hidden" name="orderID" value="<?= $order['ID_Order']; ?>">
                                        <input type="submit" name="validate" value="Valider">
                                    </form>
                                </div>
                                <div class='order-button-reject'>
                                    <form action="requete/reject-order.php" method="POST">
                                        <input type="hidden" name="orderID" value="<?= $order['ID_Order']; ?>">
                                        <input type="submit" name="reject" value="Refuser">
                                    </form>
                                </div>
                            </div>
                            <br>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <br><br>
            <h1>Liste des produits pour adultes</h1>
            <br><br><br>
            <div class="container-products">
                <ul>
                    <?php foreach ($productsAdults as $productAdult) : ?>
                        <li>
                            <a href="shoes-details.php?id=<?= $productAdult['ID_Product']; ?>">
                                <?= $productAdult['ID_Product'] . ' - ' . $productAdult['shoesName']; ?>
                            </a>
                            <?php if (isset($productAdult['typeOfShoes'])) : ?>
                                - <span class="product-type"><?= $productAdult['typeOfShoes']; ?></span>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <br><br>
            <h1>Liste des produits pour enfants</h1>
            <br><br><br>
            <div class="container-products">
                <ul>
                    <?php foreach ($productsChildren as $productChild) : ?>
                        <li>
                            <a href="shoes-details.php?id=<?= $productChild['ID_Product']; ?>">
                                <?= $productChild['ID_Product'] . ' - ' . $productChild['shoesName']; ?>
                            </a>
                            <?php if (isset($productChild['typeOfShoes'])) : ?>
                                - <span class="product-type"><?= $productChild['typeOfShoes']; ?></span>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div> 
    </body>
</html>
