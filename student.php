<?php
$host="127.0.0.1";
$port=3306;
$socket="";
$user="root";
$password="";
$dbname="ratemylab";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

  $sql = "SELECT * FROM labs ORDER BY lab_crn ASC";
	$all_labs = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="student.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <script
      src="https://kit.fontawesome.com/6df089f401.js"
      crossorigin="anonymous"
    ></script>
  </head>

  <script src="jquery.main.js" type="text/javascript"></script>
  <script type="text/javascript">
    function getSections(val){
      $.ajax({
        type: "POST",
        url: "getSections.php",
        data: "course_name=" + val,
        success:function(data){
          $("#sectionSelect").html(data);
        }
      })
    }
  </script>




  <body>
    <form action="ratemylab.php" method="post">
    <div class="content">
      <div class="img-container">
        <img src="RateMyLabassets/Logo.png" alt="Georgia State University" />
      </div>
      <h1>Student</h1>
      <p>Please enter lab information</p>

      <?php if (isset($_GET['error'])) { ?>
      <p class="error"><?php echo $_GET['error']; ?></p>
      <?php } ?>

      <label>Select Lab CRN</label>

      <select name="CRN">
        <option disabled selected value>-- select an option --</option>
		    <?php 
			    while ($lab = mysqli_fetch_array($all_labs,MYSQLI_ASSOC)):;
	  	  ?>	
        <option value="<?php echo $lab["lab_crn"]; ?>">
			    <?php echo $lab["lab_crn"]; ?>
        </option>
        <?php endwhile; ?>
      </select>

      <p id="orSpanp"><span id="orSpan">or</span></p>

      <label>Select Course</label>

      <select id="crnSelect" name="Course" onchange="getSections(this.value);">
        <option disabled selected value>-- select an option --</option>
        <?php 
          $sql = "SELECT DISTINCT course_name FROM labs ORDER BY course_name ASC";
          $all_labs = mysqli_query($con, $sql);
			    while ($lab = mysqli_fetch_array($all_labs,MYSQLI_ASSOC)):;
	  	  ?>	
        <option value="<?php echo $lab["course_name"]; ?>">
			    <?php echo $lab["course_name"]; ?>
        </option>
        <?php endwhile; ?>
      </select>

      <label>Select Section Number</label>

      <select id = "sectionSelect" name="Section Number">
        <option disabled selected value>-- select an option --</option>
      </select>

      <button type=submit id=rate>Rate My Lab</a>
    </div>
  </form>
  </body>
</html>