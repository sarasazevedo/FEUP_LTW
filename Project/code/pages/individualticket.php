<?php
    declare(strict_types = 1); 
    require_once(dirname(__DIR__).'/templates/common.tpl.php');
    require_once(dirname(__DIR__).'/templates/ticketpage.tpl.php');
    require_once(dirname(__DIR__).'/templates/addticket.tpl.php');
    require_once(dirname(__DIR__).'/utils/session.php');
    require_once(dirname(__DIR__).'/database/connection.php');
    require_once(dirname(__DIR__).'/templates/agent.tpl.php');

    $session=new Session();
    if(!$session->isLoggedIn()){
        die(header("Location: /../pages/login.php"));
    }
    drawHeader();

    if (isset($_GET['ID_ticket'])) {
        $ID_ticket = (int)$_GET['ID_ticket'];

        if($session->getUsertype()>1){
            drawCloseTicket($ID_ticket);
        }
        

        if($session->getUsertype()>1){
            drawChangeDepartment($ID_ticket);
        };
        if($session->getUsertype()>1){
            drawAssignTicket($ID_ticket);
        };

        if($session->getUsertype()>2){
            drawUpgradeUsertoAgent($ID_ticket);
        }

        drawIndividualTicket($ID_ticket);
        
        if(drawMessages($ID_ticket)==false && $session->getUsertype()==1){
            drawReply($ID_ticket);
        };

        if($session->getUsertype()>1){
            drawReply($ID_ticket);
        };
        
    } 
    else {
        ?>  <p>This ticket doesn't exist. </p> <?php
    }
    drawFooter();
    
?>