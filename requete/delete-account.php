<?php
require_once("../db.php");
session_start();

$sqlBasket = "DELETE FROM basket WHERE ID_User = :userID";
$stmtBasket = $pdo->prepare($sqlBasket);
$stmtBasket->bindParam(':userID', $_SESSION['id']);
$resultBasket = $stmtBasket->execute();

$sqlUser = "DELETE FROM user WHERE ID_User = :userID";
$stmtUser = $pdo->prepare($sqlUser);
$stmtUser->bindParam(':userID', $_SESSION['id']);
$resultUser = $stmtUser->execute();

if ($resultBasket && $resultUser) {
    session_unset();
    session_destroy();
    sleep(2);
    header("Location: /Vente");
} else {
    echo "Erreur lors de la suppression de l'utilisateur.";
}
?>