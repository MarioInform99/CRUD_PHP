<?php
require('./view/login/login_view.php');
require_once('./controller/login_controller.php');

if(session_status()==PHP_SESSION_NONE){session_start();}
if(isset($_SESSION['login[status]']) && $_SESSION['login[status]']==true){
    require_once('./view/crud/crud.php');
}else{
    $User=new LoginController();
    $User->LoginEnter();
}