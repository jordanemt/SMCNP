<?php

    session_start();
    
    if(!isset($_SESSION['contador'])){
        $_SESSION['contador']=0;
    }else{
        $_SESSION['contador']++;
        echo $_SESSION['contador'];
    }
    
    if(isset($_GET['borrar']))
        unset ($_SESSION['contador']);
    
?>
