<?php 
/**
 * Clase del usuario en la que se encontrara toda la logica de la base de datos
 * @author Mario Salvatierra
 */
require_once('./model/database.model.php');
class User extends Database{
    public $email;
    public $password;
    /**
     * @__construct
     */
    public function __construct(){
        //Iniciamos la conexion
        parent::connection_start();
    }
    /**
     * Asignación de email
     * @param email
     */
    public function setEmail($email){
        if(!empty($email)){
            $this->email=$email;
        }else{
            print("ERROR EMAIL");
            die();
        }
    }
    /**
     * Obtener la email
     * @return String - email 
     */
    public function getEmail(){
        return $this->email;
    }
    /**
     * Asignacion  de contraseña
     * @param password
     */
    public function setPassword($password){
        if(!empty($password)){
            $this->password=$password;
        }
    }
    /**
     * Obtener la contraseñaw
     * @return String - password 
     */
    public function getPassword(){
        return $this->password;
    }
    /**
     * Login de usuario verificacion 
     * Devulve true/false si este se encuentra en la base de datos
     * @method checked_login()
     * @param array
     * @return boolean
     */
    public  function checked_login($array=[]){
        $found=false;
        //Usamos la superclase de la base de datos
        //Iniciamos la conection
        $email="";
        $password="";
        //Verficamos que el array que nos pasa no esta vacio
        if(count($array)!=0){
            foreach($array as $key=>$value){
                //Comprobamos que nos pasa lo que indicamos
                if($key=="email"){
                    $email=$value;
                }else if($key=="password"){
                    $password=$value;
                }
            }
        }
        //Verficamos que no esta vacio
        if(!empty($email) && !empty($password)){
            try{
                //Conexion con la base de datos
                $connection=parent::getConnection();
                //Busco en la base de datos correo del usuario
                $user=$this->getUsers($email);
                if($user){
                    if(password_verify($password,$user->PASSWORD)){
                        $info=array(
                            'ID'=>$user->ID,
                            'NOMBRE'=>$user->NOMBRE,
                            'CORREO'=>$user->CORREO,
                            'status'=>1
                        );
                        $_SESSION['info_user']=$info;
                        $found=true;
                    }
                }
                //Consultamos los controladores de PDO
                // var_dump(PDO::getAvailableDrivers());
            }catch(PDOException $ex){
                print("Error en la verificacion de la base de datos ->".$ex->getMessage());
            }
        }
        return $found;
    }

    /**
     * Registro del usuario en la base de datos, con la encriptación SHA265
     * @method register_user()
     * @return true 
     * @param name,email,password
     */
     public function register_user($name="",$email="",$password=""){
            //Encriptamos la contraseña del usuario
            $password=password_hash($password,PASSWORD_DEFAULT);
            try{
                $user=$this->getUsers($email);
                if($user==false){
                    $connection=parent::getConnection();
                    $sql='INSERT INTO `usuario` (`NOMBRE`,`CORREO`,`PASSWORD`) VALUES (:name, :email, :password)';
                    $snt=$connection->prepare($sql);
                    //introducimos los parametros, que deberían de estar comprobados
                    $snt->bindParam(':name',$name);
                    $snt->bindParam(':email',$email);
                    $snt->bindParam(':password',$password);
                    //ejecutamos 
                    $snt->execute();
                    if($snt){
                        $msg="<span class=\"green\">Usuario registrado, correctamente</span>";
                    }else{
                        $msg="<span class=\"red\">Fallo al registrar el usuario</span>";
                    }
                }else{
                    $msg= "<span class=\"red\">El correo ya existe</span>";
                }
            }catch(PDOException $ex){
                print("Error en la introducción en la base de datos->".$ex->getMessage()."");
            }
     }

     /**
      * Obtenemos todos los usuarios de la base de datos
      *@param String or NULL
      *@return Object
      */
      public function getUsers($condition=null){
        if($condition==null || empty($condition)){
            $sql='SELECT ID,NOMBRE, CORREO, PASSWORD FROM usuario;';
        }else{
            $sql="SELECT ID,NOMBRE,CORREO, PASSWORD FROM usuario WHERE CORREO='$condition';";
        }
        try{
            //Obtenemos el objeto que nos sirve para realizar peticiones en la base de datos.
            $connection=parent::getConnection();
            $snt=$connection->query($sql, PDO::FETCH_OBJ);
            if($snt){
                return $snt->fetchObject();
            }
            return false;
        }catch(PDOException $ex){
            print('Error en la consulta de la base de datos.->'.$ex->getMessage());
        }
      }
}