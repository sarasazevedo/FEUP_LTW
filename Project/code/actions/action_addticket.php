<?php
    declare(strict_types = 1);
    require_once('../database/connection.php');
    require_once('../utils/session.php');
    $session = new Session();
    $db = getDatabaseConnection();

    if ($_SESSION['csrf'] !== $_POST['csrf']) {
      die(header("Location: /../pages/login.php"));
    }



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $department =  $_POST['department'] ?? '';
  $title_ticket = $_POST['subject'] ?? '';
  $description =  $_POST['description'] ?? '';

  
  $client_id = $session->getUserid();

  $stmt = $db->prepare("INSERT INTO Ticket ( department,title_ticket, description, client_id,agent_id,status_, time) VALUES ( :department,:title_ticket, :description, :client_id,NULL,'open', datetime('now'))");

  $stmt->bindParam(':department', $department);
  $stmt->bindParam(':title_ticket', $title_ticket);
  $stmt->bindParam(':description', $description);
  $stmt->bindParam(':client_id', $client_id);


  $result = $stmt->execute();

  if (!$result) {
      die(header("Location: /../pages/newticket.php"));
  }
  die(header("Location: /../pages/ticketpage.php"));
} 

?>