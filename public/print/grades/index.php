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
        $check_parent = $db_parentchild->where(array("parentchild_id"), "parent_id", "$parent_id");
        // If no connected parents yet,  redirect home or check if not
        if(empty($check_parent)){header("Location: ../../");} else {
            // Loop to check if student ID  in parent 
            foreach($check_parent as $parentchild){
                // var for each student_id
                $si = $parentchild['student_id'];
                // if match add to allow_parent array
                if($student_id === $si) array_push($allow_parent, $si);
            }
        }//empty-checkparent
        // If allow parent array still empty, then student not connected, redirect home
        if(!$allow_parent) header("Location: ../../");
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

$grade_array = $db_enroll->where(array(),"student_id", "$student_id"); 
$attendance_array = $db_attendance->where(array("attendance_id"),  "student_id", "$student_id");

$site_title = "Holy Child Montessori";
$address = "Tanza, Navotas City, Philippines";
$office = "Office of the Registrar";

$doc_title = "Progress Report";

// Design PDF
$title = $first_name . "'s Progress Report";
$pdf->setTitle($title);

$pdf->AddPage();
$pdf->SetMargins(20,0,20);

// Set Logo
$pdf->Image('../../assets/logo.jpg',10,0,40);

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

// SY
$pdf->SetFont('Arial','',15);
$pdf->Text(105,48, $school_year);

$pdf->SetFont('Arial','',12);

// Name
$name = "Name: ".$first_name." ".$middle_name." ".$last_name." ".$suffix_name;
$pdf->Text(20,60, $name);
//Section
$gs = "Grade/Section: ".$grade." - ".$section;
$pdf->Text(120,60, $gs);
//SID
$s_id = "Student ID No.: ".$student_id;
$pdf->Text(20,65, $s_id);
//SID
$lrn = "LRN: ".$student_lrn;
$pdf->Text(120,65, $lrn);

// Legend
$pdf->SetFont('Arial','',8);
$pdf->SetTextColor(100,100,100);
$pdf->Text(20,70, "Grading System");
$pdf->SetTextColor(50,50,50);
$pdf->SetXY(20,72);

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
$pdf->Cell(20,5, '74% Below',1,0,'C','True');
$pdf->SetTextColor(50,50,50);
$pdf->Cell(40,5, 'Beginning (B)',1,0,'C',0);

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

$pdf->SetXY(20,85);

$pdf->SetFont('Arial','B',11);
$pdf->SetFillColor(46,139,87);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(15,5, 'ID',1,0,'C','true');
$pdf->Cell(80,5, 'Subject',1,0,'C','true');
$pdf->Cell(15,5, '1st',1,0,'C','true');
$pdf->Cell(15,5, '2nd',1,0,'C','true');
$pdf->Cell(15,5, '3rd',1,0,'C','true');
$pdf->Cell(15,5, '4th',1,0,'C','true');
$pdf->Cell(25,5, 'Final',1,0,'C','true');

$pdf->SetTextColor(10,10,10);
$pdf->SetFont('Arial','',11);

