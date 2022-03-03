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
                    if($user->PASSWORD=='1234'){
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
            print("$name, $email, $password");
            //Encriptamos la contraseña del usuario
            $password=password_hash($password,PASSWORD_DEFAULT);
            try{
                //Iniciamos la conexion con la base de datos
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
                    echo "todo correcto";
                }else{
                    echo "fallo";
                }

            }catch(PDOException $ex){
                print("Error en la introducción en la base de datos->".$ex->getMessage()."");
            }
     }
}