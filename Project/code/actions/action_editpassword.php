<?php
require_once('../database/connection.php');
require_once('../utils/session.php');
$session = new Session();
if ($_SESSION['csrf'] !== $_POST['csrf']) {
    die(header("Location: /../pages/login.php"));
  }

$db = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $password = sha1($_POST['Password']);

    $stmt = $db->prepare("UPDATE User SET password=:password WHERE username=:username;");
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':username', $session->getUsername());
    $stmt->execute();

    die(header("Location: /../pages/editprofile.php"));
}
?>