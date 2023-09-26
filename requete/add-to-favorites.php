<?php
require_once("../db.php");
session_start();

$id_product = $_POST['get-id-product'];
$size = $_POST['get-size'];
$name = $_POST['get-name'];
$price = $_POST['get-price'];

if (isset($_SESSION['id'])) {
    $sql = "INSERT INTO favorites (ID_User, ID_Product, shoesSize) VALUES (:userID, :productID, :shoesSize)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':userID', $_SESSION['id']);
    $stmt->bindParam(':productID', $id_product);
    $stmt->bindParam(':shoesSize', $size);
    $stmt->execute();
    sleep(1);
    header("Location: /Vente/favorites.php");
} else {
    echo "Vous devez crée un compte pour pouvoir ajouter un article dans vos favoris.";
}
?>