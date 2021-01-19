<?php

session_start();

if(isset($_SESSION['notification']))
{
    $notif = $_SESSION['notification'];
}else{
    $notif = NULL;
}

?>