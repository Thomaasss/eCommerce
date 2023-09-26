<?php
require_once("../db.php");
session_start();

$mail = isset($_POST['mail']) ? $_POST['mail'] : '';
$password_login = isset($_POST['password-login']) ? $_POST['password-login'] : '';
$math_answer = isset($_POST['math_answer']) ? $_POST['math_answer'] : '';

// Vérifier la réponse à la question mathématique
if (!isset($_SESSION['math_answer']) || intval($math_answer) !== $_SESSION['math_answer']) {
    header("Location: /Vente/login.php?error=1");
    exit;
}

$sql = "SELECT * FROM user WHERE mail=:mail";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':mail', $mail);
$stmt->execute();

$res = $stmt->rowCount();

if ($res > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $hashedPassword = $row['password'];

    // Vérifier si le mot de passe fourni correspond au mot de passe haché dans la base de données
    if (password_verify($password_login, $hashedPassword)) {
        $userID = $row['ID_User'];
        $_SESSION['id'] = $userID;
        sleep(1);
        header("Location: /Vente");
    } else {
        echo "Mot de passe incorrect.";
    }
} else {
    echo "Aucun compte ne correspond à cette adresse email.";
}