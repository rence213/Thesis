<?php
	require_once('../support/support.php');
	require_once('../classes/PHPExcel.php');
	if(isset($_POST['query'])){
		$sheet = new PHPExcel();
		$activeSheet = $sheet->getActiveSheet();
		$filename = $_POST['data'].date("Y/m/d");

		$query = $_POST['query'];


		$result = $connection -> myQuery($query);
		$row = 2;
		while($row_data =  $result->fetch(PDO::FETCH_ASSOC)) {
		    $col = 0;
		    foreach($row_data as $key=>$value) {
		        $activeSheet->setCellValueByColumnAndRow($col, $row, $value);
		        $col++;
	   		 }
   		 	$row++;
		}

	$objWriter = PHPExcel_IOFactory::createWriter($sheet, 'Excel2007');
	header('Content-Type: application/vnd.ms-excel');
	header("Content-Disposition: attachment;filename='$filename.xlsx'");
	header('Cache-Control: max-age=0');
	ob_end_clean();
	$objWriter->save('php://output');
	}


	
?>