<?php
require_once('../database/connection.php');
require_once('../utils/session.php');
$session = new Session();
if ($_SESSION['csrf'] !== $_POST['csrf']) {
  die(header("Location: /../pages/login.php"));
}

$db = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  $username = $_POST['Username'];
 
  $stmt = $db->prepare("SELECT * FROM User WHERE username=:username");
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  $result=$stmt->fetch(); 

  if ($result === false ) {
    $stmt = $db->prepare("UPDATE User SET username=:username WHERE username=:sessionusername;");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':sessionusername', $session->getUsername());
    $stmt->execute();
    $session->setUsername($username);
  }
  else{
    die(header("Location: /../pages/editprofile.php"));
  }
  die(header("Location: /../pages/editprofile.php"));
 
}

?>