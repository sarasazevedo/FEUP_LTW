<?php
    declare(strict_types = 1);
    require_once('../database/connection.php');
    require_once('../utils/session.php');
    $session = new Session();

    $db = getDatabaseConnection();

    if ($_POST['Password'] === $_POST['Password1']) {

        $username = $_POST['Username'];
        $password = sha1($_POST['Password']);
        $email = $_POST['Email'];

        $stmt = $db->prepare("INSERT INTO User (username, password, email,usertype) VALUES (:username, :password, :email,1)");

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $result = $stmt->execute();

    } else {
        die(header('Location: ../pages/register.php'));
    }

    die(header('Location: /../pages/login.php'));
?>

