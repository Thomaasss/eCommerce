<?php
require_once("../db.php");

if (isset($_GET['token'])) {
    // Vérifier si l'utilisateur existe dans la base de données avec le mail fourni
    $mail = $_GET['mail'];
    $sqlCheckUser = "SELECT ID_User, isValidate FROM user WHERE mail = :mail";
    $stmtCheckUser = $pdo->prepare($sqlCheckUser);
    $stmtCheckUser->bindParam(':mail', $mail);
    $stmtCheckUser->execute();

    if ($stmtCheckUser->rowCount() > 0) {
        $user = $stmtCheckUser->fetch(PDO::FETCH_ASSOC);
        $userId = $user['ID_User'];
        $isValidate = $user['isValidate'];

        if (!$isValidate) {
            // Marquer le compte comme validé en mettant la colonne "isValidate" à 1
            $sqlUpdateUser = "UPDATE user SET isValidate = 1 WHERE ID_User = :userId";
            $stmtUpdateUser = $pdo->prepare($sqlUpdateUser);
            $stmtUpdateUser->bindParam(':userId', $userId);
            $stmtUpdateUser->execute();

            echo "Votre adresse e-mail a été validée avec succès !";
            echo "<br>Retouner à <a href='../index.php'>l'accueil</a>.";
        } else {
            echo "Votre adresse e-mail a déjà été validée.";
            echo "<br>Retouner à <a href='../index.php'>l'accueil</a>.";
        }
    } else {
        echo "Adresse e-mail invalide.";
        echo "<br>Retouner à <a href='../index.php'>l'accueil</a>.";
    }
} else {
    echo "Jeton de validation manquant.";
    echo "<br>Retouner à <a href='../index.php'>l'accueil</a>.";
}
?>