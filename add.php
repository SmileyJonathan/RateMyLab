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

if (isset($_POST['Course']) && isset($_POST['Section']) && isset($_POST['Instructor']) && isset($_POST['CRN'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $course_name = validate($_POST['Course']);

    $section_num = validate($_POST['Section']);

    $instructor_name = validate($_POST['Instructor']);

    $lab_crn = validate($_POST['CRN']);

    if (!empty($course_name) && !empty($section_num) && !empty($instructor_name) && !empty($lab_crn)) {

        $sql = "SELECT * FROM labs WHERE course_name ='$course_name' AND section_num = '$section_num' ";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) === 0) {
            $sql = "SELECT * FROM labs WHERE lab_crn = '$lab_crn' ";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) === 0) {

                $sql = "SELECT * FROM logins WHERE instructor_name = '$instructor_name' ";
                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) === 0) {
                    $user = strtolower(substr($instructor_name,0,1)) . strtolower(substr($instructor_name, strpos($instructor_name, " ") + 1)) . "1";
                    $pass = "panther";

                    $insert_query = "INSERT INTO logins (
                        instructor_name,
                        username,
                        password) 
                        VALUES ('$instructor_name', '$user', '$pass')";
                    $result = mysqli_query($con, $insert_query);
                }
                
                $insert_query = "INSERT INTO labs (
                    lab_crn,
                    course_name,
                    section_num,
                    instructor_name,
                    avg_rate,
                    avg_dif) 
                    VALUES ('$lab_crn', '$course_name', '$section_num', '$instructor_name', null, null)";
                $result = mysqli_query($con, $insert_query);
        
                header("Location: add-delete.php?success=Success");
        
                exit();

            }
            else {
                header("Location: add-delete.php?error=Lab CRN is taken");

                exit(); 
            }
        }
        else {
            header("Location: add-delete.php?error=This lab already exists");

            exit(); 
        }   
    }

    else{
        header("Location: add-delete.php?error=Please insert all parts required");

        exit();

    }

}

else{
    header("Location: add-delete.php?error=Please insert all parts required");

    exit();

}