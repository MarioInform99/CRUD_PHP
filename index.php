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
if(isset($_SESSION['info_user']) && $_SESSION['info_user[status]']==1){
    require_once('./view/crud/crud.php');
    die();
}else if(isset($_REQUEST['register'])){
    $User->userRegister();
}else{
    //Si no cumple la condicion iniciamos 
    $User->userLogin();
}