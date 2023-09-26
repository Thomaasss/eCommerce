<?php
require_once("../db.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_GET['id']; // Utiliser $productId au lieu de $id
    $userId = $_SESSION['id'];
    $rating = $_POST['rating'];

    if ($rating >= 1 && $rating <= 5) {
        $sql = "INSERT INTO rating (ID_Product, ID_User, Rating) VALUES (:productId, :userId, :rating)
                ON DUPLICATE KEY UPDATE Rating = :rating";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
        $stmt->execute();

        sleep(1);
        header("Location: /Vente/spe-product.php?id=" . $productId);
    } else {
        echo 'Veuillez entrer une note valide entre 1 et 5';
    }
}
?>
