<?php
require_once("../db.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $productId = $_POST["productId"];
    $stock = $_POST["stock"];

    $sql = "UPDATE product SET stock = :stock WHERE ID_Product = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":stock", $stock, PDO::PARAM_INT);
    $stmt->bindParam(":id", $productId, PDO::PARAM_INT);
    $stmt->execute();

    sleep(1);
    header("Location: ../shoes-details.php?id=" . $productId);
}
?>
