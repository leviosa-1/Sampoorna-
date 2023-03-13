<?php
    $servername = "localhost";
    $username = "root";
    $password = "Ayush@1510";
    $databasename = "sampoorna";
    
    // CREATE CONNECTION
    $conn = new mysqli($servername, $username, $password, $databasename);
     // GET CONNECTION ERRORS
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

  $servername1 = "localhost";
  $username1 = "root";
  $password1 = "Ayush@1510";
  $databasename1 = "login";

  $conn1 = new mysqli($servername1, $username1, $password1, $databasename1);

  if($conn1->connect_error){
    die("Connection Failed:" .$conn1->connect_error);

  }
  
  
 
?>
