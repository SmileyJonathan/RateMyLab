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

if (isset($_POST['user']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $uname = validate($_POST['user']);

    $pass = validate($_POST['password']);

    if (empty($uname)) {

        header("Location: admin.php?error=User Name is required");

        exit();

    }else if(empty($pass)){

        header("Location: admin.php?error=Password is required");

        exit();

    }else{

        $sql = "SELECT * FROM admins WHERE username ='$uname' AND password='$pass'";

        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['username'] === $uname && $row['password'] === $pass) {

                echo "Logged in!";

                $_SESSION['user_name'] = $row['user_name'];

                $_SESSION['name'] = $row['name'];

                $_SESSION['id'] = $row['id'];

                header("Location: admin-dash.html");

                exit();

            }else{

                header("Location: admin.php?error=Incorect User name or password");

                exit();

            }

        }else{

            header("Location: admin.php?error=Incorect User name or password");

            exit();

        }

    }

}else{

    header("Location: admin.php");

    exit();

}