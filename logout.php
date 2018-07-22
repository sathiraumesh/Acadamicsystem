<?php

if(isset($_POST['logout'])){
    session_start();
    session_unset();
    header('Location: index.php');
    
}


if(isset($_POST['logoutadmin'])){
    session_start();
    session_unset();
    header('Location: admin_login.php');
    
}
    



?>