<?php function drawTicketPage() { ?>
   <body>
    <a href="/../pages/newticket.php"><button class="client_button" id="add_button" >Create ticket</button></a>
    <h2>My tickets</h2>
  </body>
  <?php } ?>


<?php
function drawTickets(Session $session) {
  
   require_once('../database/connection.php');
   $db = getDatabaseConnection();
 
   $user_id = $session->getUserid();

   $stmt = $db->prepare("SELECT ID_ticket, department, title_ticket,status_ FROM Ticket WHERE client_id = :user_id");
   $stmt->bindParam(':user_id', $user_id);

   $stmt->execute();
   $result = $stmt->fetchAll();

   ?>
   <table id="client_table">
   <tr>
   <th>Department</th>
   <th>Subject</th>
   <th>Status</th>
   </tr>
   <?php
   foreach ($result as $row) {
       echo "<tr>";
       echo "<td><p class=department>" . htmlentities($row['department']) . "</p></td>";
       echo "<td>";
       echo "<p class=subject>" . htmlentities($row['title_ticket']) . "</p>";
       echo "<a  href='/../pages/individualticket.php?ID_ticket=" . htmlentities($row['ID_ticket']) . "'><button class='client_button' id='read_more'>Read More</button></a>";
       echo "</td>";
       echo "<td><p class=status>" . htmlentities($row['status_']) . "</p></td>";
       echo "</tr>";
   }
   echo "</table>";
}

?>