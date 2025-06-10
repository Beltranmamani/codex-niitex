<?php
/**
 * Establecer la conexion a la base de datos
 */

// $cn = $this->conexion;
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('America/Lima');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Incluir PHPExcel */
require_once 'view/assets/plugins/excel/PHPExcel.php';


// Crear nuevo object PHPExcel 
// echo date('d-m-Y H:i:s') , " Creando nuevo Objeto de PHPExcel" , EOL;
$objPHPExcel = new PHPExcel();

// Establecer Propiedades al document
// echo date('d-m-Y H:i:s') , " Estableciendo Propiedades al documento" , EOL;

$objPHPExcel->getProperties()
    ->setCreator("Jhony Creativo")
	->setLastModifiedBy("Jhony Creativo")
	->setTitle("Plantilla para agregar productos")
	->setSubject("Plantilla para agregar productos")
	->setDescription("Este Documento esta especializado para la importacion de productos")
	->setKeywords("Jhony Creativo | Plantilla | Excel")
	->setCategory("ImportacionProductos");

// Establecer la hoja activa y darle nombre
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle("Productos");

// Darle Estilos a las columnas
$estiloTituloColumnas = array(
	'font' => array(
		'name'  => 'Arial',
		'bold'  => true,
		'size' =>10,
		'color' => array(
		'rgb' => 'FFFFFF'
		)
	),
	'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		'color' => array('rgb' => '538DD5')
		),
		'borders' => array(
		'allborders' => array(
		'style' => PHPExcel_Style_Border::BORDER_THIN
		)
	),
	'alignment' =>  array(
		'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
	)
);
$Estiloceldas = array(
	'font' => array(
		'name'  => 'Arial',
		'bold'  => true,
		'size' =>10,
		'color' => array(
		'rgb' => '000000'
		)
	),
	'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		'color' => array('rgb' => 'FFFFFF')
		),
		'borders' => array(
		'allborders' => array(
		'style' => PHPExcel_Style_Border::BORDER_THIN
		)
	),
	'alignment' =>  array(
		'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
	)
);
// Establecer los estilos a la columna
$objPHPExcel->getActiveSheet()->getStyle('A1:AC1')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->getStyle('A2:AC201')->applyFromArray($Estiloceldas);
// echo date('d-m-Y H:i:s') , "Formateando y dando estilos al documento" , EOL;
// Establecer los tamaños a las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);

$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(20);

$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(20);

// Darle Datos a las celdas
$objPHPExcel->getActiveSheet()->setCellValue('A1', utf8_encode('CODIGO_BARRA'));
$objPHPExcel->getActiveSheet()->setCellValue('B1', utf8_encode('PRODUCTO'));
$objPHPExcel->getActiveSheet()->setCellValue('C1', utf8_encode('PRESENTACION'));
$objPHPExcel->getActiveSheet()->setCellValue('D1', utf8_encode('LINEA'));
$objPHPExcel->getActiveSheet()->setCellValue('E1', utf8_encode('UNIDAD_MEDIDA'));
$objPHPExcel->getActiveSheet()->setCellValue('F1', utf8_encode('COMPLEMENTO'));
$objPHPExcel->getActiveSheet()->setCellValue('G1', utf8_encode('PRECIO_COSTO'));
$objPHPExcel->getActiveSheet()->setCellValue('H1', utf8_encode('PRECIO_VENTA_1'));
$objPHPExcel->getActiveSheet()->setCellValue('I1', utf8_encode('PRECIO_VENTA_2'));
$objPHPExcel->getActiveSheet()->setCellValue('J1', utf8_encode('PRECIO_VENTA_3'));
$objPHPExcel->getActiveSheet()->setCellValue('K1', utf8_encode('PRECIO_VENTA_4'));
$objPHPExcel->getActiveSheet()->setCellValue('L1', utf8_encode('STOCK_MINIMO'));
$objPHPExcel->getActiveSheet()->setCellValue('M1', utf8_encode('STOCK_MEDIO'));
$objPHPExcel->getActiveSheet()->setCellValue('N1', utf8_encode('STOCK_MODERADO'));
$objPHPExcel->getActiveSheet()->setCellValue('O1', utf8_encode('PERECEDERO'));
$objPHPExcel->getActiveSheet()->setCellValue('P1', utf8_encode('EXENTO'));

