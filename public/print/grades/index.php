<?php
/*
Holy Child Montessori
2017

Print Grade
*/

// Start Session
session_start();

// Check if user is logged in
if(empty($_SESSION['logged_in'])){
    header("Location: ../../");
}

// Declarative
require('../_lib/fpdf.php');
include('../../action/_require/db.php');

$site_title = "Holy Child Montessori";
$address = "Tanza, Navotas City, Philippines";
$office = "Office of the Registrar";

$doc_title = "Progress Report";

// Create obj for FPDF
$pdf = new FPDF('P','mm','Letter');

// Get Account Type
$account_type = $_SESSION['account_type'];

// Switch for Account Type
switch($account_type){
    
    case('admin'):
        // Check if Student ID  of student requested is empty
        if(empty($_REQUEST['student_id'])){
            // Redirect Home
            header("Location: ../../");
        } else {
            // Set given Student ID as var
            $student_id = $_REQUEST['student_id'];
        }
        break;
    
    case('student'):
        // Set Student ID from session as var
        $student_id = $_SESSION['student_id'];
        // Check if student hold exists
        $hold = $db_hold->where(array("hold_id"), "student_id", "$student_id");
        // If hold does exist redirect home
        if(!empty($hold)) header("Location: ../../");
        break;
    
    case('parent'):
        // Check if Student ID  of student requested is empty
        if(empty($_REQUEST['student_id'])){
            // Redirect Home
            header("Location: ../../");
        } else {
            // Set given Student ID as var
            $student_id = $_REQUEST['student_id'];
        }
        // Set empty allow parent array
        $allow_parent = array();
        // Get Parent ID from current session
        $parent_id = $_SESSION['parent_id'];
        // Query in DB for connected parent-student
        $check_parent = $db_parentchild->where(array(), "parent_id", "$parent_id");
        // If no connected parents yet,  redirect home or check if not
        if(empty($check_parent)){header("Location: ../../");} else {
            // Loop to check if student ID  in parent 
            foreach($check_parent as $parentchild){
                // var for each student_id
                $si = $parentchild['student_id'];
                // if match add to allow_parent array
                if($student_id == $si) array_push($allow_parent, $si);
            }
        }//empty-checkparent
        // If allow parent array still empty, then student not connected, redirect home
        if(empty($allow_parent)) header("Location: ../../");
        // Query DB if student has hold
        $hold = $db_hold->where(array("hold_id"), "student_id", "$student_id");
        // if hold is not empty redirect home
        if(!empty($hold)) header("Location: ../../");
        break;

    default:
        // Redirect home for other account types
        header("Location: ../../");
        break;
}

//  Get Student Info
$student_info_array = $db_student->where(array(),"student_id", "$student_id");

// Loop through student info
foreach($student_info_array as $student){

    $first_name = $student['first_name'];
    $middle_name = $student['middle_name'];
    $last_name = $student['last_name'];
    $suffix_name = $student['suffix_name'];

    $school_year = $student['school_year'];
    $student_lrn = $student['student_lrn'];
    $grade = $student['grade'];
    $section = $student['section'];

}

// Get grades (Array)
$grade_array = $db_enroll->where(array(),"student_id", "$student_id"); 
// Get attendance (Array)
$attendance_array = $db_attendance->where(array(),  "student_id", "$student_id");

// Design PDF
$title = $first_name . "'s Progress Report";

// Set Filename
$pdf->setTitle($title);

// Initialize Page
$pdf->AddPage();

// Set Margins
$pdf->SetMargins(20,0,20);

// Set Logo
$pdf->Image('../../assets/imgs/logo.jpg',10,0,40);

// Site Title
$pdf->SetFont('Arial','B',18);
$pdf->SetTextColor(46,139,87);
$pdf->Text(85,15, $site_title);

// Address
$pdf->SetTextColor(10,10,10);
$pdf->SetFont('Arial','',11);
$pdf->Text(90,20, $address);

// Office
$pdf->SetFont('Arial','',14);
$pdf->Text(94,30, $office);

// Document Title
$pdf->SetFont('Arial','B',20);
$pdf->Text(90,40, $doc_title);

// School Year
$pdf->SetFont('Arial','',15);
$pdf->Text(105,48, $school_year);

// Set Font to Normal 12pt
$pdf->SetFont('Arial','',12);

// Name
$name = "Name: ".$first_name." ".$middle_name." ".$last_name." ".$suffix_name;
$pdf->Text(20,60, $name);

