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
    <title>Professor Dashboard</title>
    <link rel="stylesheet" href="professor_dash.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="icon" href="favicon.ico">

    <script type="text/javascript"> 
    document.addEventListener('DOMContentLoaded', function() {

        var labDisplayContainer = document.getElementsByClassName("lab-display-container")[0];

        <?php 
        $sql="SELECT * FROM labs WHERE instructor_name='$name'";
        $all_labs = mysqli_query($con, $sql);
        while ($lab = mysqli_fetch_array($all_labs,MYSQLI_ASSOC)):;
        ?>

              labDisplay = document.createElement('div');
              labDisplay.className = 'lab-display';

              //Contains info for and displays name of the lab
              var labName = document.createElement('div');
              labName.className = 'lab-name';
              labName.innerHTML = "<?php echo $lab['course_name'] ?> SECTION <?php echo $lab['section_num'] ?>";
              labDisplay.appendChild(labName);

              //Contains info for and displays the rating of the lab
              var labRating = document.createElement('div');
              labRating.className = 'lab-rating';
              labRating.innerHTML = "<?php echo $lab['avg_rate'] ?>";
              labDisplay.appendChild(labRating);

              var labDifficulty = document.createElement('div');
              labDifficulty.className = 'lab-difficulty';
              labDifficulty.innerHTML = "<?php echo $lab['avg_dif'] ?>";
              labDisplay.appendChild(labDifficulty);

              labDisplayContainer.appendChild(labDisplay);

              var labReviewsHeader = document.createElement('h3');
              labReviewsHeader.className = 'recent-reviews';
              labReviewsHeader.innerHTML = "Recent Reviews";
              labDisplayContainer.appendChild(labReviewsHeader);

              <?php
              $lab_crn = $lab['lab_crn'];
              $query="SELECT * FROM reviews WHERE lab_crn='$lab_crn' ORDER BY date_submitted DESC";
              $all_reviews = mysqli_query($con, $query);
              for ($i = 0; $i < 3; $i++) {
                if ($review = mysqli_fetch_array($all_reviews, MYSQLI_ASSOC)) {
                  ?>
                var mainContainer = document.createElement('div');
                mainContainer.id = "main-container";
                mainContainer.innerHTML = "<div class='student-rating-container'>"
                                         +" <div class='left-panel'>"
                                         +"   <div class='student-rating'>"
                                         +"     <div class='student-rating-number'>"
                                         +"       <?php echo $review['lab_rating']; ?>"
                                         +"     </div>"
                                         +"   </div>"
                                         +" </div>"
                                         +" <div class='right-panel'>"
                                         +"   <div class='diff-date'>"
                                         +"     <div class='difficulty'>"
                                         +"       Difficulty: <?php echo $review['difficulty']; ?>"
                                         +"     </div>"
                                         +"     <div class='date'>"
                                         +"     <?php echo $review['date_submitted']; ?>"
                                         +"     </div>"
                                         +"   </div>"
                                         +"   <div class='student-comment'>"
                                         +"     <?php echo $review['review']; ?>"
                                         +"   </div>"
                                         +" </div>"
                                         +"</div>";
              labDisplayContainer.appendChild(mainContainer);
              <?php } else {
                  break;
                }
              }
              ?>

        <?php endwhile; ?>
    }, false);

    </script>

    <script
      src="https://kit.fontawesome.com/6df089f401.js"
      crossorigin="anonymous"
    ></script>

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
        <h1 id="prof-dash"> Welcome <?php echo $name ?>!</h1>
        <h2 id="latest-courses">Latest Courses</h2>
        
        <div class="lab-display-container">
        
        </div>
        
      </div>
    </div>
  </body>
</html>