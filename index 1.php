<?php
include("footer.php");
include("header.php") ; 
  $servername = "localhost";
  $username = "root";
  $password = "Ayush@1510";
  $databasename = "sampoorna.sql";
  
  // CREATE CONNECTION
  $conn = new mysqli($servername,
    $username, $password, $databasename);
  
  // GET CONNECTION ERRORS
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  
  // SQL QUERY
  $query = "SELECT * FROM `select * from sampoorn.club;`";
  
  // FETCHING DATA FROM DATABASE
  $result = $conn->query($query);
  
    if ($result->num_rows > 0) 
    {
        // OUTPUT DATA OF EACH ROW
        while($row = $result->fetch_assoc())
        {
            echo "CId: " .
                $row["CId"]. " - Cname: " .
                $row["Cname"]. " | Formation_date: " ;
        }
    } 
    else {
        echo "0 results";
    }
  
   $conn->close();
  
?>