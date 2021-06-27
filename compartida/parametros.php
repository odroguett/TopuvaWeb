<?php 
//require("BD/catalogoBD.php");
class Parametros
{

    private static $instance;
    public $costoEnvio;
    public $avisoStock;
    public $topeCostoEnvio;
    public $nombreLog;
    public $smtp;
    public $usuarioCorreo;
    public $contrasenaCorreo;
    public $puertoCorreo;
    public $telefono;
    public $banco;
    public $Rut;
    public $nombreDeposito;
    public $correoDeposito;

private function __construct()
{
  
}
public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Parametros();
            self::$instance->cargaParametros();
        }
        return self::$instance;
    }
    public function __clone()
    {
        trigger_error('');
    }

    public function cargaParametros()
{
    $oCatalogo= new catalogoBD();
    $Listafilas=$oCatalogo->cargaParametros();
    foreach($Listafilas as $filas => $value)
    {
        $this->costoEnvio = $value['COSTO_ENVIO'];
        $this->avisoStock = $value['AVISO_STOCK'];
        $this->topeCostoEnvio = $value['TOPE_COSTO_ENVIO'];
        $this->nombreLog = $value['NOMBRE_LOG'];
        $this->smtp = $value['SMTP'];
        $this->usuarioCorreo = $value['USUARIO_CORREO'];

        $this->contrasenaCorreo = $value['CONTRASENA_CORREO'];
        $this->puertoCorreo = $value['PUERTO_CORREO'];
        $this->telefono = $value['TELEFONO'];
        $this->banco = $value['COSTO_ENVIO'];
        $this->rut = $value['BANCO'];
        $this->nombreDeposito = $value['NOMBRE_DEPOSITO'];
        $this->correoDeposito = $value['CORREO_DEPOSITO'];


    }
    
}
}


?>

