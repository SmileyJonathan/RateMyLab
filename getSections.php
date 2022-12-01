<?php
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
$course = validate($_POST["course_name"]);

if (!empty($course)) {
    $query = "SELECT * FROM labs WHERE course_name= '$course' ORDER BY section_num ASC";
    $all_labs = mysqli_query($con, $query);
    ?>
    <option disabled selected value>-- select an option --</option>
    <?php
        while ($lab = mysqli_fetch_array($all_labs,MYSQLI_ASSOC)):;
    ?>
    <option value="<?php echo $lab["section_num"]; ?>">
	    <?php echo $lab["section_num"]; ?>
    </option>
    <?php endwhile; ?>
<?php
    }
?>