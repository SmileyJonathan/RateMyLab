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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <link rel="stylesheet" href="ratemylab.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <script
      src="https://kit.fontawesome.com/6df089f401.js"
      crossorigin="anonymous"
    ></script>

</head>

<form action="ratemylab.php" id="rateForm">

<?php

$lab_crn = $_SESSION['lab_crn'];
$query = "SELECT * FROM labs WHERE lab_crn= '$lab_crn'";
$result = mysqli_query($con, $query);
$lab = mysqli_fetch_assoc($result);

?>


<script type="text/javascript">
    function getSort(val){
        switch(val) {
            case 'Date':
                <?php $sort = "date_submitted"; ?>
                break;
            case 'Rating':
                <?php $sort = "lab_rating"; ?>
                break;
            case 'Difficulty':
                <?php $sort = "difficulty"; ?>
                break;
            default: 
        }
        document.getElementById("rateForm").submit();
    }
</script>

<body>
    <section class="header">
        <nav>
          <a href="home.html">
            <img src="RateMyLabassets/Logo.png" alt="Georgia State University" />
          </a>
        </nav>
    
        <div class="num-rating">
            <div class="num-ratingNumerator">
                <?php echo $lab['avg_rate']; ?>
             </div>
             <div class="num-ratingDenominator">
                 / 5
              </div>
        </div>
        
        <?php if (isset($_GET['error'])) { ?>
            <p class="success"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <div class="lab-course">
            <?php echo $lab['course_name']; ?> Section <?php echo $lab['section_num']; ?>
        </div>

        <div class="tags-header">
            Top Tags:
        </div>

        <div class="tags-container">
            <span class="individual-tags">Tough Grader</span>
            <span class="individual-tags">Pop Quizzes</span>
            <span class="individual-tags">Attendance Mandatory</span>
            <br>
            <span class="individual-tags">Fast Pace</span>
            <span class="individual-tags">Clear Grading Criteria</span>
        </div>

        <a href="form.php" class="button">Rate My Lab</a>

        <div class="num-ratings-sort">
            <div class="num">
                <?php
                    $query = "SELECT COUNT(*) FROM reviews WHERE lab_crn= $lab_crn";
                    $result = mysqli_query($con, $query);
                    $count = mysqli_fetch_assoc($result);
                    echo $count['COUNT(*)'];
                ?> Student Ratings
            </div>
            <div class="sort-container">
                <label>Sort: </label>
                <form action="ratemylab.php" method="post">
                <select name="sort" onchange="getSort(this.value)">
                     <option value="Date">Date</option>
                     <option value="Rating">Rating</option>
                     <option value="Difficulty">Difficulty</option>
                </select>
                </form>
            </div>
        </div>

        <hr>
        <?php
            $sql = "SELECT * FROM reviews WHERE lab_crn=$lab_crn ORDER BY $sort";
            $all_reviews = mysqli_query($con, $sql);
		    while ($review = mysqli_fetch_array($all_reviews,MYSQLI_ASSOC)):;
	  	?>	
            <div id="main-container">
                <div class='student-rating-container'>
                    <div class='left-panel'>
                        <div class='student-rating'>
                            <div class='student-rating-number'>
                                <?php echo $review['lab_rating']; ?>
                            </div>
                        </div>
                    </div>
                    <div class='right-panel'>
                        <div class='diff-date'>
                            <div class='difficulty'>
                                Difficulty: <?php echo $review['difficulty']; ?>
                            </div>
                            <div class='date'>
                            <?php echo $review['date_submitted']; ?>
                            </div>
                        </div>
                        <div class='student-comment'>
                            <p>
                                <?php echo $review['review']; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="script.js" type="text/javascript"></script>
    </section>
</body>
</form>
</html>