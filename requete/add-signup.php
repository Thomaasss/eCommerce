<?php
require_once("../db.php");

require '../lib/PHPMailer/src/Exception.php';
require '../lib/PHPMailer/src/PHPMailer.php';
require '../lib/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$firstname = $_GET["firstName"];
$lastname = $_GET["lastName"];
$birthdate = $_GET["birthdate"];
$mail = $_GET["mail"];
$rawPassword = $_GET["password"];

// Hacher le mot de passe
$hashedPassword = password_hash($rawPassword, PASSWORD_BCRYPT);

// Vérification d'adresse e-mail valide dans GMail, si invalide alors message d'erreur
$mailChecker = new PHPMailer();
if (!$mailChecker->validateAddress($mail)) {
    echo "Adresse e-mail inexistant dans les données GMail.";
    exit;
}

$token = bin2hex(random_bytes(32));
$validationLink = "http://localhost/Vente/requete/validation.php?token=" . $token . "&mail=" . $mail;
$message1 = "Bonjour & Bienvenue dans la communauté FootballShoes,\n\nAfin d'accéder à la totalité de notre site, veuillez cliquer sur le lien ci-dessous pour valider votre adresse e-mail : \n" . $validationLink . "\n";
$message2 = "Nous vous remercions pour votre inscription à FootballShoes. Profitez pleinement de notre site et découvrez les dernières tendances en matière de chaussures de football !";
$message = $message1 . "\n" . $message2;

$sendMail = new PHPMailer();
$sendMail->isSMTP();
$sendMail->Host = 'smtp.gmail.com';
$sendMail->SMTPAuth = true;
$sendMail->SMTPSecure = 'tls';
$sendMail->Port = '587';
$sendMail->Username = 'vaezy.ea@gmail.com';
$sendMail->Password = 'omuopxpqkererhxw';
$sendMail->Subject = "Test de l'objet";
$sendMail->setFrom("vaezy.ea@gmail.com");
$sendMail->Body = $message;
$sendMail->addAddress($mail);

$sqlCheckEmail = "SELECT * FROM user WHERE mail = :mail";
$stmtCheckEmail = $pdo->prepare($sqlCheckEmail);
$stmtCheckEmail->bindParam(':mail', $mail);
$stmtCheckEmail->execute();

if ($stmtCheckEmail->rowCount() > 0) {
    echo "Adresse e-mail indisponible.";
} else {
    if ($sendMail->Send()) {
        $sql = "INSERT INTO user (firstName, lastName, birthdate, mail, password, nb_order, isValidate) VALUES (:firstName, :lastName, :birthdate, :mail, :hashedPassword, 0, 0)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':firstName', $firstname);
        $stmt->bindParam(':lastName', $lastname);
        $stmt->bindParam(':birthdate', $birthdate);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':hashedPassword', $hashedPassword);
        $stmt->execute();
        sleep(2);
        echo "Désormais, veuillez valider votre compte en accédant à votre boîte <a href='https://www.google.com/intl/fr/gmail/about/' target='_blank'>GMail</a>.";
        echo "<br>La validation de votre compte est obligatoire pour pouvoir accéder à l'entièreté de notre site.";
        echo "<br>Ensuite, retourner vers <a href='../index.php'>l'accueil</a>.";
    } else {
        echo "Erreur";
    }
}
$sendMail->smtpClose();
?>