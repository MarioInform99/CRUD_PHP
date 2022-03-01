<?php
/**
 * Controlador del login 
 * @author Mario Salvatierra
 */

require_once('./model/user.model.php');
class LoginController{
    public  $ObjUser;
    public function __construct(){
        //Usamos la clase user_model que se encuentra en el model
        $this->ObjUser=new User();
    }
    /**
     * Controlamos la entrada de los datos del login
     * @return void
     */
    public function LoginEnter(){
        //Verficamos si se encuentra en la base de datos
        $checked=false;
        if(!empty($_REQUEST['email']) && isset($_REQUEST['email'])){
            $_SESSION['login']['email']=$_REQUEST['email'];
            $checked=true;
        }else{
            $checked=false;
        }
        if(!empty($_REQUEST['password']) && isset($_REQUEST['password'])){
            $_SESSION['login']['password']=$_REQUEST['password'];
            $checked=true;
        }else{
            $checked=false;
        }
        if($checked && $this->ObjUser->checked_login($_REQUEST)){
            require_once('./view/crud/crud.php');
            die();
        }
        require('./view/login/login.view.php');
        die();
    }

    public  function userRegister(){

    }
}