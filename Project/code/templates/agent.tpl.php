
<?php function drawViewTickets() { ?>
   <body>
    <a href="/../pages/viewtickets.php"><button class ="agent_button" id="add_button">VIEW TICKETS</button></a>
  </body>
  <?php } ?>



  <?php function drawAddDepartment() { 
   ?>
   <body>
    <button class="admin_button" id="add_button">Add department</button>
    <script src="/../javascript/add_department.js"></script>
    <script>
      drawAddDepartmentjs();
    </script>
  </body>
  <?php } ?>


<?php
function drawTicketsAgent(Session $session) {
  require_once('../actions/action_listby.php');
  require_once('../database/connection.php');
  require_once('../pages/viewtickets.php');
  require_once('../database/helperfunctions.php');

  $db = getDatabaseConnection();
  
  $user_id = $session->getUserid();
  if ($session->getSelected()) {
    $selected = $session->getSelected();
    switch ($selected) {
      case 'recently':
        $stmt = $db->prepare("SELECT ID_ticket, department, title_ticket, status_, client_id, agent_id FROM Ticket WHERE client_id <> :client_id ORDER BY time DESC");
          break;
      case 'oldest':
        $stmt = $db->prepare("SELECT ID_ticket, department, title_ticket, status_, client_id, agent_id FROM Ticket WHERE client_id <> :client_id ORDER BY time ASC");
          break;
      case 'open':
        $stmt = $db->prepare("SELECT ID_ticket, department, title_ticket, status_, client_id, agent_id FROM Ticket WHERE client_id <> :client_id AND status_ = 'open' ORDER BY time ASC");
          break;
      case 'department':
        $stmt = $db->prepare("SELECT ID_ticket, department, title_ticket, status_, client_id, agent_id FROM Ticket WHERE client_id <> :client_id ORDER BY department ASC");
          break;
      default:
        $stmt = $db->prepare("SELECT ID_ticket, department, title_ticket, status_, client_id, agent_id FROM Ticket WHERE client_id <> :client_id ORDER BY time ASC");
          break;
    }
  }
  else{
    $stmt = $db->prepare("SELECT ID_ticket, department, title_ticket, status_, client_id, agent_id FROM Ticket WHERE client_id <> :client_id ORDER BY time ASC");
  }

  $stmt->bindParam(':client_id', $user_id);
  $stmt->execute();
  $result = $stmt->fetchAll();

  echo "<table id ='agent_table'>";
  echo "<tr>";
  echo "<th>Department</th>";
  echo "<th>Subject</th>";
  echo "<th>Client</th>";
  echo "<th>Agent</th>";
  echo "<th>Status</th>";
  echo "</tr>";
  foreach ($result as $row) {
      echo "<tr>";
      echo "<td>" .  htmlentities($row['department']) . "</td>";
      echo "<td>";
      echo "<p class=subject>" . htmlentities($row['title_ticket']) . "</p>";
      echo "<a  href='/../pages/individualticket.php?ID_ticket=" . htmlentities($row['ID_ticket']) . "'><button id=read_more class='agent_button'>Respond</button></a>";
      echo "</td>";
      echo "<td>" . findClientUsername(htmlentities($row['client_id'])) . "</td>";
      echo "<td>" . findAgentUsername(htmlentities($row['agent_id'])) . "</td>";
      echo "<td>" . htmlentities($row['status_']) . "</td>";
      echo "</tr>";
  }
  echo "</table>";
}


