<?php
/**
 * Clase de base de datos en la que nos conectaremos
 * @author "Mario Salvatierra"
 *  @Class Database 
 */
 class Database{
     /**
      * Iniciamos los atributos esenciales para conectarnos a la base de datos
      Estos deben de ser privados
      * @atributos
      */
    private const USER="root";
    private const PASSWORD="";
    private const DATABASE="crud_php";
    private const CODE="utf8";
    private const SERVER="localhost";
    public $connection;

    /**
     * Esta funcion nos devolvera un array que se crea para poder realizar peticiones o consultas en 
     * la base de datos
     * nos deberia de devolver un objeto PDO
     * @return connection
     */
    public function getConnection(){
        return $this->connection;
    }
    /**
     * Asignamos un objeto a la conexion
     * @param Object PDO 
     * @return void
     */
    public function setConnection($ObjectPDO){
        $this->connection=$ObjectPDO;
    }
    /**
     * Instanciamos la clase PDO 
     * @return void
     */
    protected  function connection_start(){
        //Inicializamos la conexion con la clase PDO
        try{
            $connection=new PDO('mysql:host='.self::SERVER
                        .';dbname='.self::DATABASE
                        .';charset='.self::CODE,
                        self::USER,self::PASSWORD);
            //Pasamos el objeto 
            $this->setConnection($connection);
        }catch(PDOException $ex){
            print("Ejecucion erronea en la conexion de la base de datos -> ".$ex->getMessage());
            die();
       }
    }

}