<?php
include_once ('../vendor/autoload.php');

$obj= new \App\Form\Form();
$recordSet=$obj->show();

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
    die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once('../vendor/phpoffice/phpexcel/Classes/PHPExcel.php');


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
    ->setLastModifiedBy("Maarten Balliauw")
    ->setTitle("Office 2007 XLSX Test Document")
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Test result file");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'SL')
    ->setCellValue('B1', 'ID')
    ->setCellValue('C1', 'Name')
    ->setCellValue('D1', 'Photo')
    ->setCellValue('E1', 'Gender')
    ->setCellValue('F1', 'Birthday')
    ->setCellValue('G1', 'City')
    ->setCellValue('H1', 'Hobbies')
    ->setCellValue('I1', 'Summary')
    ->setCellValue('J1', 'E-mail');

$sl=0;
$counter=1;
foreach($recordSet as $row) {
    $sl++;
    $counter++;

// Miscellaneous glyphs, UTF-8
    $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet() ->setCellValue('A' . $counter, $sl);
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $counter, $row->id);
        $objPHPExcel->getActiveSheet() ->setCellValue('C' . $counter, $row->name);
        $objPHPExcel->getActiveSheet() ->setCellValue('E' . $counter, $row->gender);
        $objPHPExcel->getActiveSheet() ->setCellValue('F' . $counter, $row->birthday);
        $objPHPExcel->getActiveSheet() ->setCellValue('G' . $counter, $row->city);
        $objPHPExcel->getActiveSheet() ->setCellValue('H' . $counter, $row->hobbies);
        $objPHPExcel->getActiveSheet() ->setCellValue('I' . $counter, $row->summary);
        $objPHPExcel->getActiveSheet() ->setCellValue('J' . $counter, $row->email);
        $objPHPExcel-> getActiveSheet()->getRowDimension($counter)->setRowHeight(80);



    $gdImage = imagecreatefromjpeg('UploadedImages/'.$row->picture);
// Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
    $objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
    $objDrawing->setName('Sample image');
    $objDrawing->setDescription('Sample image');
    $objDrawing->setImageResource($gdImage);
    $objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
    $objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
    $objDrawing->setHeight(90);
    $objDrawing->setWidth(90);
    $objDrawing->setCoordinates('D'.$counter);
    $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());


// Rename worksheet
    $objPHPExcel->getActiveSheet()->setTitle('Picture');

}
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Profile Picture.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//$objWriter=save('PP.xlsx');
ob_end_clean();// For clear output buffering
$objWriter->save('php://output');

exit;

