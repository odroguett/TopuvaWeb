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
    catch(Error $e)
    {

    }

}


public function cerrarArchivo()
{

    fclose($this->archivo);

}

public function EscribeLog($tipoInformacion,$error,$codigo,$linea)
{
   
    try
    {
       if( $this->crearArchivo("../log/LogErrores.txt"))
       {



        $dt = new DateTime('today');
        $date = $dt->format('m/d/Y');
        fwrite($this->archivo,  $date  . ' Informacion ' . $tipoInformacion .  ' Mensaje:::: ' . 
               $error . ' Codigo Exepcion:::: ' . $codigo . '  Linea Error:::: ' . $linea  . "\r\n"  );
        fflush($this->archivo);
        $this->cerrarArchivo();

       }
       else
       {
        $this->cerrarArchivo();

       }

        

    }

    catch(Error $e)
    {

        $this->cerrarArchivo();
    }


    
}

public function EscribeLogBaseDatos()
{


}



}

?>