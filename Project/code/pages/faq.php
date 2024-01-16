<?php
    declare(strict_types = 1); 
    require_once(dirname(__DIR__).'/templates/common.tpl.php');
    require_once(dirname(__DIR__).'/templates/agent.tpl.php');
    require_once(dirname(__DIR__).'/utils/session.php');
    require_once(dirname(__DIR__).'/database/connection.php');
    require_once(dirname(__DIR__).'/templates/ticketpage.tpl.php');
    $session=new Session();
    drawHeader();
    if($session->getUsertype()>1){
        drawAddQuestion();
    }
    drawFaq();
    drawFooter();
?>