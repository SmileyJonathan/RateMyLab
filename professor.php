<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="professor.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link rel="icon" href="favicon.ico">
    <script
      src="https://kit.fontawesome.com/6df089f401.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <form action="plogin.php" method="post">
        <div class="content">
        <div class="img-container">
            <img src="https://raw.githubusercontent.com/CSC4350-TR/RateMyLab/main/RateMyLabassets/Logo.png" alt="Georgia State University" />
        </div>
        <h1>Professor Login</h1>
        <p>Please enter your credentials</p>

        <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
         
        <label>Username</label>

        <input id="username-input" name="user" type="text">
        </input>

        <label>Password</label>

        <input id="password-input" name="password" type="password">
        </input>

        <button type=submit id=login>Login</a>
        </div>
    </form>
  </body>
</html>