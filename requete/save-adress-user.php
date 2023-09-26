<?php
require_once("../db.php");
session_start();

$adress = $_GET["adress"];

$sql = "UPDATE user SET adress=:address WHERE ID_User = :userID";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':address', $adress);
$stmt->bindParam(':userID', $_SESSION['id']);
$result = $stmt->execute();
sleep(1);
header("Location: /Vente/user-panel.php");
?>
