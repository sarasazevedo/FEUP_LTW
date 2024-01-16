<?php
class Session {
  public function __construct() {
    session_start();
    if (!isset($_SESSION['csrf'])) {
      $_SESSION['csrf'] = $this->generate_random_token();
    }
  }

  public function setCurrentUser($username, $email,$usertype,$user_id) {
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['usertype'] = $usertype;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['id'] = 1;

  }
  
  public function generate_random_token() {
    return bin2hex(openssl_random_pseudo_bytes(32));
  }

  public function setSelected($selected) {
    $_SESSION['selected'] = $selected;
  }
  public function getSelected() {
    if (isset($_SESSION['selected'])) {
        return $_SESSION['selected'];
    } else {
        return null;
    }
  }

  public function isLoggedIn() : bool {
    return isset($_SESSION['id']);    
  }

  public function logout() {
    session_destroy();
  }

  function getEmail() {
    if(isset($_SESSION['email'])) {
      return $_SESSION['email'];
    } else {
      return null;
    }
  }

  function setEmail($email){
    $_SESSION['email'] = $email;
  }

  function getUsername() {
    if(isset($_SESSION['username'])) {
      return $_SESSION['username'];
    } else {
      return null;
    }
  }

  function getUserid() {
    if(isset($_SESSION['user_id'])) {
      return $_SESSION['user_id'];
    } else {
      return null;
    }
  }

  function setUsername($username){
    $_SESSION['username'] = $username;
  }


  function getUsertype() {
    if(isset($_SESSION['usertype'])) {
      return $_SESSION['usertype'];
    } else {
      return null;
    }
  }

  function setUsertype($usertype){
    $_SESSION['usertype'] = $usertype;
  }

}


?>