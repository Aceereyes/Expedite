
<?php

include "connection.php";

$pID=$_SESSION['pID'];



require('viewer/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    include "connection.php";
    $pID=$_SESSION['pID'];
    $showfacinfo=mysqli_query($con,"SELECT * FROM accounts WHERE ID =$pID ");
    $sfi=mysqli_fetch_array($showfacinfo);
    // Logo

    // Arial bold 15
    $this->SetFont('Arial','B',18);
    // Move to the right

    // Title

    $this->Cell(0,20,'Lyceum of the Philippines University - Cavite',0,1,'R');
    $this->SetFont('Arial','',15);
    $this->Cell(50,7,'Professor Name',0,0,'L');
    $this->Cell(20,7,$sfi['fname']." ".$sfi['lname'],0,0,'L');
    $this->Cell(0,7,'Student Attendance Report',0,1,'R');
    $this->Cell(20,7,'',0,1,'L');
    $this->Cell(50,7,'Date Issued',0,0,'L');
    $this->Cell(50,7,date("M d Y - h:i A"),0,1,'L');
    $this->ln(8);
    $this->SetFont('Arial','',12);
    $this->Cell(10,7,'#',1,0,'C');
    $this->Cell(70,7,'Date & Time In',1,0,'C');
    $this->Cell(70,7,'Remarks',1,0,'C');

    //check late
    $late=mysqli_query($con,"SELECT COUNT(ID) as cntlate FROM prof_records WHERE precRemarks = 'Late' AND precID = '$pID' ");
    $la=mysqli_fetch_array($late);

    $absent=mysqli_query($con,"SELECT COUNT(ID) as cntabsent FROM prof_records WHERE precRemarks = 'Absent' AND precID = '$pID' ");
    $ab=mysqli_fetch_array($absent);

    $leave=mysqli_query($con,"SELECT COUNT(ID) as cntleave FROM prof_records WHERE precRemarks LIKE '%Leave' AND precID = '$pID' ");
    $le=mysqli_fetch_array($leave);

    $this->Cell(50,7,'Total Late = '.$la['cntlate'],1,0,'C');
    $this->Cell(50,7,'Total Absent = '.$ab['cntabsent'],1,0,'C');
    $this->Cell(50,7,'Total Leave = '.$le['cntleave'],1,1,'C');








}

// Page footer
	function Footer()
	{
	    // Position at 1.5 cm from bottom
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Page number
	    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');


	}





}//end of class

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AddPage("L","Legal");

$showallrec=mysqli_query($con,"SELECT * FROM prof_records WHERE precID ='$pID' ORDER BY ID DESC");
$num=1;
while($sar=mysqli_fetch_array($showallrec)){

$pdf->Cell(10,7,$num,1,0,'C');
    $pdf->Cell(70,7,$sar['precDate']." | ".$sar['precTimeIn'],1,0,'C');
    $pdf->Cell(70,7,$sar['precRemarks'],1,1,'C');
$num++;
}
$pdf->AliasNbPages();
$pdf->SetAutoPageBreak('auto',"55");

$pdf->Output();
