<?php
    declare(strict_types = 1); 
    require_once(dirname(__DIR__).'/templates/common.tpl.php');
    require_once(dirname(__DIR__).'/templates/register.tpl.php');
    require_once(dirname(__DIR__).'/utils/session.php');
    
    drawHeader();
    drawRegister();
    drawFooter(); 
?>