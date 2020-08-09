<?php
	
//include_once("db.php");

class ExportToExcel
{
	function exportData($data)
	{
		// echo "<pre>";
		// print_r($deliveryDataArray);
		// echo "</pre>";
		// die('Library');
		
		// file name for download
		$filename = "reveneu_report_" . date('Ymd') . ".xls";

		header("Content-Disposition: attachment; filename=\"$filename\"");
		header('Content-Description: File Transfer');
		header("Content-Type: application/vnd.ms-excel");
		header('Content-Transfer-Encoding: binary');
		header('Pragma: public');

		$flag = false;
		foreach($data as $row)
		{
			if(!$flag) 
			{
				// display field/column names as first row
				echo implode("\t", array_keys($row)) . "\n";
				$flag = true;
			}
			//array_walk($row, __NAMESPACE__ . '\cleanData');
			echo implode("\t", array_values($row)) . "\n";
		}
		
		exit;
	}
	
}
	
?>
