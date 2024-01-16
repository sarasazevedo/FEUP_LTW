<?php
    declare(strict_types = 1);
    require_once('../database/connection.php');
    require_once('../utils/session.php');
    $session = new Session();
    $ticketId = $_GET['ticket_id'];

    $db = getDatabaseConnection();


        $stmt = $db->prepare("UPDATE Ticket SET status_='closed' WHERE ID_ticket=:ticketId;");

        $stmt->bindParam(':ticketId', $ticketId);
        $result = $stmt->execute();

    die(header('Location: /../pages/viewtickets.php'));
?>