// Section
$gs = "Grade/Section: ".$grade." - ".$section;
$pdf->Text(120,60, $gs);

// SID
$s_id = "Student ID No.: ".$student_id;
$pdf->Text(20,65, $s_id);

/*
// LRN
$lrn = "LRN: ".$student_lrn;
$pdf->Text(120,65, $lrn);
*/

/*
Legend
*/

// Title
$pdf->SetFont('Arial','',8);
$pdf->SetTextColor(100,100,100);
$pdf->Text(20,70, "Grading System");
$pdf->SetTextColor(50,50,50);
$pdf->SetXY(20,72);

// col 1
$pdf->SetFillColor(46,139,87);

$pdf->SetTextColor(255,255,255);
$pdf->Cell(20,5, '90% above',1,0,'C','True');
$pdf->SetTextColor(50,50,50);
$pdf->Cell(40,5, 'Advanced (A)',1,0,'C',0);

$pdf->SetTextColor(255,255,255);
$pdf->Cell(20,5, '80%-84%',1,0,'C','True');
$pdf->SetTextColor(50,50,50);
$pdf->Cell(40,5, 'Approaching Proficiency (AP)',1,0,'C',0);

$pdf->SetTextColor(255,255,255);
$pdf->Cell(20,5, '74% below',1,0,'C','True');
$pdf->SetTextColor(50,50,50);
$pdf->Cell(40,5, 'Beginning (B)',1,0,'C',0);

// col 2
$c_y = $pdf->getY();

$pdf->SetXY(20,$c_y+5);

$pdf->SetTextColor(255,255,255);
$pdf->Cell(20,5, '85%-89%',1,0,'C','True');
$pdf->SetTextColor(50,50,50);
$pdf->Cell(40,5, 'Proficient (P)',1,0,'C',0);

$pdf->SetTextColor(255,255,255);
$pdf->Cell(20,5, '75%-79%',1,0,'C','True');
$pdf->SetTextColor(50,50,50);
$pdf->Cell(40,5, 'Developing (D)',1,0,'C',0);

$pdf->SetTextColor(255,255,255);
$pdf->Cell(20,5, '',1,0,'C','True');
$pdf->SetTextColor(50,50,50);
$pdf->Cell(40,5, '',1,0,'C',0);

/*
Grades
*/

$pdf->SetXY(20,85);

// Table Head
$pdf->SetFont('Arial','B',11);
$pdf->SetFillColor(46,139,87);
$pdf->SetTextColor(255,255,255);

/*
with ID
$pdf->Cell(15,5, 'ID',1,0,'C','true');
$pdf->Cell(80,5, 'Subject',1,0,'C','true');
$pdf->Cell(15,5, '1st',1,0,'C','true');
$pdf->Cell(15,5, '2nd',1,0,'C','true');
$pdf->Cell(15,5, '3rd',1,0,'C','true');
$pdf->Cell(15,5, '4th',1,0,'C','true');
$pdf->Cell(25,5, 'Final',1,0,'C','true');
*/

$pdf->Cell(95,5, 'Subject',1,0,'C','true');
$pdf->Cell(15,5, '1st',1,0,'C','true');
$pdf->Cell(15,5, '2nd',1,0,'C','true');
$pdf->Cell(15,5, '3rd',1,0,'C','true');
$pdf->Cell(15,5, '4th',1,0,'C','true');
$pdf->Cell(25,5, 'Final',1,0,'C','true');

// Set to normal 11pt and black color
$pdf->SetTextColor(10,10,10);
$pdf->SetFont('Arial','',11);

// Initialize values
$total_average_grade = 0;
$total_subjects = 0;

