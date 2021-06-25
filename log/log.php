<?php 

class Log
{
const ERROR = "ERROR";
const ADVERTENCIA="ADVERTENCIA";
const INFORMACION ="INFORMACION";
public $archivo="";

public function crearArchivo($nombreArchivo)
{
    try
    {
        $this->archivo = fopen($nombreArchivo, "a");
        if( $this->archivo == false ) {
          return false;
        }
        else
        {
         return true;

        }

    }
    catch(Exception $e)
    {

    }

    

}


public function cerrarArchivo()
{

    fclose($this->archivo);

}

public function EscribeLog($tipoInformacion,$error,$traza)
{

    try
    {
       if( $this->crearArchivo("../log/LogConsultas.txt"))
       {
        $dt = new DateTime('today');
        $date = $dt->format('m/d/Y');
        fwrite($this->archivo,  $date . $tipoInformacion . ' ' . $error . "\r\n"  );
       // fwrite($this->archivo, $tipoInformacion . ' ' . $error . "\r\n" );
        fflush($this->archivo);
        $this->cerrarArchivo();

       }
       else
       {
        $this->cerrarArchivo();

       }

        

    }

    catch(Exception $e)
    {

        $this->cerrarArchivo();
    }


    
}

public function EscribeLogBaseDatos()
{


}



}

?>