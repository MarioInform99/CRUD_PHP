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
            $this->createData($connection);
            return $connection;
        }catch(PDOException $ex){
            echo "Ejecucion erronea en la conexion de la base de datos -> ".$ex->getMessage();
        }
    }

    private function createData($connection){
        $fileSQL=file_get_contents('crud_php.sql');
        var_dump($fileSQL);
        // $stm=$connection->prepare($sql);
        // $stm->execute();
        // if($stm){
        //     echo "Creacion con exito";
        // }else{
        //     echo "No se ha podido crear";
        // }
    }

}