<?php
require_once('../database/connection.php');
require_once('../utils/session.php');
$session = new Session();

$db = getDatabaseConnection();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  $username = $_POST['Username'];
  $password = sha1($_POST['Password']);

  
  $stmt = $db->prepare("SELECT * FROM User WHERE username=:username AND password=:password");


  $stmt->bindParam(':username', $username);
  $stmt->bindParam(':password', $password);


  $stmt->execute();
  
  $result=$stmt->fetch(); 

  if ($result !== false ) {

    $session->setCurrentUser($result['username'],$result['email'],$result['usertype'],$result['user_id']);

    die(header("Location: /../pages/ticketpage.php"));
  }
}
die(header("Location: /../pages/login.php"));

?>