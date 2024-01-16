<?php
require_once('../database/connection.php');
require_once('../utils/session.php');
$session = new Session();

$db = getDatabaseConnection();

if ($_SESSION['csrf'] !== $_POST['csrf']) {
  die(header("Location: /../pages/login.php"));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $email = $_POST['Email'];

  $stmt = $db->prepare("SELECT * FROM User WHERE email=:email");
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $result = $stmt->fetch();

  if ($result === false) {
    $stmt = $db->prepare("UPDATE User SET email=:email WHERE email=:sessionemail;");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':sessionemail', $session->getEmail());
    $stmt->execute();
    $session->setEmail($email);
  } else {
    die(header("Location: /../pages/editprofile.php"));
  }
    die(header("Location: /../pages/editprofile.php"));
}
?>