// Loop through grade array
foreach($grade_array as $grade){

    $enroll_id = $grade['enroll_id'];
    $sy_enroll = $grade['school_year'];
    if($sy_enroll == $school_year){
        
        $class_id = $grade['class_id'];

        $first_quarter = $grade['first_quarter_grade'];
        $second_quarter = $grade['second_quarter_grade'];
        $third_quarter = $grade['third_quarter_grade'];
        $fourth_quarter = $grade['fourth_quarter_grade'];
        $final_grade = $grade['final_grade'];

        $subject_id = $db_class->get("subject_id","class_id","$class_id");
        $subject_title = $db_subject->get("subject_title", "subject_id", "$subject_id");

        $div = 4;

        if(!$fourth_quarter){
            $div = 3;
            $fourth_quarter = 0;
        }
        if(!$third_quarter){
            $div = 2;
            $third_quarter = 0;
        }
        if(!$second_quarter){
            $div = 1;
            $second_quarter = 0;
        }
        if(!$first_quarter){
            $div = 1;
            $first_quarter = 0;
        }

        $average_grade = ceil(($first_quarter + $second_quarter + $third_quarter + $fourth_quarter)/$div);

        if(!empty($fourth_quarter)){
            if(!$final_grade){
                $fg = "PASS";
            } else {
                $fg = "FAIL";
            }
            $final_grade = $fg;
        }

        if($first_quarter == 0) $first_quarter = "";
        if($second_quarter == 0) $second_quarter = "";
        if($third_quarter == 0) $third_quarter = "";
        if($fourth_quarter == 0) $fourth_quarter = "";

        $c_y = $pdf->getY();
        $pdf->SetXY(20,$c_y+5);

        /*
        with ID
        $pdf->Cell(15,5, $class_id,1,0,'C',0);
        $pdf->Cell(80,5, $subject_title,1,0,'L',0);
        $pdf->Cell(15,5, $first_quarter,1,0,'C',0);
        $pdf->Cell(15,5, $second_quarter,1,0,'C',0);
        $pdf->Cell(15,5, $third_quarter,1,0,'C',0);
        $pdf->Cell(15,5, $fourth_quarter,1,0,'C',0);
        $pdf->Cell(25,5, $final_grade,1,0,'C',0);
        */

        $pdf->Cell(95,5, $subject_title,1,0,'L',0);
        $pdf->Cell(15,5, $first_quarter,1,0,'C',0);
        $pdf->Cell(15,5, $second_quarter,1,0,'C',0);
        $pdf->Cell(15,5, $third_quarter,1,0,'C',0);
        $pdf->Cell(15,5, $fourth_quarter,1,0,'C',0);
        $pdf->Cell(25,5, $final_grade,1,0,'C',0);

        $total_average_grade = $total_average_grade+$average_grade;
        $total_subjects = $total_subjects+1;

    }
}

if($total_subjects === 0) $total_subjects=1;
$total_average_grade = ceil($total_average_grade/$total_subjects);

$c_y = $pdf->getY();
$pdf->SetXY(20,$c_y+5);
$pdf->Cell(95,5, '',1,0,'C',0);
$pdf->Cell(60,5, "General Average",1,0,'C',0);
$pdf->Cell(25,5, $total_average_grade,1,0,'C',0);

$c_y = $pdf->getY();
$pdf->SetXY(20,$c_y+10);

$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(46,139,87);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(25,5, '',1,0,'C','true');
$pdf->Cell(12,5, 'Jun',1,0,'C','true');
$pdf->Cell(12,5, 'Jul',1,0,'C','true');
$pdf->Cell(12,5, 'Aug',1,0,'C','true');
$pdf->Cell(12,5, 'Sep',1,0,'C','true');
$pdf->Cell(12,5, 'Oct',1,0,'C','true');
$pdf->Cell(12,5, 'Nov',1,0,'C','true');
$pdf->Cell(12,5, 'Dec',1,0,'C','true');
$pdf->Cell(12,5, 'Jan',1,0,'C','true');
$pdf->Cell(12,5, 'Feb',1,0,'C','true');
$pdf->Cell(12,5, 'Mar',1,0,'C','true');
$pdf->Cell(12,5, 'Apr',1,0,'C','true');
$pdf->Cell(12,5, 'May',1,0,'C','true');
$pdf->Cell(12,5, 'Total',1,0,'C','true');

