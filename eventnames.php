<?php
$servername="localhost";
$username="root";
$password="Ayush@1510";
$database="sampoorna";
$conn= new mysqli($servername,$username,$password,$database);
$Club_id=!empty($_POST['Club_id'])?$_POST['Club_id']:0;
if(!empty($Club_id))
  { $result=mysqli_query($conn,"SELECT EID, Ename from eventt WHERE eventt.ClubID=$Club_id order by eventt.Ename asc");
        if($result->num_rows>0)
  {
     echo "<option value=''>Select Event</option>";
     while($arr= $result->fetch_assoc())
     {
        echo "<option value='".$arr['EID']."'>".$arr['Ename']."</option><br>";
        
      }
   }  
 }
?>