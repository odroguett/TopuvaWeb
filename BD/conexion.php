<?php 

class Conexion
{

    private  $sUsuario;
    private $sPassword;
    private $db;
    private $host;
  
    private $conn;

    public function __construct() {
        //Instrucción sirve para leer archivo INI//
        $root = $_SERVER['DOCUMENT_ROOT'];
        $arrayIni= parse_ini_file($root . '/TopuvaWeb/Ini/app.ini',true);
        foreach($arrayIni as $filas => $value)
        {
            $this->sUsuario = $value['usuario'];
            $this->sPassword = $value['clave'];
            $this->db = $value['baseDatos'];
            $this->host = $value['host'];

        }
        
    }

    //Funcion para conectar a base de datos.
   function conectar()
    {

        
         
        try{
            $opciones = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::MYSQL_ATTR_FOUND_ROWS => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
          $this->conn= new PDO('mysql:host=localhost;dbname=topuva', $this->sUsuario, $this->sPassword, $opciones);   
          //Permite trabajar con UTF 8 
          $this->conn->exec("SET CHARACTER SET utf8");
        }
        catch(PDOException $e)
        {
        print "Error de conexion: " . $e->getMessage() . "<br/>";
        
        }

    }

  
    function ejecutarConsulta($sql,$array)
    {
        try
        {
            $this->conectar();
            $data = array();
            $result = $this->conn->prepare($sql);
            $result->execute($array);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                array_push($data, $row);
            }
            return($data);
        }
        catch(Exception $e)
        {
            return null;
            $e->getMessage();

        }


    }

    function ejecutarConsultaIndividual($sql)
    {
        try
        {
            $this->conectar();
            $data = array();
            $result = $this->conn->prepare($sql);
            $result->execute();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                array_push($data, $row);
            }
            return($data);
        }
        catch(Exception $e)
        {
            return null;
            $e->getMessage();

        }


    }

  
    function numeroFilas($sql)
    {
        $result = $this->conn->query($sql);
        $error = $this->conn->errorInfo();
 
        if ($error[0] === "00000") {
            $result->execute();
            return $result->rowCount();
        } else {
            throw new Exception($error[2]);
        }
    }

   

   function execBool($sql,$array)
   {
    try
    {
    $this->conectar();
    $result = $this->conn->prepare($sql);
    $result->execute($array);
    return true;
    }
    catch(Exception $e)
    {
        return false;
        $e->getMessage();

    }
   }

   

 

    function cerrar()
    {
        $conn=null;

    }

}


?>
