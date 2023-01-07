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

if (isset($_POST['date']) && isset($_POST['scale1']) && isset($_POST['scale2']) && isset($_POST['body'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    echo htmlspecialchars($_POST['body']);

    $date_submitted= validate($_POST['date']);

    $lab_rating = validate($_POST['scale1']);

    $difficulty = validate($_POST['scale2']);

    $review = validate($_POST['body']);

    $lab_crn = $_SESSION['lab_crn'];
    
    $section_num = $_SESSION['section_num'];

    $instructor_name = $_SESSION['instructor_name'];

    $course_name = $_SESSION['course_name'];

    if (!empty($date_submitted) && !empty($lab_rating) && !empty($difficulty) && !empty($review)) {

        $insert_query = "INSERT INTO reviews (
            review_id,
            lab_crn,
            course_name,
            section_num,
            instructor_name,
            lab_rating,
            difficulty,
            review,
            date_submitted) 
            VALUES (null, '$lab_crn', '$course_name', '$section_num', '$instructor_name', '$lab_rating', '$difficulty', '$review', '$date_submitted')";
        $result = mysqli_query($con, $insert_query);

        $update_query1 = "UPDATE labs 
        SET labs.avg_rate = (SELECT ROUND(AVG(lab_rating), 1)
        FROM reviews
        WHERE reviews.lab_crn = labs.lab_crn)";
        $result = mysqli_query($con, $update_query1);
        
        $update_query2 = "UPDATE labs 
        SET labs.avg_dif = (SELECT ROUND(AVG(difficulty), 1)
        FROM reviews
        WHERE reviews.lab_crn = labs.lab_crn)";
        $result = mysqli_query($con, $update_query2);

        header("Location: ratemylab.php?error=Review submitted");

        exit();
    
    }
    else{
        header("Location: form.php?error=Please fill in all parts of the review");

        exit();

    }

}

else{
    header("Location: form.php?error=Please fill in all parts of the review");

    exit();

}