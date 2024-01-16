<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawRegister() { ?>
<h1>Register</h1>
<title>Register</title>
    <form class="ticket_form" method ="POST" action="/../actions/action_register.php">
      <div class="Register">
      <div>
        Username <input type = "text" placeholder = "Enter Username" name = "Username" required>
      </div>
      <div>
        Email <input type = "text" placeholder = "Enter Email" name = "Email" required>
      </div>
      <div>
        Password <input type = "password" placeholder = "Enter Password" name = "Password" required>
      </div>
      <div>
        Confirm Password <input type = "password" placeholder = "Confirm Password" name = "Password1" required>
      </div>  
      <div>
        <button type="submit" >Register </button>
      </div> 
        <a1>Already have an account? <a href="login.php">Login</a></a1>
    </div>
    </form>
    <?php } ?>

  
<?php function drawLogin() { ?>
  <h1>Login</h1>
  <title>Login</title>
    <form class="ticket_form" method ="POST" action="/../actions/action_login.php">
      <div class="Login">
      <div>
        Username <input type = "text" placeholder = "Enter Username" name = "Username" required>
      </div>
      <div>
        Password <input type = "password" placeholder = "Enter Password" name = "Password" required>
      </div> 
      <div>
        <button type="submit" >Login</button>
      </div> 
        <a1>Don't have an account? <a href="/../pages/register.php">Register</a></a1>
    </div>
    </form>
    <?php } ?>


    <?php
function drawEditProfile($session)
{
?>
  <section class="ticket_form">
  <form method="POST" action="/../actions/action_editusername.php">
  <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
    <div class="EditUsername">
      <div>
        <p> Current username : <?php echo htmlentities($session->getusername()); ?> </p>
        <p> <input type="text" placeholder="Enter Username" name="Username"></p>
      </div>
      <div>
        <button type="submit">Edit</button>
      </div>
    </div>
  </form>
  <form method="POST" action="/../actions/action_editemail.php">
  <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
    <div class="EditEmail">
      <div>
      <p> Current email : <?php echo htmlentities($session->getEmail()); ?> </p>
         <input type="text" placeholder="Enter Email" name="Email">
      </div>
      <div>
        <button type="submit">Edit</button>
      </div>
    </div>
  </form>
  <form method="POST" action="/../actions/action_editpassword.php">
  <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
    <div class="Editpassword">
      <div>
        Password <input type="password" placeholder="Enter Password" name="Password">
      </div>
      <div>
        <button type="submit">Edit</button>
      </div>
    </div>
  </form>
</section>
<?php
}
?>