<?php 
/**
 * Clase del usuario en la que se encontrara toda la logica de la base de datos
 * @author Mario Salvatierra
 */
require_once('./model/database_model.php');
class User extends Database{
    public $email;
    public $password;
    public function __construct(){}
    /**
     * @param email
     */
    public function setEmail($email){
        if(!empty($email)){
            $this->email=$email;
        }
    }
    public function getEmail(){
        return $this->email;
    }
    /**
     * @param password
     */
    public function setPassword($password){
        if(!empty($password)){
            $this->password=$password;
        }
    }
    public function getPassword(){
        return $this->password;
    }
    /**
     * Login de usuario verificacion 
     */
    public  function LoginCheck(){
        $connection=parent::connection_startUp();
        var_dump($connection);
    }
}