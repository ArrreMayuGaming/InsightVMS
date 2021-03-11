<?php

//export.php



$todays-contact = new vms();

$file_name = md5(rand()) . '.csv';
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Type: application/csv;");
$file = fopen("php://output", "w");
$header = array("User ID", "User Name", "User Email", "User Mobile No.", "User Address", "Meet Person Department");
fputcsv($file, $header);


$result = $visitor->get_result();

foreach($result as $row)
{
	$data = array();
	$data[] = $row["id"];
	$data[] = $row["FullName"];
	$data[] = $row["PhoneNumber"];
	$data[] = $row["EmailId"];
	$data[] = $row["Subject"];
	$data[] = $row["Message"];
	fputcsv($file, $data);
}
fclose($file);
exit;

?>