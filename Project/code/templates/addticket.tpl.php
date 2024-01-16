<?php 
function drawNewTicket() { 
?>

<body>
  <h1>Ticket</h1>
  <section class="ticket_form">
  <form method="POST" action="/../actions/action_addticket.php">
  <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
    <select name="department" required>
    <?php selectOptions();  ?>
    </select>

    <div class="Ticket">
      <div>
        Subject <input type="text" placeholder="Enter Subject" name="subject" required>
      </div>
      <div>
        Description <br> <textarea rows="10" cols="50" placeholder="Enter Description" name="description" required style="resize: none;"></textarea>
      </div>
      <div>
        <button type="submit">Submit</button>
      </div>
    </div>
  </form>
  <a1> <a href="ticketpage.php">Exit to main page</a></a1>
</section>
</body>


<?php } 

function selectOptions() {
  require_once(__DIR__ . '/../database/connection.php');
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT name_department FROM Department');
        $stmt->execute();
        $departments = $stmt->fetchAll();
        foreach ($departments as $department) {
            echo '<option value="' . htmlentities($department['name_department']) . '">' . $department['name_department'] . '</option>';
        }
}

?>
  