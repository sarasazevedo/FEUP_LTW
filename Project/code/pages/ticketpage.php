<?php
    declare(strict_types = 1); 
    require_once(dirname(__DIR__).'/templates/common.tpl.php');
    require_once(dirname(__DIR__).'/templates/ticketpage.tpl.php');
    require_once(dirname(__DIR__).'/templates/agent.tpl.php');
    require_once(dirname(__DIR__).'/utils/session.php');

    $session=new Session();
    drawHeader();
    if ($session->getUsertype()>1){
        drawViewTickets();
    }
    drawTickets($session);
    drawFooter();
?>