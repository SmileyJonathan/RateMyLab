<?php
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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Submit Form</title>
    <link rel="stylesheet" href="form.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link rel="icon" href="favicon.ico">
    <script
      src="https://kit.fontawesome.com/6df089f401.js"
      crossorigin="anonymous"
    ></script>
  </head>

  <?php
  
  session_start();

  ?>

  <body>
    <nav>
      <a href="home.html">
        <img src="RateMyLabassets/Logo.png" alt="Georgia State University" />
      </a>
    </nav>

    <div class="form-title">Rate <?php echo $_SESSION['course_name'] ?> Section <?php echo $_SESSION ['section_num'] ?></div>

    <?php if (isset($_GET['error'])) { ?>
      <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>

    <hr />
    
    <div class="form">
        <form action="submit_review.php" method="post">
        <div class="date-container">
          <p>Date:</p>
          <input type="date" id="date" name="date"/>
        </div>

        <div class="scale-rate-container">
          <div class="overall-rate">Rate the overall lab</div>
          <div class="scale-contents">
            <div class="scale-col" id="awful">Awful</div>
            <div class="scale-col" id="scale">
              <input type="radio" name="scale1" id="rate5" value="5.0" />
              <label for="rate5" id="five">5</label>
              <input type="radio" name="scale1" id="rate4" value="4.0" />
              <label for="rate4" id="four">4</label>
              <input type="radio" name="scale1" id="rate3" value="3.0" />
              <label for="rate3" id="three">3</label>
              <input type="radio" name="scale1" id="rate2" value="2.0" />
              <label for="rate2" id="two">2</label>
              <input type="radio" name="scale1" id="rate1" value="1.0" />
              <label for="rate1" id="one">1</label>
            </div>
            <div class="scale-col" id="excellent">Excellent</div>
          </div>
        </div>

        <div class="scale-rate-container2">
          <div class="difficulty-rate">Difficulty</div>
          <div class="scale-contents2">
            <div class="scale-col2" id="easy">Very Easy</div>
            <div class="scale-col2" id="scale-2">
              <input type="radio" name="scale2" id="rate5-2" value="5" />
              <label for="rate5-2" id="five-2">5</label>
              <input type="radio" name="scale2" id="rate4-2" value="4" />
              <label for="rate4-2" id="four-2">4</label>
              <input type="radio" name="scale2" id="rate3-2" value="3" />
              <label for="rate3-2" id="three-2">3</label>
              <input type="radio" name="scale2" id="rate2-2" value="2" />
              <label for="rate2-2" id="two-2">2</label>
              <input type="radio" name="scale2" id="rate1-2" value="1" />
              <label for="rate1-2" id="one-2">1</label>
            </div>
            <div class="scale-col2" id="difficult">Very Difficult</div>
          </div>
        </div>
        
        <!--
        <div class="tag-container">
          <div class="tag-title">Tags</div>
          <div class="content">
            <p>Please enter or add a comma after each tag</p>
            <ul>
              <li>Tough Grader <i class="fa-solid fa-xmark"></i></li>
              <li>Pop Quizzes <i class="fa-solid fa-xmark"></i></li>
              <input type="text" />
            </ul>
          </div>
          <div class="details">
            <p><span>8</span> tags are remaining</p>
            <button>Remove All</button>
          </div>
        </div>
        -->

        <div class="comment-container">
          <div class="comment-title">Write a Review</div>
          <div class="instructions">
            Please discuss your experience from taking the lab course.
          </div>
          <div>
            <textarea name="body" id="body" cols="95" rows="25"></textarea>
          </div>
        </div>
        <input type="Submit" id="addComment" value="Submit" name="review"/>
      </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="script.js" type="text/javascript"></script>
  </body>
</html>