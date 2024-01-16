<?php
    declare(strict_types = 1);
    require_once('../database/connection.php');
    require_once('../utils/session.php');
    $session = new Session();

    $db = getDatabaseConnection();
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['question']) && isset($_POST['answer'])) {
        $question = $_POST['question'];
        $answer = $_POST['answer'];
        $stmt = $db->prepare("INSERT INTO FAQ (question, answer) VALUES (:question, :answer)");
        $stmt->bindParam(':question', $question);
        $stmt->bindParam(':answer', $answer);
        $stmt->execute();
      }
      die(header('Location:/../pages/login.php'));
?>