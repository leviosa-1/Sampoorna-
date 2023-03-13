<?php
session_start();
include ('dbconnect.php');
?>
<?php

if(isset($_POST['uname']) && isset($_POST['psw']))
{
    function validate($data) 
    { 
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

  $uname = validate($_POST['uname']);
  $pass = validate($_POST['psw']);


    $sql = "select * from user where user.user_id='$uname' and user.e_pass='$pass'";
    $result= mysqli_query($conn1, $sql);
    
   if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['e_pass'] = $row['e_pass'];
			
   }
        else
		{
            header("location: sampoorna.php?error=Incorrect User Name or password");
            exit();
        }
    } 
else{
    header("Location:Sampoorna.php");
    exit();
}

if(isset($_SESSION['e_pass']) && isset($_SESSION['user_id'])):

   //unset($_SESSION['e_pass']); 
   //unset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="new_css.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="https://kit.fontawesome.com/b0d7f05cd1.js" crossorigin="anonymous"></script>
<style>
	#form{
		width:29%;
        height:auto;
		float:left;
	
	}
	#ctable{
		width:69%;
		float:right;
		border-radius: 20px;
		box-shadow: 5px 5px 15px 5px gray;
        height:auto;
        padding-bottom:20px;
        }
</style>
<script src="jquery-3.6.2.min.js" lang="javascript"></script>
<script lang="javascript">
function clubtable(){var Club_id =101;
             $.ajax({
              type:'POST',
              url:'clubtable.php',
              data:{'Club_id':Club_id},
              success:function(result){
                  $('#ctable').html(result);
                 }
          });}
          
$(document).on('click','#AddC',function(){$.ajax({
              type:'POST',
              url:'clubform.php',
              success:function(result){
                  $('#ctable').html(result);
                 }
          });});
$(document).on('click','#AddE',function(){$.ajax({
              type:'POST',
              url:'AddETEC.php',
              success:function(result){
                  $('#ctable').html(result);
                 }
          });});
 $(document).on('click','#UpdateE',function(){$.ajax({
              type:'POST',
              url:'Eventtable.php',
              success:function(result){
                  $('#ctable').html(result);
                 }
          });});
function UPDATE(x){
            var Club_id=x; 
              $.ajax({
              type:'POST',
              url:'Update Club.php',
              data:{'ClubID':Club_id},
              success:function(result){
                  $('#ctable').html(result);
                 }
          });}
 function UPDATEE(x,y){
            var Club_id=x; 
            var Event_id=y;
              $.ajax({
              type:'POST',
              url:'Update Event.php',
              data:{'ClubID':Club_id,
                    'EventID':Event_id},
              success:function(result){
                  $('#ctable').html(result);
                 }
          });}
          $(document).on('click','#finish',function(){
        $.ajax({
              type:'POST',
              url:'clubtable.php',
              success:function(result){
                  $('#ctable').html(result);
                 }
          });});
          function RemoveEP(x,y,z,l){var w="EP";
            var result=confirm("Are you sure you want to delete this Picture!");
            if(result)
              {$.ajax({
              type:'POST',
              url:'Delete.php',
              data:{'ClubID':x,
                     'EventID':y,
                    'PID':z,
                    'pic_path':l,
                   'Type':w},
            success:function(result){
              alert('Deleted Successfully');
              $.ajax({
              type:'POST',
              url:'Update Event.php',
              data:{'ClubID':x,
                    'EventID':y},
              success:function(result){
                  $('#ctable').html(result);
                 }
          });
              }
          });}}
          function RemoveOF(x,y,z){var w="OF";
            var result=confirm("Are you sure you want to delete this Organizing Faculty!");
            if(result)
              {$.ajax({
              type:'POST',
              url:'Delete.php',
              data:{'ClubID':x,
                     'EventID':y,
                    'OrgID':z,
                   'Type':w},
            success:function(result){
              alert('Deleted Successfully');
              $.ajax({
              type:'POST',
              url:'Update Event.php',
              data:{'ClubID':x,
                    'EventID':y},
              success:function(result){
                  $('#ctable').html(result);
                 }
          });
              }
          });}}
          function RemoveCO(x,y,z){var w="CO";
            var result=confirm("Are you sure you want to delete this Coordinating Student!");
            if(result)
              {$.ajax({
              type:'POST',
              url:'Delete.php',
              data:{'ClubID':x,
                     'EventID':y,
                    'COID':z,
                   'Type':w},
            success:function(result){
              alert('Deleted Successfully');
              $.ajax({
              type:'POST',
              url:'Update Event.php',
              data:{'ClubID':x,
                    'EventID':y},
              success:function(result){
                  $('#ctable').html(result);
                 }
          });
              }
          });}}
          function RemoveG(x,y,z){var w="G";
            var result=confirm("Are you sure you want to delete this Guest!");
            if(result)
              {$.ajax({
              type:'POST',
              url:'Delete.php',
              data:{'ClubID':x,
                     'EventID':y,
                    'SID':z,
                   'Type':w},
            success:function(result){
              alert('Deleted Successfully');
              $.ajax({
              type:'POST',
              url:'Update Event.php',
              data:{'ClubID':x,
                    'EventID':y},
              success:function(result){
                  $('#ctable').html(result);
                 }
          });
              }
          });}}
          function RemoveED(x,y,z){var w="ED";
            var result=confirm("Are you sure you want to delete this Description!");
            if(result)
              {$.ajax({
              type:'POST',
              url:'Delete.php',
              data:{'ClubID':x,
                     'EventID':y,
                    'DID':z,
                   'Type':w},
            success:function(result){
              alert('Deleted Successfully');
              $.ajax({
              type:'POST',
              url:'Update Event.php',
              data:{'ClubID':x,
                    'EventID':y},
              success:function(result){
                  $('#ctable').html(result);
                 }
          });
              }
          });}}
          $(document).ready(function(){
$("#f4").on("submit",function(e){
    e.preventDefault();
    var Club_id=$('#clubname').val();
     
     $.ajax({  
              type:'POST',
              url:'Update Club.php',
              data:{'ClubID':Club_id},
              success:function(result){
                  $('#ctable').html(result);
                 }
          });
          });});
