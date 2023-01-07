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

if (isset($_POST['Lab'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $course_name = validate($_POST['Lab']);
    $sql = "SELECT * FROM labs WHERE course_name ='$course_name'";
    $result = mysqli_query($con, $sql);
    $lab = mysqli_fetch_assoc($result);
    $instructor_name = $lab['instructor_name'];

    $sql = "DELETE FROM labs WHERE course_name = '$course_name'";
    $result = mysqli_query($con, $sql);

    $sql = "SELECT * FROM labs WHERE instructor_name = '$instructor_name'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) === 0) {
        $sql = "DELETE FROM logins WHERE instructor_name = '$instructor_name'";
        $result = mysqli_query($con, $sql);
    }

    header("Location: add-delete.php?success=Success");
    
    exit();
}

else{
    header("Location: add-delete.php?error=Select an option");

    exit();

}