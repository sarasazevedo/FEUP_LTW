<?php
declare(strict_types=1);

require_once('../database/connection.php');
require_once('../utils/session.php');
$session = new Session();

$db = getDatabaseConnection();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ID_ticket'])) {
    $ID_ticket = $_POST['ID_ticket'];

    $stmt = $db->prepare("UPDATE Ticket SET agent_id = :agent_id WHERE ID_ticket = :ID_ticket");
    $stmt->bindParam(':agent_id', $session->getUserId());
    $stmt->bindParam(':ID_ticket', $ID_ticket);
    $stmt->execute();
    die(header("Location: /../pages/individualticket.php?ID_ticket=" . $ID_ticket));
}
?>
