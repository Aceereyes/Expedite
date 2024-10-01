<?php
include '../_connections/_database_connection.php';
session_start();
require('viewer/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
	$today = date(' F d, Y - h:m:A');
    
    $this->Cell(150);
    $this->SetFont('Arial','B',18);
	$this->Image('header.png',0,1,220);
    $this->Cell(30,10,'',0,1,'C');

if(isset($_POST['find_report'])){
$file_description = $_POST['file_description'];	
$date_froms = $_POST['date_from'];	
$date_tos = $_POST['date_to'];	

$date_from = date('F d, Y', strtotime(''.$_POST['date_from'].''));
$date_to = date('F d, Y', strtotime(''.$_POST['date_to'].''));
$total_report = 'Total File Usage As of '.$date_from.' to '.$date_to.'';
    $this->Ln(23);
    $this->SetFont('Arial','B',14);
	$this->Cell(7);
    $this->Cell(182,8,''.$total_report.'',0,0,'C');
    $this->Ln(15);
}	
    $this->Cell(7,10,'',0,0,'C');
    $this->SetFont('Arial','B',12);
    $this->Cell(106,10,'FILE NAME',1,0,'C');
    $this->Cell(38,10,'DOWNLOAD',1,0,'C');
    $this->Cell(38,10,'RECEIVED',1,1,'C');
    $this->SetFont('Arial','',11);



    
    
}

// Page footer
	function Footer()
	{
	    // Position at 1.5 cm from bottom
	    $this->SetY(-9);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Page number
	    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',1,1,'L');
		$this->Image('footer.png',0,250,218);
	}

	



}//end of class

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AddPage("P","Letter");
$pdf->AliasNbPages();
$pdf->SetAutoPageBreak('auto',"50");

if(isset($_POST['find_report'])){
$file_description = $_POST['file_description'];	
$date_froms = $_POST['date_from'];	
$date_tos = $_POST['date_to'];
$select = mysql_query("SELECT * FROM file_uploads");
while($view_select = mysql_fetch_array($select))
{
$file_description = ''.$view_select['description'].'';

$string_cut = substr($file_description,0,53);

$count_form_downloads = mysql_query("SELECT count(*) AS file_downloads FROM file_downloads WHERE file_description = '$file_description' && date_download between '$date_froms' and '$date_tos'");
$count_form_downloads_show=mysql_fetch_array($count_form_downloads);
$total_forms = $count_form_downloads_show['file_downloads'];

$count_form_sent = mysql_query("SELECT count(*) AS file_sent FROM sent_file WHERE description = '$file_description' && date_sent between '$date_froms' and '$date_tos'");
$count_form_sent_show=mysql_fetch_array($count_form_sent);
$total_forms_sent = $count_form_sent_show['file_sent']; 

$pdf->setX(17);
$pdf->Cell(106,8,''.$string_cut.'',1,0);
$pdf->Cell(38,8,''.$total_forms.'',1,0,'C');
$pdf->Cell(38,8,''.$total_forms_sent.'',1,1,'C');
}
for($i=0;$i<20;$i++){//d2 mag while sa pag show ng data
}
}



$pdf->Output();


?>