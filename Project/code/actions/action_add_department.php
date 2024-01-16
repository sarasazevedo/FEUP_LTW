<?php
    declare(strict_types = 1);
    require_once('../database/connection.php');
    require_once('../utils/session.php');
    $session = new Session();

    $db = getDatabaseConnection();
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['department'])) {
        $department_name = $_POST['department'];
        $stmt = $db->prepare("INSERT INTO Department (name_department) VALUES (:name_department)");
        $stmt->bindParam(':name_department', $department_name);
        $stmt->execute();
      }
      die(header('Location:/../pages/login.php'));
?>