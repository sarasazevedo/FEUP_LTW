<?php
function findAgentUsername($agent_id) {
      require_once('../database/connection.php');
      $db = getDatabaseConnection();

    $stmt = $db->prepare("SELECT username FROM User WHERE user_id=:agent_id");
    $stmt->bindParam(':agent_id', $agent_id);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['username'];
}
?>

<?php
function findClientUsername($client_id) {
      require_once('../database/connection.php');
      $db = getDatabaseConnection();
      require_once('../database/connection.php');
      $db = getDatabaseConnection();

      $stmt = $db->prepare("SELECT username FROM User WHERE user_id=:client_id");
      $stmt->bindParam(':client_id', $client_id);
      $stmt->execute();
      $result = $stmt->fetch();
      return $result['username'];
}
?>