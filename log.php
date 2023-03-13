<?php
session_start();
$servername1 = "localhost";
  $username1 = "root";
  $password1 = "Ayush@1510";
  $databasename1 = "login";

  $conn1 = new mysqli($servername1, $username1, $password1, $databasename1);
  if($conn1->connect_error){
    die("Connection Failed:" .$conn1->connect_error);

  }

 if(isset($_POST['uname']) && isset($_POST['psw']))
{
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
$u="Sampoorna_iips";
$p="Sam@22";
$uname = validate("$u");
$pass = validate("$p");
    $sql = "select * from user where user.user_id='$uname' ";
    $result= mysqli_query($conn1, $sql);
    
    if(mysqli_num_rows($result) === 1)
    {
        $row = mysqli_fetch_assoc($result);
        if($row['user_id'] === $uname && $row['e_pass'] === $pass){
            echo "logged in";
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['e_pass'] = $row['e_pass'];
            header("location: Add Club .php");
            exit();
        }else{
            header("location: sampoorna.php?error=Incorrect User Name or password");
            exit();
        }
    }   else 
    {
         header("Location:sampoorna.php?error=incorrect User name or Password");
         exit();
    }
}

?>