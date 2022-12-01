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

$name = $_SESSION['name'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="professor_dash.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />


    <script type="text/javascript"> 
    document.addEventListener('DOMContentLoaded', function() {

        var labDisplayContainer = document.getElementsByClassName("lab-display-container")[0];

        <?php 
        $sql="SELECT * FROM labs WHERE instructor_name='$name'";
        $all_labs = mysqli_query($con, $sql);
        while ($lab = mysqli_fetch_array($all_labs,MYSQLI_ASSOC)):;
        ?>
            var i = 0;

            labDisplayContainer[i] = document.createElement('div');
            labDisplayContainer[i].className = 'lab-display';

            //Contains info for and displays name of the lab
            var labName = document.createElement('div');
            labName.className = 'lab-name';
            labName.innerHTML = "<?php> echo $lab['course_name'] ?> SECTION <?php> echo $lab['section_num'] ?>";
            labDisplayContainer[i].appendChild(labName);
        
            //Contains info for and displays the rating of the lab
            var labRating = document.createElement('div');
            labRating.className = 'lab-rating';
            labRating.innerHTML = "<?php> echo $lab['avg_rate'] ?>" 
            labDisplayContainer[i].appendChild(labRating);

            var labDifficulty = document.createElement('div');
            labDifficulty.className = 'lab-difficulty';
            labDifficulty.innerHTML = "<?php> echo $lab['avg_dif'] ?>";
            labDisplayContainer[i].appendChild(labDifficulty);

        <?php endwhile; ?>
    }, false);

    </script>

  </head>
  <body>
    <div class="content">
      <div class="header-container">
        <div class="img-container">
          <img src="https://raw.githubusercontent.com/CSC4350-TR/RateMyLab/main/RateMyLabassets/Logo.png" alt="Georgia State University"/>
        </div>
        <div class="empty-container">
        </div>
      </div>
      <div class="info-container">
        <h1 id="prof-dash"> Welcome <?php echo $_SESSION['name'] ?>!</h1>
        <div class="graphics-container">
          <img src="https://cdn.kastatic.org/ka-perseus-graphie/6fc87b09f1fd082b8939b6425bef6a1d5397e532.svg" alt="bar chart" id='bar-chart'>
          <img src="https://diagrammm.com/img/diagrams/pie-chart.svg" alt="pie chart" id='pie-charts'>
        </div>
        <h2 id="latest-courses">Latest courses</h2>
        
        <div class="lab-display-container">
        
        </div>
        
      </div>
    </div>
  </body>
</html>