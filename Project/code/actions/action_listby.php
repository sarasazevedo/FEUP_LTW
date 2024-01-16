<?php
declare(strict_types=1);

require_once('../database/connection.php');
require_once('../utils/session.php');
require_once('../templates/agent.tpl.php');
$session = new Session();


$db = getDatabaseConnection();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected = $_POST['sort'];
    $session->setSelected($selected);
}
?>