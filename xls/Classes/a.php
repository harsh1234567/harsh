<?php
include 'PHPExcel/IOFactory.php';

//$inputFileName = '../t.xlsx';

//  Read your Excel workbook
/* try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
} catch(Exception $e) {
    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}

//  Get worksheet dimensions
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();

//  Loop through each row of the worksheet in turn
for ($row = 1; $row <= $highestRow; $row++){ 
    //  Read a row of data into an array
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                    NULL,
                                    TRUE,
                                    FALSE);
					
									
    //  Insert row data array into your database of choice here
}
 */
 
 $html="<table border='1'>";
 $objphpexcel=PHPExcel_IOFactory::load('../t.xlsx');
 foreach($objphpexcel->getWorksheetIterator() as $w)
 {
	 $hig_row=$w->getHighestRow();
	 for($rows=2;$rows<=$hig_row;$rows++)
	 {
		 $html.="<tr>";
		 $name=$w->getCellByColumnAndRow(0,$rows)->getValue();
		 $email=$w->getCellByColumnAndRow(1,$rows)->getValue();
		  $email1=$w->getCellByColumnAndRow(2,$rows)->getValue();
		 
		 $html.='<td>'.$name.'</td>';
		 $html.='<td>'.$email.'</td>';
		 
		 $html.='<td>'.$email1.'</td>';
		 $html.="</tr>";
		 
	 }
	 
 }
 $html.='</table>';
 echo $html;
 echo $hig_row;
 
?>