<?php
require_once("../FPDF/fpdf.php");
include_once($_SERVER['DOCUMENT_ROOT'].'/TopuvaWeb/rutas.php');
require_once(BD . "catalogoBD.php");
require_once(COMPARTIDA . "parametros.php");
class Comprobante extends FPDF
{

// Cabecera de página
function Header()
{
    // Logo
    //$this->Image('logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',14);
    // Movernos a la derecha
    $this->Cell(1);
    // Título
    $this->SetTextColor(55,140,244);
    $this->Cell(1,1,'Emporio D&S',0,1);
    $this->Ln(4);
    $this->Cell(60);
    $this->SetTextColor(39,39,39);
    $this->Cell(1,1,'Comprobante de compra',0,1);
    $this->Ln(2);
    $this->Cell(1);
    $this->SetFont('Arial','B',11);
    $this->Cell(1,10,utf8_decode('Comercializadora de productos naturales, frutos secos, deshidratados,condimientos'));
    $this->Ln(4);
    $this->SetFont('Arial','',10);
    $this->Cell(1);
    $this->Cell(1,10,utf8_decode('Sitio: www.nuestro sitio.cl,Telefono/Whatsapp: +5699999999,Email: Prueba@gmail.com,Instagram: www.instagram.cl'));
    // Salto de línea
    $this->Ln(10);
}

}

class ComprobantePagoMail
{

    public function GeneraComprobantePago($idDespacho)
    {
        

    $nombre="";
    $totalProductos="";
    $totalVenta="";
    $tipoPago="";
    $tipoDespacho="";
    $oCatalogo= new catalogoBD();
    $Listafilas=$oCatalogo->obtieneCabeceraDespacho($idDespacho);
    foreach($Listafilas as $filas => $value)
    {
        $nombre = ' ' . $value['nombre'] . ' ' . $value['APELLIDOS'];
        $tipoDespacho=$value['descripcion_tipo_despacho'];
        $tipoPago= $value['descripcion_tipo_pago'];
        $totalVenta=$value['TOTAL_VENTA'];
    }
    $ListaDetalle=$oCatalogo->obtieneDetalleDespacho($idDespacho);
    
    $pdf = new Comprobante('P','mm','Letter');
    $pdf->AddPage();
    $pdf->SetFont('Arial','',10);
    $pdf->SetTextColor(39,39,39);
    $pdf->Cell(40,10,utf8_decode('Hola,' . $nombre));
    $pdf->Ln(4);
    $pdf->Cell(40,10,utf8_decode('Gracias por tu pedido. En estos momentos estamos procesando tu orden para ser entregada en los próximos días.'));
    $pdf->Ln(6);
    $pdf->SetTextColor(55,140,244);
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(40,10,utf8_decode('Datos Compra.'));
    $pdf->Line(10, 53 , 200, 53);
    $pdf->Ln(12);
    $pdf->SetTextColor(39,39,39);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(60,6,'Numero de despacho',0,0,'',false);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(60,6,$idDespacho,0,0,'',false);
    $pdf->Ln(4);
    $pdf->SetTextColor(39,39,39);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(60,6,'Forma de retiro',0,0,'',false);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(60,6, $tipoDespacho,0,0,'',false);
    $pdf->Ln(4);
    $pdf->SetTextColor(39,39,39);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(60,6,'Forma de pago',0,0,'',false);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(60,6,$tipoPago,0,0,'',false);
    $pdf->Ln(4);
    $pdf->SetTextColor(39,39,39);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(60,6,'Total pago (incluye despacho)',0,0,'',false);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(60,6,'$ ' . $totalVenta,0,0,'',false);
    
    $pdf->Ln(4);
    $pdf->SetTextColor(39,39,39);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(60,6,'Tiempo de entrega',0,0,'',false);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(60,6,utf8_decode(' Maximo 72 horas hábiles.'),0,0,'',false);
    $pdf->Ln(8);
    $pdf->SetTextColor(55,140,244);
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(40,10,utf8_decode('Notas.'));
    $pdf->SetTextColor(39,39,39);
    $pdf->SetFont('Arial','',10);
    $pdf->Ln(6);
    $pdf->Cell(40,10,utf8_decode('Por favor al momento de la entrega revisa los productos recibidos, si no estas conforme, puedes solicitar su cambio'));
    $pdf->Ln(3);
    $pdf->Cell(40,10,utf8_decode('o la devolución del dinero.'));
    $pdf->Ln(4);
    $pdf->Cell(40,10,utf8_decode('Puedes contactarnos con nosotros en los medios que disponemos para aquello.'));
    
    $pdf->Line(10, 110 , 200, 110);
    $pdf->SetTextColor(39,39,39);
    $pdf->SetFont('Arial','',10);
    $pdf->SetTextColor(55,140,244);
    $pdf->SetY(110);
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(40,10,utf8_decode('Detalle Compra.'));
    $pdf->SetY(120);
    $pdf->SetX(10);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(55,140,244);
    $pdf->SetDrawColor(25,25,12);
    $pdf->Cell(90,6,'Producto',0,0,'C',true);
    $pdf->Cell(60,6,'Cantidad',0,0,'C',true);
    $pdf->Cell(40,6,'Total',0,0,'C',true);
    $pdf->SetTextColor(39,39,39);
    
    foreach($ListaDetalle as $filas => $value)
    {
        $pdf->Ln();
        $pdf->SetX(10);
        $pdf->Cell(90,6,$value['nombre_producto'] . ' '.  $value['tamano']. ' ' . $value['descripcion_unidad'] ,1,0,'C',false);
        $pdf->Cell(60,6,$value['cantidad'],1,0,'C',false);
        $pdf->Cell(40,6,$value['venta'],1,0,'C',false);
    }
    
    return $pdf->Output('S','ComprobantePago'. $idDespacho .'.pdf',false);
    }

}



  


?>