function drawIndividualTicket(int $ID_ticket) {
        require_once('../database/connection.php');
        $db = getDatabaseConnection();
    
        $stmt = $db->prepare("SELECT * FROM Ticket WHERE ID_ticket = :ID_ticket");
        $stmt->bindParam(':ID_ticket', $ID_ticket);
        $stmt->execute();
    
        $ticket = $stmt->fetch();
    
        if ($ticket) {
          echo "<div class='ticket_details'>";
          echo "<h2>Ticket Details</h2>";
          echo "<p><strong>Department:</strong> " . htmlentities($ticket['department']) . "</p>";
          echo "<p><strong>Subject:</strong> " . htmlentities($ticket['title_ticket']) . "</p>";
          echo "<div class='description_box'>";
          echo "<p><strong>Description:</strong></p>";
          echo "<p>" . htmlentities($ticket['description']) . "</p>";
          echo "</div>";
          echo "</div>";
        } else {
            echo "<p>This ticket doesn't exist.</p>";
        }
    }

    function drawMessages(int $ID_ticket) {
      require_once('../database/connection.php');
      $db = getDatabaseConnection();
      $stmt = $db->prepare("SELECT * FROM Message_ WHERE ticket_id = :ticket_id");
            $stmt->bindParam(':ticket_id', $ID_ticket);
            $stmt->execute();
            $messages = $stmt->fetchAll();
            if($messages) {
              ?>
              <div class="message_chat">
              <?php foreach ($messages as $message): ?>
                
                <div class="message">
                  <span class="time"><?php echo date('d/m/Y H:i', strtotime($message['time'])); ?></span>
                  <span class="sender"><?php echo htmlentities($message['sender_username']); ?>:</span>
                  <span class="content"><?php echo htmlentities($message['content']); ?></span>
                </div>
              <?php endforeach; ?>
            </div>
            <?php
                return 0;
            }
            return 1;
  }

    function drawCloseTicket($ID_ticket) {
      ?>
      <body>
       <a href='/../actions/action_close_ticket.php?ticket_id=<?php echo $ID_ticket; ?>'><button class ="agent_button" id="add_button">Close Ticket</button></a>
     </body>

  <?php  }
    
function drawReply(int $ID_ticket) {
    ?>
    <form class="ticket_form" method='POST' action='/../actions/action_message.php'>
    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
    <input type='hidden' name='ticket_id' value='<?php echo $ID_ticket; ?>' />
    <textarea id='resposta' name='resposta' placeholder='Enter your response here' rows='6' cols='40' style='resize: none;'></textarea>
    <button class="agent_button" type='submit' value='Submit'> Submit</button>
    </form>
<?php
}
?>




<?php function drawAddQuestion() { 
   ?>
   <body>
    <button class="agent_button" id="add_button">Add question</button>
    <script src="/../javascript/add_question.js"></script>
    <script>
      drawAddQuestionjs();
    </script>
  </body>
  <?php } ?>


  <?php function drawUpgradeUser() { 
   ?>
   <body>
    <button id="add_button">Upgrade User</button>
    <script src="/../javascript/upgrade_user.js"></script>
    <script>
      upgradeUserjs();
    </script>
  </body>
  <?php } ?>
  
  <?php function drawListBy() { 
  ?>
  <body>
  <script src="/../javascript/listby.js"></script>
  <script>
    drawListByjs();
  </script>
</body>
<?php } ?>


<?php
function drawChangeDepartment($ID_ticket) {
?>

<body>
  <form class="ticket_form" method="POST" action="/../actions/action_change_department.php">
    <input type="hidden" name="ID_ticket" value="<?php echo $ID_ticket; ?>">
    <select name="department" required>
      <?php selectOptions(); ?>
    </select>
    <div>
      <button type="submit">Change Department</button>
    </div>
  </form>
</body>

<?php
}
?>


<?php
function drawAssignTicket($ID_ticket) {
?>

<body>
  <form class="ticket_form" method="POST" action="/../actions/action_assign_ticket.php">
    <input type="hidden" name="ID_ticket" value="<?php echo $ID_ticket; ?>">
      <button type="submit">Assign Ticket to Yourself</button>
    </div>
  </form>
</body>
<?php
}
?>


<?php
function drawUpgradeUsertoAgent($ID_ticket) {
?>

<body>
  <form class="ticket_form" method="POST" action="/../actions/action_upgrade_user.php">
    <input type="hidden" name="ID_ticket" value="<?php echo $ID_ticket; ?>">
      <button type="submit">Upgrade Client to Agent</button>
    </div>
  </form>
</body>
<?php
}
?>
