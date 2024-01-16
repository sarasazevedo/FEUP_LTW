<?php
    declare(strict_types = 1); 
    require_once(dirname(__DIR__).'/templates/common.tpl.php');
    require_once(dirname(__DIR__).'/templates/ticketpage.tpl.php');
    require_once(dirname(__DIR__).'/templates/agent.tpl.php');
    require_once(dirname(__DIR__).'/utils/session.php');
    require_once(dirname(__DIR__).'/actions/action_listby.php');


    $session=new Session();
    if(!$session->isLoggedIn()){
        die(header("Location: /../pages/login.php"));
    }
    drawHeader();
    if($session->getUsertype()>2){
        drawAddDepartment();
    }
    
    drawListBy();
    drawTicketsAgent($session);
    drawFooter(); 
?>