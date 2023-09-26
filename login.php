<?php
require_once("db.php");
session_start();

function generateMathQuestion()
{
    $num1 = rand(1, 20);
    $num2 = rand(1, 20);
    $answer = $num1 + $num2;
    $_SESSION['math_question'] = "Combien font {$num1} + {$num2} ?";
    $_SESSION['math_answer'] = $answer;
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
        <script src="js/main.js"></script>
        <title>S'identifier</title>
    </head>
    <body>
        <?php
            require_once("header.php");
            generateMathQuestion();
        ?>
        <div class="container-login">
            <div class="sub-container-login">
                <form action="requete/login-check.php" method="POST">
                    <div class="style-input">
                        <input type="text" name="mail" placeholder="Adresse e-mail" style="width: 450px">
                    </div>
                    <div class="style-input">
                        <input type="password" name="password-login" placeholder="Mot de passe" style="width: 450px">
                    </div>
                    <p class="question-math">
                        <?php echo $_SESSION['math_question']; ?>
                    </p>
                    <input type="number" name="math_answer" placeholder="Entrez votre réponse" style="width: 440px">
                    <?php
                    if (isset($_GET['error']) && $_GET['error'] === '1') {
                        echo "<div class='error-message-login'>La réponse à la question mathématique est incorrecte.</div>";
                    }
                    ?>
                    <div class="style-checkbox">
                        <input type="checkbox" id="showpwd" onchange="showPassword_login()">
                        <p>Afficher le mot de passe</p>
                    </div>
                    <div class="style-submit-login">
                        <input type="submit" value="Se connecter">
                        <p>Vous n'avez pas encore de compte ? <a href="signup.php">Créez-en un maintenant</a></p>
                    </div>
                </form>
            </div>
        </div>
        <!-- <footer>
            <p>© 2023 - FootballShoes</p>
        </footer> -->
    </body>
</html>