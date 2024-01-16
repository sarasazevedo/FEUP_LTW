<?php
declare(strict_types = 1);
require_once('../database/connection.php');
require_once('../utils/session.php');

$session = new Session();
if ($_SESSION['csrf'] !== $_POST['csrf']) {
    die(header("Location: /../pages/login.php"));
  }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resposta']) && isset($_POST['ticket_id'])) {
    $ticket_id = (int)$_POST['ticket_id'];
    $content = $_POST['resposta'];
    
    $db = getDatabaseConnection();
    $stmt = $db->prepare("INSERT INTO Message_ (ticket_id, sender_username, content) VALUES (:ticket_id, :sender_username, :resposta)");
    $stmt->bindParam(':ticket_id', $ticket_id);
    $stmt->bindParam(':sender_username', $session->getUsername());
    $stmt->bindParam(':resposta', $content);
    $stmt->execute();
    
    die(header("Location: /../pages/individualticket.php?ID_ticket={$ticket_id}"));
}

die(header("Location: /../pages/ticketpage.php"));
?>
