<?php
declare(strict_types=1);

require_once('../database/connection.php');
require_once('../utils/session.php');
$session = new Session();

$db = getDatabaseConnection();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ID_ticket'])) {
    $ID_ticket = $_POST['ID_ticket'];

    $stmt = $db->prepare("SELECT client_id FROM Ticket WHERE ID_ticket = :ID_ticket");
    $stmt->bindParam(':ID_ticket', $ID_ticket);
    $stmt->execute();
    $result = $stmt->fetch(); 

    if ($result) {
        $client_id = $result['client_id'];

        $stmt = $db->prepare("UPDATE User SET usertype = 2 WHERE user_id = :user_id AND usertype =1");
        $stmt->bindParam(':user_id', $client_id);
        $stmt->execute();

        die(header("Location: /../pages/individualticket.php?ID_ticket=" . $ID_ticket));
    } else {
        die(header("Location: /../pages/ticketpage.php"));
        
    }
}
?>
