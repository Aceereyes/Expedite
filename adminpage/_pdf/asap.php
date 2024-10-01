
<?php

include "connection.php";

$studID=$_SESSION['sID'];
$secID=$_SESSION['secID'];

$showsecinfo=mysqli_query($con,"SELECT * FROM sections sec join accounts acc ON sec.AssignProf = acc.ID WHERE sec.secID=$secID ");
    $sci=mysqli_fetch_array($showsecinfo);

$secname=$sci['SecName'];
$subname=$sci['Subject'];

require('viewer/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    include "connection.php";
    $secID=$_SESSION['secID'];
    $studID=$_SESSION['sID'];
    $showsecinfo=mysqli_query($con,"SELECT * FROM sections sec join accounts acc ON sec.AssignProf = acc.ID WHERE sec.secID=$secID ");
    $sci=mysqli_fetch_array($showsecinfo);

    $showstudinfo=mysqli_query($con,"SELECT * FROM accounts WHERE ID = $studID ");
    $ssi=mysqli_fetch_array($showstudinfo);
    // Logo

    // Arial bold 15
    $this->SetFont('Arial','B',18);
    // Move to the right

    // Title

    $this->Cell(0,20,'Lyceum of the Philippines University - Cavite',0,1,'R');
    $this->SetFont('Arial','',15);
    $this->Cell(50,7,'Student Name',0,0,'L');
    $this->Cell(20,7,$ssi['fname'].' '.$ssi['lname'],0,0,'L');
    $this->Cell(0,7,'Student Attendance Report',0,1,'R');
    $this->Cell(50,7,'Subject',0,0,'L');
    $this->Cell(20,7,$sci['Subject'],0,1,'L');
    $this->Cell(50,7,'Section',0,0,'L');
    $this->Cell(20,7,$sci['SecName'],0,0,'L');
    $this->Cell(0,7,'',0,1,'R');
    $this->Cell(50,7,'Instructor',0,0,'L');
    $this->Cell(50,7,$sci['fname']." ".$sci['lname'] ,0,1,'L');
    $this->Cell(50,7,'Date Issued',0,0,'L');
    $this->Cell(50,7,date("M d Y - h:i A"),0,1,'L');
    $this->ln(8);
    $this->SetFont('Arial','',12);
    $this->Cell(10,7,'#',1,0,'C');
    $this->Cell(70,7,'Date & Time In',1,0,'C');
    $this->Cell(70,7,'Remarks',1,0,'C');


    //count lates
    $late=mysqli_query($con,"SELECT COUNT(ID) as cntlate FROM students_records WHERE recRemarks = 'Late' AND recstudID = '$studID' ");

    $l=mysqli_fetch_array($late);

    $this->Cell(70,7,'Total Late = '.$l['cntlate'],1,0,'C');

    //count absent
    $absent=mysqli_query($con,"SELECT COUNT(ID) as cntabsent FROM students_records WHERE recRemarks = 'Absent' AND recstudID = '$studID' ");

    $a=mysqli_fetch_array($absent);

    $this->Cell(70,7,'Total Absent = '.$a['cntabsent'],1,1,'C');






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

$showrec=mysqli_query($con,"SELECT * FROM students_records WHERE recstudID = '$studID' AND recSection = '$secname' AND recSubject ='$subname' ORDER BY ID DESC ");
$num=1;
while ($sr=mysqli_fetch_array($showrec)) {

    $pdf->Cell(10,7,$num,1,0,'C');
    $pdf->Cell(70,7,$sr['recDate']." | ".$sr['recTimeIn'],1,0,'C');
    $pdf->Cell(70,7,$sr['recRemarks'],1,1,'C');
    $num++;
}

$pdf->AliasNbPages();
$pdf->SetAutoPageBreak('auto',"55");

$pdf->Output();
