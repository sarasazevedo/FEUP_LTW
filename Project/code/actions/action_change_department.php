<?php
declare(strict_types=1);

require_once('../database/connection.php');
require_once('../utils/session.php');
$session = new Session();

$db = getDatabaseConnection();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['department']) && isset($_POST['ID_ticket'])) {
    $department_name = $_POST['department'];
    $ID_ticket = $_POST['ID_ticket'];

    $stmt = $db->prepare("UPDATE Ticket SET department = :department WHERE ID_ticket = :ID_ticket");
    $stmt->bindParam(':department', $department_name);
    $stmt->bindParam(':ID_ticket', $ID_ticket);
    $stmt->execute();
    die(header("Location: /../pages/individualticket.php?ID_ticket=" . $ID_ticket));
}
?>
