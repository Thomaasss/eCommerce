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
        <link rel="stylesheet" href="css/user.css"/>
        <title>Gestion administration</title>
    </head>
    <body>
        <?php
        require_once("db.php");
        session_start();
        require_once("header.php");

        if (isset($_GET['id'])) {
            $userId = $_GET['id'];

            $sql = "SELECT * FROM user WHERE ID_User = :userId";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                echo "<div class='container-admin-panel'>";
                echo "<h3><a href='admin-panel.php'>Retourner</a></h3>";
                echo "<h1>Détails de l'utilisateur</h1>";
                echo "<div class='container-username'>";
                echo "<br><br>";
                echo "<ul>";
                echo "<li>Prénom : " . $user['firstName'] . "</li>";
                echo "<li>Nom : " . $user['lastName'] . "</li>";
                echo "<li>Date de naissance : " . $user['birthdate'] . "</li>";
                echo "<li>Email : " . $user['mail'] . "</li>";
                echo "<li>Mot de passe : * * * * *</li>";
                if ($user['phoneNumber'] == NULL) {
                    echo "<li>N° de téléphone : Non renseigné</li>";
                }
                else {
                    echo "<li>N° de téléphone : " . $user['phoneNumber'] . "</li>";
                }
                if ($user['country'] == NULL) {
                    echo "<li>Pays : Non renseigné</li>";
                }
                else {
                    echo "<li>Pays : " . $user['country'] . "</li>";
                }
                if ($user['city'] == NULL) {
                    echo "<li>Ville : Non renseigné</li>";
                }
                else {
                    echo "<li>Ville : " . $user['city'] . "</li>";
                }
                if ($user['postalCode'] == NULL) {
                    echo "<li>Code postal : Non renseigné</li>";
                }
                else {
                    echo "<li>Code postal : " . $user['postalCode'] . "</li>";
                }
                if ($user['adress'] == NULL) {
                    echo "<li>Adresse : Non renseigné</li>";
                }
                else {
                    echo "<li>Adresse : " . $user['adress'] . "</li>";
                }
                if ($user['nb_order'] == NULL) {
                    echo "<li>Nombre de commande : Non renseigné</li>";
                }
                else {
                    echo "<li>Nombre de commande : " . $user['nb_order'] . "</li>";
                }
                if ($user['isAdmin'] == 0) {
                    echo "<li>Administrateur : Non</li>";
                }
                else {
                    echo "<li>Administrateur : Oui</li>";
                }
                echo "<li>Utilisateur N° : " . $user['ID_User'] . "</li>";
                echo "</ul>";
                echo "</div>";
                echo "</div>";
            } else {
                echo "Utilisateur non trouvé.";
            }
        } else {
            echo "ID utilisateur non spécifié.";
        }
        ?>
    </body>
</html>