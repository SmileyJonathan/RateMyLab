<?php
$host="127.0.0.1";
$port=3306;
$socket="";
$user="root";
$password="";
$dbname="ratemylab";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

$sql = "SELECT DISTINCT course_name FROM labs ORDER BY course_name ASC";
$all_labs = mysqli_query($con, $sql);

session_start();
?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="add-delete.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" href="favicon.ico">
    <script
      src="https://kit.fontawesome.com/6df089f401.js"
      crossorigin="anonymous"
    ></script>
  </head>

  
  <script type="text/javascript">
    function changePage(val){
        switch(val){
            case "Add":
                document.body.innerHTML= "<form action=\"add.php\" method=\"post\">"
                                        + "<nav>"
                                        +   "<a href=\"home.html\">"
                                        +       "<img src=\"RateMyLabassets/Logo.png\" alt=\"Georgia State University\" />"
                                        +   "</a>"
                                        +"</nav>"
                                        +"<h1>Add or Delete</h1>"
                                        +"<select name=\"add-delete\" onchange=\"changePage(this.value)\">"
                                        +"  <option selected value>Add</option>"
                                        +"  <option value=\"Delete\">Delete</option>"
                                        +"</select>"
                                        +"<label>Course Name</label>"
                                        +"<input id=\"course\" name=\"Course\" type=\"text\"></input>"
                                        +"<label>Section Number</label>"
                                        +"<select name=\"Section\">"
                                        +"  <option disabled selected value>-- select an option --</option>"
                                        +"  <option value=\"001\">001</option>"
                                        +"  <option value=\"002\">002</option>"
                                        +"  <option value=\"003\">003</option>"
                                        +"  <option value=\"004\">004</option>"
                                        +"  <option value=\"005\">005</option>"
                                        +"  <option value=\"006\">006</option>"
                                        +"  <option value=\"007\">007</option>"
                                        +"  <option value=\"008\">008</option>"
                                        +"  <option value=\"009\">009</option>"
                                        +"  <option value=\"010\">010</option>"
                                        +"  <option value=\"011\">011</option>"
                                        +"  <option value=\"012\">012</option>"
                                        +"  <option value=\"013\">013</option>"
                                        +"  <option value=\"014\">014</option>"
                                        +"  <option value=\"015\">015</option>"
                                        +"  <option value=\"016\">016</option>"
                                        +"</select>"
                                        +"<label>Instructor Name</label>"
                                        +"<input id=\"instructor\" name=\"Instructor\" type=\"text\"></input>"
                                        +"<label>Lab CRN</label>"
                                        +"<input id=\"crn\" name=\"CRN\" type=\"number\" min=\"10000\"max=\"99999\"></input>"
                                        +"<button type=submit id=enter>Submit</a>"
                                        +"</form>";

            break;
            case "Delete":
                document.body.innerHTML= "<form action=\"delete.php\" method=\"post\">"
                                        +"<nav>"
                                        +   "<a href=\"home.html\">"
                                        +       "<img src=\"RateMyLabassets/Logo.png\" alt=\"Georgia State University\" />"
                                        +   "</a>"
                                        +"</nav>"
                                        +"<h1>Add or Delete</h1>"
                                        +"<select name=\"add-delete\" onchange=\"changePage(this.value)\">"
                                        +"  <option value=\"Add\">Add</option>"
                                        +"  <option selected value>Delete</option>"
                                        +"</select>"
                                        +"<p>Please choose a lab to delete</p>"
                                        +"<select name=\"Lab\">"
                                        +"  <option disabled selected value>-- select an option --</option>"
                                        +"  <?php while ($lab = mysqli_fetch_array($all_labs,MYSQLI_ASSOC)):; ?>"
                                        +"  <option value=\"<?php echo $lab["course_name"]; ?>\">"
                                        +"      <?php echo $lab["course_name"]; ?>"
                                        +"  </option>"
                                        +"  <?php endwhile; ?>"
                                        +"</select>"
                                        +"<button type=submit id=enter>Submit</a>"
                                        +"</form>";
            break;
            default:
        }
    }
  </script>

  <body>
    <nav>
      <a href="home.html">
        <img src="RateMyLabassets/Logo.png" alt="Georgia State University" />
      </a>
    </nav>

    <?php if (isset($_GET['error'])) { ?>
      <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>

    <?php if (isset($_GET['success'])) { ?>
      <p class="success"><?php echo $_GET['success']; ?></p>
    <?php } ?>

    <h1>Add or Delete</h1>
    <select name="add-delete" onchange="changePage(this.value)">
        <option disabled selected value>-- select an option --</option>
        <option value="Add">Add</option>
        <option value="Delete">Delete</option>
    </select>

    
  </body>
</html>