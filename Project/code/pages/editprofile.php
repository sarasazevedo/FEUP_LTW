<?php
    declare(strict_types = 1);
    require_once(dirname(__DIR__).'/templates/common.tpl.php');
    require_once(dirname(__DIR__).'/utils/session.php');
    require_once(dirname(__DIR__).'/templates/register.tpl.php');
    $session=new Session();
    if(!$session->isLoggedIn()){
        die(header("Location: /../pages/login.php"));
    }
    drawHeader();
    drawEditProfile($session);
    drawFooter(); 
?>