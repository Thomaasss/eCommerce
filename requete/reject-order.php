<?php
require_once("../db.php");

// Mettre à jour le statut de la commande comme "Refusée" (statut = 0)
$sqlUpdateStatus = "UPDATE orders SET status = 0 WHERE ID_Order = :orderID";
$stmtUpdateStatus = $pdo->prepare($sqlUpdateStatus);
$stmtUpdateStatus->bindParam(':orderID', $_POST['orderID']);
$resultUpdateStatus = $stmtUpdateStatus->execute();

if ($resultUpdateStatus) {
    sleep(1);
    header("Location: ../admin-panel.php");
} else {
    echo "Une erreur s'est produite lors du refus de la commande.";
}