$total_average_grade = 0;
$total_subjects = 0;

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

        $pdf->Cell(15,5, $class_id,1,0,'C',0);
        $pdf->Cell(80,5, $subject_title,1,0,'L',0);
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
foreach($attendance_array as $key){
    foreach($key as $attendance_id){

        $sy_attendance = $db_attendance->get("school_year", "attendance_id", "$attendance_id");

        if($sy_attendance === $school_year){

		    $grade  = $db_attendance->get("grade", "attendance_id", "$attendance_id");
			$section  = $db_attendance->get("section", "attendance_id", "$attendance_id");
			$absent_jan  = $db_attendance->get("absent_jan", "attendance_id", "$attendance_id");
		    $absent_feb  = $db_attendance->get("absent_feb", "attendance_id", "$attendance_id");
			$absent_mar  = $db_attendance->get("absent_mar", "attendance_id", "$attendance_id");
			$absent_apr  = $db_attendance->get("absent_apr", "attendance_id", "$attendance_id");
			$absent_may  = $db_attendance->get("absent_may", "attendance_id", "$attendance_id");
			$absent_jun  = $db_attendance->get("absent_jun", "attendance_id", "$attendance_id");
			$absent_jul  = $db_attendance->get("absent_jul", "attendance_id", "$attendance_id");
			$absent_aug  = $db_attendance->get("absent_aug", "attendance_id", "$attendance_id");
			$absent_sep  = $db_attendance->get("absent_sep", "attendance_id", "$attendance_id");
			$absent_oct  = $db_attendance->get("absent_oct", "attendance_id", "$attendance_id");
			$absent_nov  = $db_attendance->get("absent_nov", "attendance_id", "$attendance_id");
			$absent_dec  = $db_attendance->get("absent_dec", "attendance_id", "$attendance_id");
			$absent_total = $absent_jan + $absent_feb + $absent_mar + $absent_apr + $absent_may + $absent_jun + $absent_jul + $absent_aug + $absent_sep + $absent_oct + $absent_nov + $absent_dec;
					
			$late_jan  = $db_attendance->get("late_jan", "attendance_id", "$attendance_id");
			$late_feb  = $db_attendance->get("late_feb", "attendance_id", "$attendance_id");
			$late_mar  = $db_attendance->get("late_mar", "attendance_id", "$attendance_id");
			$late_apr  = $db_attendance->get("late_apr", "attendance_id", "$attendance_id");
			$late_may  = $db_attendance->get("late_may", "attendance_id", "$attendance_id");
			$late_jun  = $db_attendance->get("late_jun", "attendance_id", "$attendance_id");
			$late_jul  = $db_attendance->get("late_jul", "attendance_id", "$attendance_id");
			$late_aug  = $db_attendance->get("late_aug", "attendance_id", "$attendance_id");
			$late_sep  = $db_attendance->get("late_sep", "attendance_id", "$attendance_id");
			$late_oct  = $db_attendance->get("late_oct", "attendance_id", "$attendance_id");
			$late_nov  = $db_attendance->get("late_nov", "attendance_id", "$attendance_id");
			$late_dec  = $db_attendance->get("late_dec", "attendance_id", "$attendance_id");
			$late_total = $late_jan + $late_feb + $late_mar + $late_apr + $late_may + $late_jun + $late_jul + $late_aug + $late_sep + $late_oct + $late_nov + $late_dec; 

$c_y = $pdf->getY();
$pdf->SetXY(20,$c_y+5);
$pdf->SetTextColor(10,10,10);
$pdf->SetFont('Arial','',10);
$pdf->Cell(25,5, 'Days Absent',1,0,'C',0);
$pdf->Cell(12,5, $absent_jun,1,0,'C',0);
$pdf->Cell(12,5, $absent_jul,1,0,'C',0);
$pdf->Cell(12,5, $absent_aug,1,0,'C',0);
$pdf->Cell(12,5, $absent_sep,1,0,'C',0);
$pdf->Cell(12,5, $absent_oct,1,0,'C',0);
$pdf->Cell(12,5, $absent_nov,1,0,'C',0);
$pdf->Cell(12,5, $absent_dec,1,0,'C',0);
$pdf->Cell(12,5, $absent_jan,1,0,'C',0);
$pdf->Cell(12,5, $absent_feb,1,0,'C',0);
$pdf->Cell(12,5, $absent_mar,1,0,'C',0);
$pdf->Cell(12,5, $absent_apr,1,0,'C',0);
$pdf->Cell(12,5, $absent_may,1,0,'C',0);
$pdf->Cell(12,5, $absent_total,1,0,'C',0);
$c_y = $pdf->getY();
$pdf->SetXY(20,$c_y+5);
$pdf->Cell(25,5, 'Times Tardy',1,0,'C',0);
$pdf->Cell(12,5, $late_jun,1,0,'C',0);
$pdf->Cell(12,5, $late_jul,1,0,'C',0);
$pdf->Cell(12,5, $late_aug,1,0,'C',0);
$pdf->Cell(12,5, $late_sep,1,0,'C',0);
$pdf->Cell(12,5, $late_oct,1,0,'C',0);
$pdf->Cell(12,5, $late_nov,1,0,'C',0);
$pdf->Cell(12,5, $late_dec,1,0,'C',0);
$pdf->Cell(12,5, $late_jan,1,0,'C',0);
$pdf->Cell(12,5, $late_feb,1,0,'C',0);
$pdf->Cell(12,5, $late_mar,1,0,'C',0);
$pdf->Cell(12,5, $late_apr,1,0,'C',0);
$pdf->Cell(12,5, $late_may,1,0,'C',0);
$pdf->Cell(12,5, $late_total,1,0,'C',0);

        }

    }
}
}

$c_y = $pdf->getY();
$pdf->SetXY(20,$c_y+10);
$pdf->Cell(110,5, "Eligible for Transfer and Admission to: ______________________",0,0,'L',0);
$pdf->Cell(90,5, "Lacks credits in: ______________________",0,0,'L',0);
$c_y = $pdf->getY();
$pdf->SetXY(20,$c_y+10);
$pdf->Cell(180,5, "_________________________________",0,0,'C',0);
$c_y = $pdf->getY();
$pdf->SetXY(20,$c_y+5);
$pdf->Cell(180,5, "Principal/Registrar",0,0,'C',0);

$c_y = $pdf->getY();
$pdf->SetXY(20,$c_y+10);
$pdf->Cell(180,5, "CANCELATION OF TRANSFER ELIGIBILITY",0,0,'C',0);
$c_y = $pdf->getY();
$pdf->SetXY(20,$c_y+5);
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
$pdf->Text(20,260, "System Generated Form. Printed on $date.");
$pdf->Text(20,265, "Not valid for enrollment unless signed by the School Registrar/Principal.");
// Output Document
$pdf->Output();
?>