$objPHPExcel->getActiveSheet()->setCellValue('Q1', utf8_encode('STOCK_1'));
$objPHPExcel->getActiveSheet()->setCellValue('W1', utf8_encode('STOCK_2'));
$objPHPExcel->getActiveSheet()->setCellValue('X1', utf8_encode('STOCK_3'));
$objPHPExcel->getActiveSheet()->setCellValue('Y1', utf8_encode('STOCK_4'));

$objPHPExcel->getActiveSheet()->setCellValue('Z1', utf8_encode('MEDIDA_1'));
$objPHPExcel->getActiveSheet()->setCellValue('AA1', utf8_encode('MEDIDA_2'));
$objPHPExcel->getActiveSheet()->setCellValue('AB1', utf8_encode('MEDIDA_3'));
$objPHPExcel->getActiveSheet()->setCellValue('AC1', utf8_encode('MEDIDA_4'));

// LLenar los datos de las unidades de medida disponibles
$U_fila_inicio=2;
$fila_inicio_presentacion=2;
$U_fila_fin = 0;
$presentaciones = $this->presentaciones;
// echo date('d-m-Y H:i:s') , " Estableciendo las presentaciones disponibles" , EOL;
foreach($presentaciones as $row){
	$objPHPExcel->getActiveSheet()->setCellValue('R' . $fila_inicio_presentacion, utf8_encode($row['NOMBRE']));
	$U_fila_fin = $fila_inicio_presentacion;
	$fila_inicio_presentacion++;
}
// Ocultar datos 
$objPHPExcel->getActiveSheet()
    ->getColumnDimension('R')
	->setVisible(false);
	
// Establecer el rango de Unidades 
$objPHPExcel->addNamedRange(
    new PHPExcel_NamedRange(
        'Presentaciones', 
        $objPHPExcel->getActiveSheet(),"R$U_fila_inicio:R$U_fila_fin"
    )
);
// LLenar los datos de las Marcas disponibles
// echo date('d-m-Y H:i:s') , " Estableciendo las marcas disponibles" , EOL;
$M_fila_inicio=2;
$fila_inicio_marcas=2;
$M_fila_fin = 0;
$marcas = $this->lineas;
// // Recorrer la consulta de marcas
foreach($marcas as $row){
	$objPHPExcel->getActiveSheet()->setCellValue('S' . $fila_inicio_marcas, utf8_encode($row['LINEA']));
	$M_fila_fin = $fila_inicio_marcas;
	$fila_inicio_marcas++;
}
// Ocultar datos 
$objPHPExcel->getActiveSheet()
    ->getColumnDimension('S')
	->setVisible(false);

// Establecer el rango de Marcas
$objPHPExcel->addNamedRange(
    new PHPExcel_NamedRange(
        'Lineas', 
        $objPHPExcel->getActiveSheet(),"S$M_fila_inicio:S$M_fila_fin"
    )
);
// echo date('d-m-Y H:i:s') , " Estableciendo las categorias disponibles" , EOL;
// LLenar los datos de las Categorias disponibles
$C_fila_inicio=2;
$fila_inicio_categorias=2;
$C_fila_fin = 0;
$unidades = $this->unidades;
foreach($unidades as $row){
	$objPHPExcel->getActiveSheet()->setCellValue('T' . $fila_inicio_categorias, utf8_encode("{$row['UNIDAD']} - {$row['PREFIJO']}"));
	$C_fila_fin = $fila_inicio_categorias;
	$fila_inicio_categorias++;
}
// echo date('d-m-Y H:i:s') , " Estableciendo las unidades disponibles" , EOL;

// Ocultar datos 
$objPHPExcel->getActiveSheet()
    ->getColumnDimension('T')
	->setVisible(false);
// Establecer el rango de Unidades
$objPHPExcel->addNamedRange(
    new PHPExcel_NamedRange(
        'Unidades', 
        $objPHPExcel->getActiveSheet(),"T$C_fila_inicio:T$C_fila_fin"
    )
);
$objPHPExcel->getActiveSheet()->setCellValue('U2', utf8_encode("PERECEDERO"));
$objPHPExcel->getActiveSheet()->setCellValue('U3', utf8_encode("NO PERECEDERO"));
$objPHPExcel->getActiveSheet()->setCellValue('V2', utf8_encode("EXENTO"));
$objPHPExcel->getActiveSheet()->setCellValue('V3', utf8_encode("NO EXENTO"));
$objPHPExcel->getActiveSheet()
    ->getColumnDimension('U')
	->setVisible(false);
