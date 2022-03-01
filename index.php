<?php
/**
 * Implementamos las librerias o clases necesarias
 * Implementamos el controlador del usuario
 */
require_once('./controller/login.controller.php');
$User=new LoginController();
//Iniciamos la sesion con session_start()
if(session_status()==PHP_SESSION_NONE){session_start();}
//Verificamos si se ha creado el login de session, que es un 
//array
if(isset($_SESSION['login[status]']) && $_SESSION['login[status]']==1){
    require_once('./view/crud/crud.php');
    die();
}else if(isset($_REQUEST['register'])){
    var_dump($_REQUEST);
    require_once('./view/login/register.view.php');
    die();
}else{
    var_dump($_REQUEST);
    //Si no cumple la condicion iniciamos 
    $User->LoginEnter();
}