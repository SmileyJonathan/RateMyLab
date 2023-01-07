<?php
$host="127.0.0.1";
$port=3306;
$socket="";
$user="root";
$password="";
$dbname="ratemylab";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=user_reviews.csv');
    
    $output = fopen('php://output', 'w');
    fputcsv($output, ['CRN', 'Course Name', 'Section Number', 'Instructor Name', 'Rating', 'Difficulty', 'Review', 'Date']);
    
    $rows = $con->query(
      "SELECT lab_crn, course_name, section_num, instructor_name, lab_rating, difficulty, review, date_submitted FROM reviews",
      MYSQLI_USE_RESULT
    );
    while ($row = $rows->fetch_row()) {
      fputcsv($output, $row);
    }

?>