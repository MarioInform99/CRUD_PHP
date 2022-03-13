<?php
/**
 * Controlador del login y verificamos las entradas del usuario.
 * @author Mario Salvatierra
 */
require_once('./model/user.model.php');
require_once('./model/message.model.php');
class LoginController{
    public  $ObjUser;
    public $msg;
    public function __construct(){
        //Usamos la clase user_model que se encuentra en el model
        $this->ObjUser=new User();
        $this->msg=new Message();
    }
    /**
     * Controlamos la entrada de los datos del login
     * @return void
     */
    public function userLogin(){
        //Verficamos si se encuentra en la base de datos
        $checked=false;
        if(!empty($_REQUEST['email']) && isset($_REQUEST['email'])){
            $_SESSION['login']['email']=$_REQUEST['email'];
            $checked=true;
        }else{
            $checked=false;
        }
        if(!empty($_REQUEST['password']) && isset($_REQUEST['password'])){
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

    /**
     * Este metodo, realizaremos un bucle del metodo o verbo http. Para evitar realizar if {}else{} anidado 
     * ya que es bastante tedioso.
     * @return void
     */
    public  function userRegister(){
        $msgError="";
        $error=false;
        //Este array posteriormente se implementara en otra clase para poder implementar el feedback al usuario
        $msg=array();
        //Realizo un bucle para verificar que los campos esten vacios, pero no compruebo el boton
        foreach($_REQUEST as  $name=>$value){
            if($name!='register'){
                if(empty($value)){
                    $error=true;
                    array_push($msg,$name); //añade elementos al array
                }
            }
        }
        if(isset($_REQUEST['password']) && isset($_REQUEST['repeat_password']) && $_REQUEST['password']==$_REQUEST['repeat_password']){
            $error=true;
            array($msg,'repeat_password');
        }
        //Verificamos que no exita ningun error
        if(!$error){
            $this->ObjUser->register_user($_REQUEST['name'],$_REQUEST['email_regis'],$_REQUEST['password_regis']);
            require_once('./view/login/login.view.php');
            die();
        }else if(count($_REQUEST)!=0){
            $msgError=$this->msg->getMessageRegister($msg,$_REQUEST);
        }
        require_once('./view/login/register.view.php');
        die();
    }
}