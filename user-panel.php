<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profil</title>
        <link rel="stylesheet" href="css/user.css"/>
        <script src="js/main.js"></script>
    </head>
    <body>
        <?php
        require_once("header.php"); 
        ?>
        <div class="container-user-panel">
            <?php
            $sql = "SELECT ID_User, firstName, lastName, birthdate, mail, password, phoneNumber, country, city, postalCode, adress, nb_order FROM user WHERE ID_User = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $_SESSION['id']);
            $stmt->execute();

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id_user = $row["ID_User"];
                $firstname = $row["firstName"];
                $lastname = $row["lastName"];
                $birthdate = $row["birthdate"];
                $mail = $row["mail"];
                $password = $row["password"];
                $phonenumber = $row["phoneNumber"];
                $country = $row["country"];
                $city = $row["city"];
                $postalcode = $row["postalCode"];
                $adress = $row["adress"];
                $nborder = $row["nb_order"];

                echo "<h1>" . $firstname . " " . $lastname . "</h1>";
                echo "</br></br></br>";
                echo "<h2>Information du compte</h2>";
                echo "</br>";
                echo "<form action='requete/save-info-user.php' method='GET' onsubmit='return checkUserInformation()'>";

                echo "<div class='information-user-panel'>";
                echo "<label>Adresse e-mail</label>";
                echo "<input type='text' value='" . $mail . "'readonly>";
                echo "<label>Mot de passe</label>";
                echo "<input type='password' value='" . $password . "'readonly>";
                echo "<label>Date de naissance</label>";
                echo "<input type='text' value='" . $birthdate . "'readonly>";
                echo "</div>";

                echo "<div class='information-user-panel'>";
                echo "<label>Prénom</label>";
                echo "<input type='text' value='" . $firstname . "'readonly>";
                echo "<label>Nom de famille</label>";
                echo "<input type='text' value='" . $lastname . "'readonly>";
                echo "<label>Numéro de téléphone</label>";
                if ($country === 'France') {
                    echo "<input type='text' id='error_number' name='phoneNumber' maxlength='10' value= '+33 ".$phonenumber."'readonly>";
                } elseif ($country === 'Suisse') {
                    echo "<input type='text' id='error_number' name='phoneNumber' maxlength='10' value= '+41 ".$phonenumber."'readonly>";
                } elseif ($country === 'Belgique') {
                    echo "<input type='text' id='error_number' name='phoneNumber' maxlength='10' value= '+32 ".$phonenumber."'readonly>";
                } else {
                    echo "<input type='text' id='error_number' name='phoneNumber' maxlength='10' value=''>";
                }
                echo "</div>";

                echo "<div class='information-user-panel'>";
                echo "<label>Pays</label>";
                if ($country == NULL) {
                    echo "<input type='text' placeholder='France/Belgique/Suisse' id='error_country' name='country' value=''>";
                } else {
                    echo "<input type='text' placeholder='France/Belgique/Suisse' id='error_country' name='country' value='$country'readonly>";
                }
                echo "<label>Ville</label>";
                if ($city == NULL) {
                    echo "<input type='text' id='error_city' name='city' value=''>";
                } else {
                    echo "<input type='text' id='error_city' name='city' value='$city'readonly>";
                }
                echo "<label>Code postal</label>";
                if ($postalcode == NULL) {
                    echo "<input type='text' id='error_postal_code' maxlength='5' name='postalCode' value=''>";
                } else {
                    echo "<input type='text' id='error_postal_code' maxlength='5' name='postalCode' value='$postalcode'readonly>";
                }
                echo "</div>";
                echo "</br>";
                if ($phonenumber === NULL && $country === NULL && $city === NULL && $postalcode === NULL) {
                    echo "<input class='input-save-info' type='submit' value='Enregistrer'>";
                } else {
                    echo "<p class='information-added'>Enregistrer</p>";
                }
                echo "</form>";

                echo "</br></br></br>";
                echo "<h2>Adresse de livraison</h2>";
                echo "</br>";
                echo "<form action='requete/save-adress-user.php' method='GET' onsubmit='return checkUserAdress()'>";
                echo "<div class='information-user-panel'>";
                echo "<label>Prénom</label>";
                echo "<input type='text' value='" . $firstname . "'readonly>";
                echo "<label>Nom de famille</label>";
                echo "<input type='text' value='" . $lastname . "'readonly>";
                echo "<label>Numéro de téléphone</label>";
                if ($country === 'France') {
                    echo "<input type='text' name='phoneNumber' value= '+33 ".$phonenumber."'readonly>";
                } elseif ($country === 'Suisse') {
                    echo "<input type='text' name='phoneNumber' value= '+41 ".$phonenumber."'readonly>";
                } elseif ($country === 'Belgique') {
                    echo "<input type='text' name='phoneNumber' value= '+32 ".$phonenumber."'readonly>";
                } else {
                    echo "<input type='text' name='phoneNumber' placeholder='Mettez vos informations à jour' value=''readonly>";
                }
                echo "</div>";
                echo "<div class='information-user-panel'>";
                echo "<label>Adresse postale</label>";
                if ($phonenumber == NULL && $country == NULL && $city == NULL && $postalcode == NULL) {
                    echo "<input type='text' name='adress' id='error_adress' placeholder='Mettez vos informations à jour' value=''readonly>";
                } elseif ($adress == NULL) {
                    echo "<input type='text' name='adress' id='error_adress' value=''>";
                } else {
                    echo "<input type='text' name='adress' id='error_adress' value='" . $adress . "'readonly>";
                }
                echo "<label>Ville</label>";
                if ($city == NULL) {
                    echo "<input type='text' name='city' placeholder='Mettez vos informations à jour' value=''readonly>";
                } else {
                    echo "<input type='text' name='city' value='" . $city . "'readonly>";
                }
                echo "<label>Code postal</label>";
                if ($postalcode == NULL) {
                    echo "<input type='text' name='postalCode' placeholder='Mettez vos informations à jour' value=''readonly>";
                } else {
                    echo "<input type='text' name='postalCode' value='$postalcode'readonly>";
                }
                echo "</div>";
                echo "</br>";
                if ($adress === NULL) {
                    echo "<input class='input-save-info' type='submit' value='Enregistrer'>";
                } else {
                    echo "<p class='information-added'>Enregistrer</p>";
                }
                echo "</form>";

                echo "</br></br></br>";
                echo "<h2>Commandes</h2>";
                echo "</br>";
                echo "<h5>Total des commandes : " . $nborder . "</h5>";
                echo "<br>";

                $sqlOrders = "SELECT * FROM orders WHERE ID_User = :userID";
                $stmtOrders = $pdo->prepare($sqlOrders);
                $stmtOrders->bindParam(':userID', $_SESSION['id']);
                $stmtOrders->execute();

                if ($stmtOrders->rowCount() > 0) {
                    echo "<div class='container-get-product'>";
                    echo "<ul>";
                    while ($row = $stmtOrders->fetch(PDO::FETCH_ASSOC)) {
                        $orderID = $row['ID_Order'];
                        $productName = $row['shoesName'];
                        $productPrice = $row['shoesPrice'];
                        $productSize = $row['shoesSize'];
                        $quantity = $row['quantity'];
                        $productID = $row['ID_Product'];
                        $status = $row['status'];
                    
                        // Chemin d'accès à l'image du produit
                        $image = "img/item/" . $productID . ".png";
                    
                        echo "<li>";
                        echo "<img src='" . $image . "' alt='Image du produit' width='100' height='100'>";
                        echo "<p>Commande n° " . $orderID . "</p>";
                        echo "<p>Nom du produit : " . $productName . "</p>";
                        echo "<p>Prix du produit : " . $productPrice . " €</p>";
                        echo "<p>Taille : " . $productSize . "</p>";
                        echo "<p>Quantité : " . $quantity . "</p>";
                        if ($status == 2) {
                            echo "<p>Statut : <span style='color:green'>Validée</span></p>";
                        } elseif ($status == 1) {
                            echo "<p>Statut : <span style='color:blue'>En attente</span></p>";
                        } else {
                            echo "<p>Statut : <span style='color:red'>Refusée</span></p>";
                        }                        
                        echo "</li>";
                        echo "<br>";
                    }
                    echo "</ul>";
                    echo "</div>";
                }
                echo "</br></br></br>";
                echo "<form action='requete/delete-account.php' method='GET' onsubmit='return confirmDelete()'>";
                echo "<input class='delete-account' type='submit' value='Supprimer le compte'>";
                echo "</form>";
            }
            ?>
        </div>
    </body>
</html>