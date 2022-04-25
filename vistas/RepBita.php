<?php
include 'conexión.php';//conexion ala BD
$inicio= $_POST['inicio'];
$fin= $_POST['fin'];

require('fpdf/fpdf.php');// llamado a la librearia
$consulta_tablas="SELECT b.CodigoBitacora, u.Usuario, o.Descripcion, b.Fecha, b.Accion, b.Descripcion
from tbl_bitacora as b
join tbl_usuario as u on u.CodigoUsuario = b.CodigoUsuario
join tbl_objetos as o on  o.CodigoObjeto = b.CodigoBitacora  where Fecha BETWEEN '$inicio' AND '$fin' ;";                            
$resultado = $conn->query($consulta_tablas);


$fpdf =new FPDF('P','mm', 'letter', true);
$fpdf-> addpage('PORTRAINT','letter');//tamano de la pagina

class pdf extends FPDF{//encabezado
    public function header()
    {
        $this->setfont('Arial','B',14);
        $this->cell(0,5, 'Minutas Valle de Ángeles',0,0,'C');
        $this->image('dist/img/minuta.png',275,5,20,20,'png');

    }

    public function footer()//pie de pagina
    {
        
        $this->setx(-30);
        $this->AliasNbPages('tpagina');
        $this->write(310, $this->PageNo().'/tpagina');//pone numero de pagina 
    
    
        
    }

}
$fpdf= new pdf('P','mm', 'letter', true);
$fpdf->addpage('portrait',array(300,380));
$fpdf->setfont('Arial','B',12);
$fpdf->setY(20);

$fpdf->cell(0,5,utf8_decode('Reporte de Bitacora.'),0,0,'C');//titulo  del reporte
$fpdf->setdrawcolor(250,193,20);
$fpdf->setlinewidth(1);
$fpdf->line(60,$fpdf->gety()+10,250,$fpdf->gety()+10 );
$fpdf->ln(20);
$fpdf->setfont('Arial','',11);
$fpdf->cell(20,5,'Fecha:');
$fpdf->Cell(20,5,date('d/m/Y '),0,11,'L');//fecha del reporte automatica

//encabezado de la tabla
$fpdf->ln(20);
$fpdf->setfontsize(10);
$fpdf->setfont('Arial','B');
$fpdf->setfillcolor(51, 218, 255);//color de fondo
$fpdf->settextcolor(0, 0, 0 );//color texto
$fpdf->setdrawcolor(51, 218, 255);//color lineas
$fpdf->cell(15,10,'N°',1,0,'C',1);
$fpdf->cell(30,10,'Usuario',1,0,'C',1);
$fpdf->cell(110,10,'Objeto',1,0,'C',1);
$fpdf->cell(35,10,'Fecha',1,0,'C',1);
$fpdf->cell(30,10,'Acción',1,0,'C',1);
$fpdf->cell(58,10,'Descripción',1,0,'C',1);
$fpdf->ln();
//tabla
$fpdf->setfillcolor(255, 255, 255 );//color de fondo
$fpdf->settextcolor(0, 0, 0 );//color texto
$fpdf->setdrawcolor(51, 218, 255);//color lineas

while($row = $resultado->fetch_assoc()){
    $fpdf->cell(15,20,$row['CodigoBitacora'],1,0,'C',1);
    $fpdf->cell(30,20,$row['Usuario'],1,0,'C',1);
    $fpdf->cell(110,20,$row['Descripcion'],1,0,'C',1);
    $fpdf->cell(35,20,$row['Fecha'],1,0,'C',1);
    $fpdf->cell(30,20,$row['Accion'],1,0,'C',1);
    $fpdf->Multicell(58,10,$row['Descripcion'],1,'C',1);
 
}

$fpdf->output('','Reporte_Bitacora.pdf');///nombre del archivo