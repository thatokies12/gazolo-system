<?php
    
    session_start();
    //echo $_SESSION['user'];
    session_destroy();  //logging user out by destroying the session 
    //echo 'session has destroyed';
   header ("Location: index.php");
?>