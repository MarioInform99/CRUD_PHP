<?php
/**
 * Controlador del login 
 * @author Mario Salvatierra
 */

require_once('./model/user_model.php');
class LoginController{
    public  $ObjUser;
    public function __construct(){
        $this->ObjUser=new User();
    }
    public function LoginEnter(){
        // var_dump($this->ObjUser);
        // $_SESSION['login']['user']="Mario";
        $this->ObjUser->LoginCheck();
        $this->checkRequestLogin($_REQUEST);
        if(!empty($_REQUEST['email']) && isset($_REQUEST['email'])){
            $_SESSION['login']['email']=$_REQUEST['email'];
        }
        if(!empty($_REQUEST['password']) && isset($_REQUEST['password'])){
            $_SESSION['login']['password']=$_REQUEST['password'];
        }
        
        var_dump($_SESSION);
       }
    /**
     * @param checkRequest
     * Nos ayudará a la hora de recorrer arrays, en las peticiones del usuario
     */
    public function checkRequestLogin($array = []){
        var_dump($array);echo "<br/>";
        foreach($array as $key=>$value){
            print_r($key."->".$value."<br/>");
        }
    }
}