$(document).on('click','#cancel1',function(){$.ajax({
              type:'POST',
              url:'clubtable.php',
              success:function(result){
                  $('#ctable').html(result);
                 }
          });});
$(document).ready(function(){
$("#f5").on("submit",function(e){
    e.preventDefault();
    var fd = new FormData(this);
    $.ajax({  
              url:'Finishclubupdate.php',
              type:'POST',
              data:fd,
              contentType:false,
              processData:false,
              success:function(result){
                  $('#ctable').html(result);
                 }
          });
    
          });});
          

</script>
</head>
<body onload='clubtable()'>
<header class="parallax">
        
        <h1>International Institue of Professional Studies</h1>
      <h1>SAMPOORNA CLUBS IIPS (DAVV)</h1>
      <h5>Visions are realized under multiple eyes </h5>
      <a href="http://www.iips.edu.in/"><img style=" border-radius: 10px 10px;box-shadow: 5px 5px 15px 5px black;" height="auto"  src="./image/iips_logo.png" alt="iips_logo"></a>
      
    </header>
    <nav>
        <a href="Sampoorna.php" title="Sampoorna | Home"> Home </a>
        <a href="http://www.iips.edu.in/" title="Go to iips official website" target="_blank"> collage review </a>
        <a href="#about"> About </a>
        <a href="#event"> clubs</a>
        <a href="#contect"> contact</a>
        <a  onclick="" href="logout.php">Log-out</a>
    </nav><br/><br/>
<center>
<div class="container" id="outerDiv" class="container" style="height:auto;width:70%; padding-bottom:20px;"><br/>
<div class="col-xs-12 col-md-4" id="form">
<ul type="none" class="sidebar-menu" style="float:left;width:85%;">
<li class="sidebar-header" style="color:white;background-color:#0b3262; border:1px solid black;cursor:pointer;"><b><h3>Menu</h3></b></li>
<li class="sidebar-header" id="AddC"style="color:white;background-color:orange; border:1px solid black;cursor:pointer;"><h4>Add Club</h4></li>
<li class="sidebar-header"id="AddE"style="color:#0b3262;background-color:white; border:1px solid black;cursor:pointer;"><h4>Add Event</h4></li>
<li class="sidebar-header"id="UpdateE" style="color:white;background-color:green; border:1px solid black;cursor:pointer;"><h4>Update Event</h4></li>
</ul>
<br/></div>
<div id="ctable"class="col-xs-4 col-md-8 table-responsive" style="border-radius: 20px;box-shadow: 5px 5px 15px 5px gray;">

</div><br/>
</div></center>
<div>
</div>    
    <div class="container"><br/><br/>
   <footer>
        <a href="#">FAQ</a>
        <a href="#">Terms of Use</a>
        <a href="privacy.php">Privacy Policy</a>
        <a href="Sampoorna.php">&copy; 2023 | Sampoorna clubs</a>
        <a href="team.php"> About Developers</a>
        <br>
    </footer>
       
         <div class="hero" id="contect">
            <h1>Contact Us</h1>
            <div class="social-links">
                <a href="https://facebook.com" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://www.youtube.com/channel/UCEgynqpTF1ZAisYUrKnOgZg" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                <a href="#" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                <a href="#" target="_blank"><i class="fa-brands fa-at"></i></a>
                <a href="https://www.instagram.com/sampoorna.iips/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
         <h4> <bold>Copyright  <span>&#169</span> 2023 SAMPOORNA CLUB IIPS (DAVV). All Rights Reserved.</bold></h4>
         
      
    </footer>
			</div>
            <?php 
                   endif;
            ?>
</body>
</html>