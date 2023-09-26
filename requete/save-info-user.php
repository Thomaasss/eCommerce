<?php
require_once("../db.php");
session_start();

$phonenumber = $_GET["phoneNumber"];
$country = $_GET["country"];
$city = $_GET["city"];
$postalcode = $_GET["postalCode"];

$sql = "UPDATE user SET phoneNumber=:phoneNumber, country=:country, city=:city, postalcode=:postalcode WHERE ID_User = :userID";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':phoneNumber', $phonenumber);
$stmt->bindParam(':country', $country);
$stmt->bindParam(':city', $city);
$stmt->bindParam(':postalcode', $postalcode);
$stmt->bindParam(':userID', $_SESSION['id']);
$result = $stmt->execute();
sleep(1);
header("Location: /Vente/user-panel.php");
?>
