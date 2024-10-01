<?php
include '../_connections/_database_connection.php';
session_start();
require('viewer/fpdf.php');
if(isset($_POST['print_pdf'])){
class PDF extends FPDF
{
// Page header
	function Header()
	{
		
	$payment_status = $_POST['payment_status'];
	$date_pdf_1 = $_POST['date_pdf_1'];
	$date_pdf_2 = $_POST['date_pdf_2'];
include '../_connections/_database_connection.php';

	$converted_date_1 = date('F d, Y', strtotime(''.$date_pdf_1.''));
	$converted_date_2 = date('F d, Y', strtotime(''.$date_pdf_2.''));
		// Logo
		$this->SetFont('Arial','B',19);
		$this->Image('Capture.JPG',74,1,180);
		$this->Ln(29);
		$this->Cell(11);
		$this->Cell(321,10, 'TOTAL SALES REPORT',0,1,'C');
		$this->Cell(11);
		//$this->Cell(321,10, ''.$converted_date_1.' to '.$converted_date_2.'',0,1,'C');
		$this->Ln(8);
		
		$this->SetX(21);
		$this->SetFont('Arial','B',13);
		$this->Cell(44,10,'NAME',1,0,'C');
		$this->Cell(44,10,'BRAND',1,0,'C');
		$this->Cell(44,10,'CODE',1,0,'C');
		$this->Cell(44,10,'STATUS',1,0,'C');
		$this->Cell(44,10,'PRICE',1,0,'C');
		$this->Cell(44,10,'TOTAL PRICE',1,0,'C');
		$this->Cell(44,10,'DATE',1,0,'C');
		$this->SetFont('Arial','',12);
		$this->Ln(10);
		// WHERE date_purchased BETWEEN '$date_pdf_1' AND '$date_pdf_2' payment_status = 'PAID' && 
$message=mysqli_query($conn, "SELECT * FROM cart WHERE payment_status = '$payment_status' && date BETWEEN '$converted_date_1' AND '$converted_date_2'");
$num=1;
while($row=mysqli_fetch_array($message))
{
	
	$price_converted = number_format(($row['price'] / 1), 2, '.', ',');
	$this->SetX(21);
	$this->Cell(44,10,''.$row['product_name'].'',1,0,'C');
	$this->Cell(44,10,''.$row['product_brand'].'',1,0,'C');
	$this->Cell(44,10,''.$row['product_code'].'',1,0,'C');
	$this->Cell(44,10,''.$row['payment_status'].'',1,0,'C');
	$this->Cell(44,10,'PHP'.$price_converted.'',1,0,'C');
	$this->Cell(44,10,'PHP'.$price_converted.'',1,0,'C');
	$this->Cell(44,10,''.$row['date'].'',1,0,'C');
	$this->Ln(10);
$num++;
}

$total_sales = mysqli_query($conn, "SELECT SUM(price) AS total_price FROM cart WHERE payment_status = '$payment_status' && date BETWEEN '$converted_date_1' AND '$converted_date_2'");
$total_sales_show = mysqli_fetch_assoc($total_sales); 
$total_price = $total_sales_show['total_price'];
$converted = number_format(($total_price / 1), 2, '.', ',');
		$this->SetX(197);
		$this->SetFont('Arial','B',13);
		$this->Cell(44,10,'TOTAL PRICE',1,0,'C');
		$this->Cell(44,10,'PHP'.$converted.'',1,0,'C');
	}

// Page footer
	function Footer()
	{
	    // Position at 1.5 cm from bottom
	    // Arial italic 8
	    //$this->SetFont('Arial','I',8);
	    // Page number $this->Cell(654,10,''.$this->PageNo().' / {nb}',0,0,'C');

	    $this->SetFont('Arial','',10);
		$this->Image('footer.png',0,325,218);


	}






}//end of class
}
// Instanciation of inherited class
$pdf = new PDF();
$pdf->AddPage("L","legal","H");
$pdf->AliasNbPages();


$pdf->SetTextColor(0,0,0);//Set to Black color

$pdf->Output();
