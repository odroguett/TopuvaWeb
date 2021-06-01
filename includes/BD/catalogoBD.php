<?php 
include("includes/BD/conexion.php");
class catalogoBD
{
    function ejecutarConsulta($sSql)
    {

      $oConexion = new Conexion();
      $oConexion->conectar();
      $lista= $oConexion->traerDatos($sSql);
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
  $sSql="SELECT * FROM PRODUCTOS WHERE DESTACADO=1";
  $lista= $this->ejecutarConsulta($sSql);
  return $lista;

}

function obtienePrecioProductos($sCategoria)
{
  $sSql='select  
           u.codigo_unidad,
           u.descripcion_unidad,
           u.tamano_unidad,
           p.DESCRIPCION,
           pp.precio_venta
        from unidades_productos up, 
           unidades u,
           productos p,
           precio_producto pp,
           categorias c	
        where 
           up.ID_PRODUCTO =p.ID_PRODUCTO and 
           up.id_unidad = u.id_unidad and
           up.id_producto_unidad = pp.id_producto_unidad and
           p.id_categoria =  c.id_categoria and c.id_categoria = '. $sCategoria .'
           ORDER BY up.ID_PRODUCTO_UNIDAD;'; 
  $lista= $this->ejecutarConsulta($sSql);
  return $lista;

}



}






?>