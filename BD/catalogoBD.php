<?php 
include("conexion.php");
include("respuesta.php");
class catalogoBD
{

 private $oRespuesta;

 public function __construct() {
  $this->oRespuesta = new RespuestaOtd();
  
}

    function ejecutarConsulta($sSql)
    {

      $oConexion = new Conexion();
      $oConexion->conectar();
      $lista= $oConexion->traerDatos($sSql);
      $oConexion->cerrar();
      return $lista;
    }

    function ejecutarConsultaIndividual($sSql)
    {

      $oConexion = new Conexion();
      $oConexion->conectar();
      $lista= $oConexion->traerDatosIndividuales($sSql);
      $oConexion->cerrar();
      return $lista;
    }
function obtieneCategorias()
{
  $sSql="select * from categorias";
  $lista= $this->ejecutarConsulta($sSql);
  return $lista;

}

function obtieneProductosDestacados()
{
  try{

    $sSql='select 
    u.codigo_unidad,
    u.descripcion_unidad,
    u.tamano as tamano_unidad,
    p.descripcion,
    vp.precio_venta,
    vp.imagen
from 
    unidades u, 
    productos p,
    venta_productos vp,
    categorias c
where     
    vp.ID_PRODUCTO =p.ID_PRODUCTO and 
    vp.id_unidad = u.id_unidad and
    p.id_categoria =  c.id_categoria and vp.destacado = 1
    order by VP.ID_PRODUCTO';
$lista= $this->ejecutarConsulta($sSql);
return $lista;
  }
  catch(Exception $e)
  {
    return NULL;
  }

}

function obtienePrecioProductos($sCategoria)
{

  try
  {
    $sSql ='select  u.codigo_unidad,
    u.descripcion_unidad,
    u.tamano as tamano_unidad,
    p.descripcion,
    vp.precio_venta
from 
    unidades u, 
    productos p,
    venta_productos vp,
    categorias c
where     
    vp.ID_PRODUCTO =p.ID_PRODUCTO and 
    vp.id_unidad = u.id_unidad and
    p.id_categoria =  c.id_categoria and c.id_categoria = "'.  $sCategoria  .'"
    order by VP.ID_PRODUCTO';


$lista= $this->ejecutarConsulta($sSql);
return $lista;

  }

  catch(Exception $e)
  {
    return NULL;
  }

}

function obtieneDisponibleProductos($sProducto)
{
  try
  {
    $sSql ='select 
    codigo_unidad , tamano
from 
    unidades u, 
    venta_productos vp,
    productos p
where 
    u.id_unidad = vp.id_unidad and
    p.id_producto = vp.id_producto and
    p.descripcion= "'.  $sProducto  .'" and  vp.stock > 0';
$lista= $this->ejecutarConsulta($sSql);
return $lista;


  }

  catch(Exception $e)
  {
    return NULL;
  }

}


function obtieneDatosDespacho($idDespacho)
{
  try
  {
$sSql ='select * from despacho where id_despacho= '. $idDespacho;
$lista= $this->ejecutarConsulta($sSql);
return $lista;


  }

  catch(Exception $e)
  {
    return NULL;
  }

}


function obtieneProductosRelacionados($sProducto)
{

  try{
    $sSql ='select  u.codigo_unidad,
    u.descripcion_unidad,
    u.tamano as tamano_unidad,
    p.descripcion,
    vp.precio_venta
    from unidades u, 
    productos p,
    venta_productos vp,
    categorias c
    where     
    vp.ID_PRODUCTO =p.ID_PRODUCTO and 
    vp.id_unidad = u.id_unidad and
    p.id_categoria =  c.id_categoria and p.descripcion="'.  $sProducto  .'"
    order by vp.ID_PRODUCTO';
    $lista= $this->ejecutarConsulta($sSql);
    return $lista;
  }
  catch(Exception $e)
  {
    return NULL;
  }

}

function InsertaDespacho($sNombre,$sApellidos,$sDireccion,$sDepartamento,$sCiudad,$sComuna,$sRegion,$sTelefono,$sEmail)
{

  try{

    $oConexion = new Conexion();
    $dmIdDespacho=0;
    $sSql = 'select count(id_despacho) as id from despacho';
    $ArraydmIdDespacho =$this->ejecutarConsultaIndividual($sSql);
    $dmIdDespacho= $ArraydmIdDespacho["id"];
    if($dmIdDespacho ==0)
    {

      $dmIdDespacho = 1;
    }
    else
    {
      $dmIdDespacho = $dmIdDespacho  + 1;
    }
    $sSql='';
    $sSql ='Insert into despacho (ID_DESPACHO,NOMBRE,APELLIDOS,DIRECCION,DEPARTAMENTO,COMUNA,CIUDAD,REGION,TELEFONO,EMAIL,ID_CLIENTE)
    VALUES(' . $dmIdDespacho . ',"'.$sNombre.'","'.$sApellidos .'","'.$sDireccion.'","'.$sDepartamento.'","'.$sComuna.'","'.$sCiudad.'","'.$sRegion.'","'.$sTelefono.'","'.$sEmail.'",1) ';
    
    $oConexion->conectar();
    $oConexion->execBool($sSql);
    $oConexion->cerrar();
   $this->oRespuesta ->bEsValido =true;
   $this->oRespuesta ->idDespacho =$dmIdDespacho;
   $this->oRespuesta ->sDireccion =$sDireccion;
   $this->oRespuesta ->sDepartamento =$sDepartamento;
   $this->oRespuesta ->sComuna =$sComuna;
   $this->oRespuesta ->sCiudad =$sCiudad;
   $this->oRespuesta ->sRegion =$sRegion;
   $this->oRespuesta ->sTelefono =$sTelefono;
   $this->oRespuesta ->sMensaje ="Datos para el despacho ingresados correctamente.";
    return $this->oRespuesta;
  }
  catch(Exception $e)
  {
    //Aca vamos a incorporar el error al archivo de log.
    $this->oRespuesta ->bEsValido =false;
    


  }

}

function ActualizaDespacho($sNombre,$sApellidos,$sDireccion,$sDepartamento,$sCiudad,$sComuna,$sRegion,$sTelefono,$sEmail,$idDespacho)
{

  try{

    $oConexion = new Conexion();
    $sSql='';
    $sSql ='update despacho set NOMBRE =  "'.$sNombre. '", APELLIDOS = "'.$sApellidos .'",DIRECCION = "' .  $sDireccion.'",
           COMUNA ="' .  $sComuna.'", CIUDAD ="'.$sCiudad.'",REGION ="'.$sRegion.'",DEPARTAMENTO = "'.$sDepartamento.'",
           TELEFONO="'.$sTelefono.'",EMAIL="'.$sEmail.'"
           WHERE ID_DESPACHO = ' . $idDespacho . '';
    
    
    $oConexion->conectar();
    $oConexion->execBool($sSql);
    $oConexion->cerrar();
  $this->oRespuesta ->bEsValido =true;
   $this->oRespuesta ->idDespacho =$idDespacho;
   $this->oRespuesta ->sDireccion =$sDireccion;
   $this->oRespuesta ->sDepartamento =$sDepartamento;
   $this->oRespuesta ->sComuna =$sComuna;
   $this->oRespuesta ->sCiudad =$sCiudad;
   $this->oRespuesta ->sRegion =$sRegion;
   $this->oRespuesta ->sTelefono =$sTelefono;
   $this->oRespuesta ->bEsValido =true;
   $this->oRespuesta ->sMensaje ="Actualización de datos para despacho correcta.";
    return $this->oRespuesta;
  }
  catch(Exception $e)
  {
    //Aca vamos a incorporar el error al archivo de log.
    $this->oRespuesta ->bEsValido =false;
    


  }




}

function eliminaDespacho($idDespacho)
{
  try{
    $oConexion = new Conexion();
    $sSql='';
    $sSql = 'delete from despacho where id_despacho =' . $idDespacho;
    $oConexion->conectar();
    $oConexion->execBool($sSql);
    $oConexion->cerrar();
    $this->oRespuesta ->bEsValido =true;
    $this->oRespuesta ->sMensaje ="Información de despacho eliminada correctamente.";
    return $this->oRespuesta;

  }
  catch(Exception $e)
  {
    //Aca vamos a incorporar el error al archivo de log.
    $this->oRespuesta ->bEsValido =false;
   


  }


}



}






?>