if(empty($attendance_array)){

    $c_y = $pdf->getY();
    $pdf->SetXY(20,$c_y+5);
    $pdf->SetTextColor(10,10,10);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(181,5, '--Not Yet Officially Enrolled--',1,0,'C',0);

} else {

    foreach($attendance_array as $att){
    
        $attendance_id = $att['attendance_id'];
        $sy_attendance = $att['school_year'];

        if($sy_attendance == $school_year){

            $grade = $att['grade'];
            $section = $att['section'];

            $pres_jan = $att['pres_jan'];
            $pres_feb = $att['pres_feb'];
            $pres_mar = $att['pres_mar'];
            $pres_apr = $att['pres_apr'];
            $pres_may = $att['pres_may'];
            $pres_jun = $att['pres_jun'];
            $pres_jul = $att['pres_jul'];
            $pres_aug = $att['pres_aug'];
            $pres_sep = $att['pres_sep'];
            $pres_oct = $att['pres_oct'];
            $pres_nov = $att['pres_nov'];
            $pres_dec = $att['pres_dec'];
            if(!$pres_jan) $pres_jan = 0;
            if(!$pres_feb) $pres_feb = 0;
            if(!$pres_mar) $pres_mar = 0;
            if(!$pres_apr) $pres_apr = 0;
            if(!$pres_may) $pres_may = 0;
            if(!$pres_jun) $pres_jun = 0;
            if(!$pres_jul) $pres_jul = 0;
            if(!$pres_aug) $pres_aug = 0;
            if(!$pres_sep) $pres_sep = 0;
            if(!$pres_oct) $pres_oct = 0;
            if(!$pres_nov) $pres_nov = 0;
            if(!$pres_dec) $pres_dec = 0;
            $pres_total = $pres_jan + $pres_feb + $pres_mar + $pres_apr + $pres_may + $pres_jun + $pres_jul + $pres_aug + $pres_sep + $pres_oct + $pres_nov + $pres_dec;
            $pres_jan = $att['pres_jan'];
            $pres_feb = $att['pres_feb'];
            $pres_mar = $att['pres_mar'];
            $pres_apr = $att['pres_apr'];
            $pres_may = $att['pres_may'];
            $pres_jun = $att['pres_jun'];
            $pres_jul = $att['pres_jul'];
            $pres_aug = $att['pres_aug'];
            $pres_sep = $att['pres_sep'];
            $pres_oct = $att['pres_oct'];
            $pres_nov = $att['pres_nov'];
            $pres_dec = $att['pres_dec'];

            $sch_jan = $att['sch_jan'];
            $sch_feb = $att['sch_feb'];
            $sch_mar = $att['sch_mar'];
            $sch_apr = $att['sch_apr'];
            $sch_may = $att['sch_may'];
            $sch_jun = $att['sch_jun'];
            $sch_jul = $att['sch_jul'];
            $sch_aug = $att['sch_aug'];
            $sch_sep = $att['sch_sep'];
            $sch_oct = $att['sch_oct'];
            $sch_nov = $att['sch_nov'];
            $sch_dec = $att['sch_dec'];
            if(!$sch_jan) $sch_jan = 0;
            if(!$sch_feb) $sch_feb = 0;
            if(!$sch_mar) $sch_mar = 0;
            if(!$sch_apr) $sch_apr = 0;
            if(!$sch_may) $sch_may = 0;
            if(!$sch_jun) $sch_jun = 0;
            if(!$sch_jul) $sch_jul = 0;
            if(!$sch_aug) $sch_aug = 0;
            if(!$sch_sep) $sch_sep = 0;
            if(!$sch_oct) $sch_oct = 0;
            if(!$sch_nov) $sch_nov = 0;
            if(!$sch_dec) $sch_dec = 0;
            $sch_total = $sch_jan + $sch_feb + $sch_mar + $sch_apr + $sch_may + $sch_jun + $sch_jul + $sch_aug + $sch_sep + $sch_oct + $sch_nov + $sch_dec; 
            $sch_jan = $att['sch_jan'];
            $sch_feb = $att['sch_feb'];
            $sch_mar = $att['sch_mar'];
            $sch_apr = $att['sch_apr'];
            $sch_may = $att['sch_may'];
            $sch_jun = $att['sch_jun'];
            $sch_jul = $att['sch_jul'];
            $sch_aug = $att['sch_aug'];
            $sch_sep = $att['sch_sep'];
            $sch_oct = $att['sch_oct'];
            $sch_nov = $att['sch_nov'];
            $sch_dec = $att['sch_dec'];

            // Absences
            $c_y = $pdf->getY();
            $pdf->SetXY(20,$c_y+5);
            $pdf->SetTextColor(10,10,10);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(25,5, 'Days Present',1,0,'C',0);
            $pdf->Cell(12,5, $pres_jun,1,0,'C',0);
            $pdf->Cell(12,5, $pres_jul,1,0,'C',0);
            $pdf->Cell(12,5, $pres_aug,1,0,'C',0);
            $pdf->Cell(12,5, $pres_sep,1,0,'C',0);
            $pdf->Cell(12,5, $pres_oct,1,0,'C',0);
            $pdf->Cell(12,5, $pres_nov,1,0,'C',0);
            $pdf->Cell(12,5, $pres_dec,1,0,'C',0);
            $pdf->Cell(12,5, $pres_jan,1,0,'C',0);
            $pdf->Cell(12,5, $pres_feb,1,0,'C',0);
            $pdf->Cell(12,5, $pres_mar,1,0,'C',0);
            $pdf->Cell(12,5, $pres_apr,1,0,'C',0);
            $pdf->Cell(12,5, $pres_may,1,0,'C',0);
            $pdf->Cell(12,5, $pres_total,1,0,'C',0);

            // Lates
            $c_y = $pdf->getY();
            $pdf->SetXY(20,$c_y+5);
            $pdf->Cell(25,5, 'Days of School',1,0,'C',0);
            $pdf->Cell(12,5, $sch_jun,1,0,'C',0);
            $pdf->Cell(12,5, $sch_jul,1,0,'C',0);
            $pdf->Cell(12,5, $sch_aug,1,0,'C',0);
            $pdf->Cell(12,5, $sch_sep,1,0,'C',0);
            $pdf->Cell(12,5, $sch_oct,1,0,'C',0);
            $pdf->Cell(12,5, $sch_nov,1,0,'C',0);
            $pdf->Cell(12,5, $sch_dec,1,0,'C',0);
            $pdf->Cell(12,5, $sch_jan,1,0,'C',0);
            $pdf->Cell(12,5, $sch_feb,1,0,'C',0);
            $pdf->Cell(12,5, $sch_mar,1,0,'C',0);
            $pdf->Cell(12,5, $sch_apr,1,0,'C',0);
            $pdf->Cell(12,5, $sch_may,1,0,'C',0);
            $pdf->Cell(12,5, $sch_total,1,0,'C',0);

        }

    }

}

