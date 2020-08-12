<?php
	
//include_once("db.php");
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Export_excel
{
	public function exportData($data)
	{
		$filename = "finance_report_" . date('Ymd') . ".xls";

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
				echo implode("\t", array_keys($row)) . "\n";
				$flag = true;
			}
			echo implode("\t", array_values($row)) . "\n";
		}
		exit;
	}
}
?>
