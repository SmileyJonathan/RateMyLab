<?php

session_start();

$host="127.0.0.1";
$port=3306;
$socket="";
$user="root";
$password="";
$dbname="ratemylab";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());


function validate($data){

    $data = trim($data);
 
    $data = stripslashes($data);
 
    $data = htmlspecialchars($data);
 
    return $data;
}

if (!empty($_POST['CRN'])) {
    $lab_crn = validate($_POST['CRN']);
    $query = "SELECT * FROM labs WHERE lab_crn= '$lab_crn'";
    $result = mysqli_query($con, $query);
    $lab = mysqli_fetch_assoc($result);
}
else if (!empty($_POST['Course']) && !empty($_POST['Section'])) {
    $course_name = validate($_POST['Course']);
    $section_num = validate($_POST['Section']);
    $_SESSION['course_name'] = $course_name;
    $_SESSION['section_num'] = $section_num;
    $query = "SELECT * FROM labs WHERE course_name= '$course_name' AND section_num= '$section_num'";
    $result = mysqli_query($con, $query);
    $lab = mysqli_fetch_assoc($result);
    
}
else {
    header("Location: student.php?error=Select an option");
    exit();
}

$_SESSION['lab_crn'] = $lab['lab_crn'];

header("Location:ratemylab.php");

exit();

?>