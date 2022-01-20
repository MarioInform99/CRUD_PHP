<?php
/**
 * Clase de base de datos en la que nos conectaremos
 * @author "Mario Salvatierra"
 *  @param Database 
 */
 class Database{
    const user="root";
    const password="";
    const database="crud_php";
    const codefication="utf8";
    const server="localhost";

    protected  function connection_startUp(){
        //Inicializamos la conexion con la clase PDO
        try{
            $connection=new PDO('mysql:host='.self::server.';dbname='.self::database.';charset='.self::codefication,
            self::user,self::password);
            return $connection;
        }catch(PDOException $ex){
            echo "Ejecucion erronea en la conexion de la base de datos -> ".$ex->getMessage();
        }
    }

    /**
     * Problema de eficiencia a la hora de usar esta funcion ya que siempre que necesitamos
     * conectarnos a la base de datos tenemos que pasar por esta funcion asi que es poco eficiente
     * Para comprobar O crear la base de datos asi que lo meteremos entre comillas 
    //  */
    // private function createData($connection){
    //     //Con file_get_contents obtenemos en un solo String todo el archivo
    //     //Posteriormente convertiremos en un array con el delimitador ;
    //     $fileSQL=file_get_contents('crud_php.sql');
    //     $commands=explode(";",$fileSQL);
    //     try{
    //         $stmSL=$connection->query('SELECT * FROM `usuario`;');
    //     //Capturamos el error en caso de que no encontremos nada
    //     }catch(PDOException $ex){
    //         foreach($commands as $command){
    //             try{
    //                 $stm=$connection->query($command);
    //             }catch(PDOException $ex){
    //                 echo $ex->getMessage()."<br/>";
    //             }
    //         }
    //     }
    //     // $stm=$connection->prepare($sql);
    //     // $stm->execute();
    //     // if($stm){
    //     //     echo "Creacion con exito";
    //     // }else{
    //     //     echo "No se ha podido crear";
    //     // }
    // }

}