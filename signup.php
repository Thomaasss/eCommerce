<?php
require_once("db.php");
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
        <script src="js/main.js"></script>
        <title>Nous rejoindre</title>
    </head>
    <body>
        <?php
            require_once("header.php");
        ?>
        <div class="container-signup">
            <div class="sub-container-signup">
                <form action="requete/add-signup.php" method="GET" onsubmit="return checkInformation()">
                    <div class="style-input">
                        <input type="text" name="firstName" placeholder="Prénom">
                        <input type="text" name="lastName" placeholder="Nom de famille">
                    </div>
                    <div class="error-message" id="error-name-incomplete">Prénom obligatoire</div>
                    <div class="error-message" id="error-name-invalid">Certains champs sont invalides</div>
                    <div class="error-message-right" id="error-lastname-incomplete">Nom de famille obligatoire</div>
                    <div class="error-message-right" id="error-lastname-invalid">Certains champs sont invalides</div>
                    <div class="style-input">
                        <input type="text" name="mail" placeholder="Adresse e-mail" style="width: 450px">
                    </div>
                    <div class="error-message" id="error-mail-incomplete">Adresse email obligatoire</div>
                    <div class="error-message" id="error-mail-invalid">Certains champs sont invalides ou incomplet</div>
                    <div class="style-input">
                        <input type="password" name="password" placeholder="Mot de passe">
                        <input type="password" name="confirmPassword" placeholder="Confirmer">
                    </div>
                    <div class="error-message" id="error-password-incomplete">Mot de passe obligatoire</div>
                    <div class="error-message" id="error-password-invalid">Mot de passe non conforme</div>
                    <div class="error-message-right" id="error-confirmPassword-incomplete">Confirmez votre mot de passe</div>
                    <div class="error-message-right" id="error-confirmPassword-invalid">Mots de passe différents</div>
                    <div class="style-input">
                    <input type="date" name="birthdate" id="birthdate" placeholder="Date de naissance">
                    </div>
                    <div class="error-message" id="error-dob-incomplete">Date de naissance obligatoire</div>
                    <div class="error-message" id="error-dob-invalid">Vous devez avoir 18 ans pour vous inscrire</div>
                    <div class="style-checkbox">
                        <input type="checkbox" id="showpwd" onchange="showPassword_signup()">
                        <p>Afficher le mot de passe</p>
                    </div>
                    <div class="password-requirement">
                        Caractéristiques du mot de passe:
                        <ul>
                            <br>
                            <li>8 caractères minimum</li>
                            <li>Au moins une majuscule</li>
                            <li>Au moins un chiffre</li>
                            <li>Au moins un caractère spécial</li>
                        </ul>
                    </div>
                    <div class="style-submit">
                        <input type="submit" value="Crée un compte">
                        <p>Vous possédez déjà un compte ? <a href="login.php">Se connecter</a></p>
                    </div>
                </form>
            </div>
        </div>
        <!-- <footer>
            <p>© 2023 - FootballShoes</p>
        </footer> -->
    </body>
</html>