/*
Prefooter Forms
*/

$pdf->SetFont('Arial','',10);

// Certificate of Transfer
$c_y = $pdf->getY();
$pdf->SetXY(20,$c_y+15);
$pdf->Cell(180,5, "CERTIFICATE OF TRANSFER",0,0,'C',0);

$c_y = $pdf->getY();

$pdf->SetXY(20,$c_y+10);
$pdf->Cell(110,5, "Eligible for Transfer and Admission to: ______________________",0,0,'L',0);
$pdf->Cell(90,5, "Lacks credits in: ______________________",0,0,'L',0);

$c_y = $pdf->getY();
$pdf->SetXY(20,$c_y+10);
$pdf->Cell(180,5, "_________________________________",0,0,'C',0);

$c_y = $pdf->getY();
$pdf->SetXY(20,$c_y+4);
$pdf->Cell(180,5, "Principal/Registrar",0,0,'C',0);


// Cancellation of Transfer Eligibility
$c_y = $pdf->getY();
$pdf->SetXY(20,$c_y+10);
$pdf->Cell(180,5, "CANCELLATION OF TRANSFER ELIGIBILITY",0,0,'C',0);

$c_y = $pdf->getY();
$pdf->SetXY(20,$c_y+10);
$pdf->Cell(70,5, "Has been admitted to: _______________",0,0,'L',0);
$pdf->Cell(110,5, "School: _________________________________________________",0,0,'L',0);

$c_y = $pdf->getY();
$pdf->SetXY(20,$c_y+5);
$pdf->Cell(70,5, "Date: ____________________________",0,0,'L',0);

$c_y = $pdf->getY();
$pdf->SetXY(20,$c_y+10);
$pdf->Cell(180,5, "_________________________________",0,0,'C',0);

$c_y = $pdf->getY();
$pdf->SetXY(20,$c_y+5);
$pdf->Cell(180,5, "Principal",0,0,'C',0);

// Footer
$pdf->SetTextColor(130,130,130);
$date = date("M d, Y h:i a");

$pdf->SetFont('Arial','B',9);
$pdf->Text(20,255, "DepEd Form 138");
$pdf->SetTextColor(180,180,180);
$pdf->SetFont('Arial','',6);
$pdf->Text(20,260, "System Generated Form. Printed on $date.");

//$pdf->Text(20,265, "Not valid for enrollment unless signed by the School Registrar/Principal.");

// Output Document
$fn = "progressreport-$last_name-$first_name.pdf";
$pdf->Output('',$fn,true);
?>