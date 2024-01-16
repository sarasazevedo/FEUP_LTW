<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawHeader() { ?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/../css/style.css" rel="stylesheet">
   </head>
  <body>
    <div class="ticket_handler"> 
      <nav>
      <a href="../pages/ticketpage.php"> <img src="../image/img.jpg" class="logo"> <h1>Ticket Handler</h1></a>

        <ul>
          <li> <a href="/../pages/newticket.php">Create Ticket</a></li>
          <li> <a href="/../pages/editprofile.php">Edit profile</a></li>
          <li> <a href="/../pages/faq.php">FAQ</a></li>
          <li> <a href="/../actions/action_logout.php">Logout</a></li>
        </ul>
      </nav>
</div>

    
<?php } ?>

<?php function drawFooter() { ?>
    </main>

    <footer class="footer">
      LTW TicketHandler &copy; 2023
    </footer>
  </body>
</html>
<?php } ?>

<?php function drawLogout() { ?>
   <body>
 <a href='/../actions/action_logout.php'>Logout</a>
  </body>
  <?php } ?>

  <?php function drawProfile() { ?>
   <body>
 <a href='/../pages/editprofile.php'><button type='submit'>Edit profile</button></a>
  </body>




  <?php } function drawFaq() { 
        $db = getDatabaseConnection();

        $stmt = $db->prepare("SELECT question,answer FROM FAQ");
        $stmt->execute();

        $faqs = $stmt->fetchAll();

        if ($faqs) {
            echo "<dl>";
            foreach ($faqs as $faq) {
                echo "<dt id=question> Question:". htmlentities($faq['question']) . "</dt>";
                echo "<dd id = answer> Answer:". htmlentities($faq['answer']) . "</dd>";
            }
            echo "</dl>";
        } else {
            echo "<p>No FAQs found.</p>";
        }
    } ?>

<?php function drawFaqdraw() { ?>
   <body>
 <a href='/../pages/faq.php'><button type='submit'>FAQ</button></a>
  </body>
<?php } ?>


