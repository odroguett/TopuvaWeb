<?php 

class Conexion
{

    private  $sUsuario;
    private $sPassword;
    private $db;
    private $host;
  
    private $conn;

    public function __construct() {
        $this->sUsuario = 'root';
        $this->sPassword = 'Topuva.12345';
        $this->db = 'topuva';
        $this->host = 'localhost';
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

    function traerDatos($sql)
    {
        try
        {
            $this->conectar();
            
 
           $data = array();
            $result = $this->conn->query($sql);
     
            $error = $this->conn->errorInfo();
            if ($error[0] === "00000") {
                $result->execute();
                if ($result->rowCount() > 0) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        array_push($data, $row);
                    }
                }
            } else {
                throw new Exception($error[2]);
                $this->cerrar();
            }
            $this->cerrar();
            return $data;
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

    function traerDatosIndividuales($sql)
    {
 
        $result = $this->conn->query($sql);
 
        $error = $this->conn->errorInfo();
 
        if ($error[0] === "00000") {
            $result->execute();
            if ($result->rowCount() > 0) {
                return $result->fetch(PDO::FETCH_ASSOC);
            }
        } else {
            throw new Exception($error[2]);
        }
        return null;
    }

    function traerPropiedadesIndividuales($sql, $prop)
    {
 
        $result = $this->conn->query($sql);
        $error = $this->conn->errorInfo();
 
        if ($error[0] === "00000") {
            $result->execute();
            if ($result->rowCount() > 0) {
                $data = $result->fetch(PDO::FETCH_ASSOC);
                return $data[$prop];
            }
        } else {
            throw new Exception($error[2]);
        }
        return null;
    }

   

    function execBool($sql)
    {
 
        $result = $this->conn->exec($sql);
        $error = $this->conn->errorInfo();
 
        if ($error[0] === "00000") {
            return true;
        } else {
            throw new Exception($error[2]);
            return false;
        }
    }
 

    function cerrar()
    {
        $conn=null;

    }

}








//$conn= mysqli_connect(
 //   'localhost',
  //  'root',
  //  'Topuva.12345',
  //  'topuva'
//);
//if(isset($conn))
//{

  //  echo 'Conectados';

//};

?>