$objPHPExcel->getActiveSheet()
    ->getColumnDimension('V')
	->setVisible(false);

$objPHPExcel->addNamedRange(
    new PHPExcel_NamedRange(
        'Perecederos', 
        $objPHPExcel->getActiveSheet(),"U2:U3"
    )
);
$objPHPExcel->addNamedRange(
    new PHPExcel_NamedRange(
        'Exentos', 
        $objPHPExcel->getActiveSheet(),"V2:V3"
    )
);
$CeldaInicio = 2;
$CeldaFin = 201;
for($i = 2 ; $CeldaInicio<=$CeldaFin ;$i++){
	// Dropdows presentacion
	$objValidation = $objPHPExcel->getActiveSheet()
		->getCell("C$i")
		->getDataValidation();
	$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST )
		->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
		->setAllowBlank(false)
		->setShowInputMessage(true)
		->setShowErrorMessage(true)
		->setShowDropDown(true)
		->setErrorTitle('Presentacion no econtrada')
		->setError('Esa Presentacion no esta en la lista.')
		->setPromptTitle('Seleccione la Presentacion')
		->setPrompt('Porfavor seleccione la presentacion.')
		->setFormula1('=Presentaciones');
	// // Dropdows Lineas
	$objValidation = $objPHPExcel->getActiveSheet()
		->getCell("D$i")
		->getDataValidation();
	$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST )
		->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
		->setAllowBlank(false)
		->setShowInputMessage(true)
		->setShowErrorMessage(true)
		->setShowDropDown(true)
		->setErrorTitle('Linea no econtrada')
		->setError('Esa linea no esta en la lista')
		->setPromptTitle('Seleccione la linea')
		->setPrompt('Porfavor Seleccione la linea de su producto')
		->setFormula1('=Lineas');
	// Dropdows Unidades
	$objValidation = $objPHPExcel->getActiveSheet()
		->getCell("E$i")
		->getDataValidation();
	$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST )
		->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
		->setAllowBlank(false)
		->setShowInputMessage(true)
		->setShowErrorMessage(true)
		->setShowDropDown(true)
		->setErrorTitle('Unidades de medida no econtrada')
		->setError('Esa unidad no esta en la lista')
		->setPromptTitle('Seleccione la unidad')
		->setPrompt('Porfavor Seleccione la unidad de medida de su producto')
		->setFormula1('=Unidades');
	$objValidation = $objPHPExcel->getActiveSheet()
		->getCell("O$i")
		->getDataValidation();
	$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST )
		->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
		->setAllowBlank(false)
		->setShowInputMessage(true)
		->setShowErrorMessage(true)
		->setShowDropDown(true)
		->setErrorTitle("Perecedero")
		->setError('Esa opcion no esta en la lista')
		->setPromptTitle('Seleccione una opcion')
		->setPrompt('Porfavor Seleccione una opcion ')
		->setFormula1('=Perecederos');
	$objValidation = $objPHPExcel->getActiveSheet()
		->getCell("P$i")
		->getDataValidation();
	$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST )
		->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
		->setAllowBlank(false)
		->setShowInputMessage(true)
		->setShowErrorMessage(true)
		->setShowDropDown(true)
		->setErrorTitle("Exento")
		->setError('Esa opcion no esta en la lista')
		->setPromptTitle('Seleccione una opcion')
		->setPrompt('Porfavor Seleccione una opcion ')
		->setFormula1('=Exentos');
	$CeldaInicio++;

}

// Activar la Primera Pagina
$objPHPExcel->setActiveSheetIndex(0);
// Save Excel 2007 file
// This linked validation list method only seems to work for Excel2007, not for Excel5
// Redirect output to a client’s web browser (Excel2007)
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
if (ob_get_contents()) ob_end_clean();

header('Content-Type: application/vnd.ms-exel');
header('Content-Disposition: attachment;filename="PlantillaProducto.xlsx"');

$objWriter->save('php://output');
exit;