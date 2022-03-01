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
    public function __construct(){}
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
                $connection=parent::connection_startUp();
                //Busco en la base de datos correo del usuario
                $sql="SELECT  ID, CORREO, NOMBRE,PASSWORD FROM usuario WHERE CORREO='$email'";
                //Realizamos la sentencia y la guardamos 
                //Esta nos debe de volver un array de objetos
                //Estos objetos tienen nombre de los atributos o campos
                // de la tabla
                $snt=$connection->query($sql,PDO::FETCH_OBJ);
                //Verificamos si contiene valor
                if($snt && $snt->rowCount()!=0){//Compruebo que la peticion ha sido correcto
                    //fetchObject obtiene la final y devuelve como objeto
                    $user=$snt->fetchObject();
                    if(password_verify($password,$user->PASSWORD)){
                        $info=array(
                            'ID'=>$user->ID,
                            'NOMBRE'=>$user->NOMBRE,
                            'CORREO'=>$user->CORREO
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
}