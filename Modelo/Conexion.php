<?php
/**
 * Creacion de conexion con msql
 *
 */
class Conexion extends PDO{
    //varibles de la conexion
    private static $instancia=null;
    private $host="localhost";
    private $port ="3306";
    private $userName='root';
    private $password="";
    private $dataBase = "gestioncontacto-php";
    
    public function __construct(){
        try{
           parent::__construct("mysql:host={$this->host};port={$this->port};dbname={$this->dataBase}",
              $this->userName, $this->password);
          $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        //   echo "Conectado con exito a la base de datos";

        } catch (PDOException $ex) {
           echo  "La conexión ha fallado:".$ex->getMessage();
        }
    }
    
    public static function singleton(){
        if (!isset(self::$instancia)){
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }
    
}