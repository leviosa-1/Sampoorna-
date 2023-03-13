<?php
session_start();
include ('dbconnect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sampoorna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="https://kit.fontawesome.com/b0d7f05cd1.js" crossorigin="anonymous"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="image/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="image/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="image/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="image/favicon_io/site.webmanifest">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="new_css.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
     <script src="jquery-3.6.2.min.js" lang="javascript"></script>
     <script lang="javascript">
      document.onmousedown=disableclick;
status="Right Click Disabled";
function disableclick(event)
{
  if(event.button==2)
   {
     alert(status);
     return false;    
   }
}
     </script>
<script lang="javascript">
  $(document).on('change','#clubname', function(){
      var ClubID = $(this).val();
      if(ClubID){
          $.ajax({
              type:'POST',
              url:'eventnames.php',
              data:{'Club_id':ClubID},
              success:function(result){
                  $('#events').html(result);
                 }
          }); 
      }else{
          $('#events').html('<option value="">Club</option>');
         
  }});
   $(document).on('click','#Show_Info',function(){
    var ClubID1=$('#clubname').val();
    var EventID1=$('#events').val();
    if(ClubID1!=="0")
    {if(ClubID1&&EventID1)
    { $.ajax({
              type:'POST',
              url:'Eventdata.php',
              data:{'Club_id':ClubID1,'Event_id':EventID1},
              success:function(result){
                  $('#data').html(result);
                 }
          });}
    else{
        $.ajax({
              type:'POST',
              url:'Clubdata.php',
              data:{'Club_id':ClubID1},
              success:function(result){
                  $('#data').html(result);
                 }
          });
    }
        }
 
   });
var x;
 function SHOWINFO(x){var Club_id =x;
  $('#clubname').val(x);
         $.ajax({
              type:'POST',
              url:'eventnames.php',
              data:{'Club_id':x},
              success:function(result){
                  $('#events').html(result);
                 }
          }); 
             $.ajax({
              type:'POST',
              url:'Clubdata.php',
              data:{'Club_id':Club_id},
              success:function(result){
                  $('#data').html(result);
                 }
          });}
</script>


</head>
<body> 
  
      
    <header class="parallax">
        
      <h1 class="responsive-font-example" class="gradient-text"> International Institue of Professional Studies</h1>    
      <h1 class="responsive-font-example" class="gradient-text"style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; ">SAMPOORNA CLUBS IIPS (DAVV)</h1>
      <h5 class="responsive-font-example" class="gradient-text" >Visions are realized under multiple eyes </h5>
      <a  href="http://www.iips.edu.in/"><img style=" border-radius: 10px 10px;box-shadow: 5px 5px 15px 5px black;" height="auto" src="./image/iips_logo.png" alt="iips_logo"></a>
      
    </header>
    <nav>
        <a class="responsive-font-example" href="Sampoorna.php" title="Sampoorna | Home"> Home </a>
        <a class="responsive-font-example" href="http://www.iips.edu.in/" title="Go to iips official website" target="_blank"> iips|Home </a>
        <a class="responsive-font-example" href="#about"> About </a>
        <a class="responsive-font-example" href="#event"> Clubs</a>
        <a class="responsive-font-example" href="#contect"> Contact</a>
        <a class="responsive-font-example" target="_blank" href="https://docs.google.com/forms/d/e/1FAIpQLSfLJfeMInfLFwEb2i-o9l88tmwN4L20k-bsvp8VuY9MSMb0TQ/viewform">Registration</a>
        <?php
        if(isset($_SESSION['e_pass']) && isset($_SESSION['user_id'])):
        ?>
        <a  onclick="" href="logout.php">Log-out</a>
        <?php else: ?>
        <a  onclick="document.getElementById('id01').style.display='block'" href="#id01">Log-in</a>
        <?php endif; ?>
        </nav>

<div id="id01" class="modal">
  
  <form class="modal-content animate"  action="Add Club.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
  
    </div>

    <div>
      <label for="uname" style="font-size: large;"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw" style="font-size: large;"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
    </div>

    <div class="cont" style="background-color:#f1f1f1">
      <button type="submit" style="background-color: green;" class="cancelbtn">Login</button>
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

</script>


    
        <main>
         
        <div class="container">
        <section class="responsive-font-example">
            <div class="responsive-font-example" >
            <h1 class="responsive-font-example" id="about"><b> Sampoorna Clubs </b></h1>
              <div  class="responsive-font-example" class="sampoorna" >
                  <h4 class="responsive-font-example">
                    <b>“Sampoorna” (संपूर्ण) : </b> originates from the Sanskrit word for complete, abundant, or bountiful.
               It is a platform where a range of extracurricular and curricular activities are organized
              by students and supervised by academic professionals to enhance student's overall development.
              <br>
              <br>

              It was established by the International Institute of Professional Studies (IIPS), DAVV, core committee and will serve as a focal point for the different groups at the campus to provide students with insightful information. <br>
              Its an approach that ensures participation from all programs and students, a development that will promote the institution and its student's growth.
                
              <br> <br>
             It allows students to demonstrate their abilities in various domains through cooperation and teamwork and encourages them to seek innovation and originality.
              </div>
              </h4> 

             </div>
             <br>
             <div>
               <img class="slideshow-container" height="auto"  width="auto" style="border-radius: 20px;box-shadow: 5px 5px 15px 5px gray; " src="image/sampoorna.png" alt="">
             </div>   
           <br>
           <div><h2 class="responsive-font-example"><b> Image Gallary </b></h2></div>
        
           <?php  
$sql56= mysqli_query($conn,"select * from event_pics order by Sno desc");
if(mysqli_num_rows($sql56)>=3):
  $j=1;
  while($i=mysqli_fetch_assoc($sql56)):
?>
           <div style="width:100%; height:100%" class="slideshow-container" id="galary">
          
          <div class="mySlides fade">
            <div class="numbertext"><?php echo $j; ?> / 3</div>
            <img src="./image/<?php echo $i['pic_path']; ?>" style="width:100%; height:100%">
          </div>
 <?php $j++;
 if($j===4)
 { break; }
 endwhile;
?>

          <br>
          
          <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span> 
            <span class="dot" onclick="currentSlide(2)"></span> 
            <span class="dot" onclick="currentSlide(3)"></span> 
          </div>
           </div>
  <?php endif; ?>  
              
              <script>
                  let slideIndex = 0;
                  showSlides();
                  
                  function showSlides()
                  {
                    let i;
                    let slides = document.getElementsByClassName("mySlides");
                    let dots = document.getElementsByClassName("dot");
                    for (i = 0; i < slides.length; i++) {
                      slides[i].style.display = "none";  
                    }
                    slideIndex++;
                    if (slideIndex > slides.length) {slideIndex = 1}    
                    for (i = 0; i < dots.length; i++) {
                      dots[i].className = dots[i].className.replace(" active", "");
                    }
                    slides[slideIndex-1].style.display = "block";  
                    dots[slideIndex-1].className += " active";
                    setTimeout(showSlides, 2000); // Change image every 2 seconds
                  }
                  </script> 
       
         </section>
             <br>
             <br>
             <br>

       
        <section class="responsive-font-example" class="table">   
          <h2 class="responsive-font-example" >Club Details</h2>
            <table  style="overflow: scroll;">
                <tr>
                    <th class="responsive-font-example" style="text-align: center;">S.No</th>
                    <th class="responsive-font-example" style="text-align: center;">clubs</th>
                    <th class="responsive-font-example" style="text-align: center;">Mentors</th>
                    <th class="responsive-font-example" style="text-align: center;">Club logo</th>
                </tr>
                <?php
                $sql33=mysqli_query($conn,"select * from club order by club.Cname asc");
                if(mysqli_num_rows($sql33)>0)
                { $SNO=1;
                  while($ct=mysqli_fetch_assoc($sql33))
                 {$sql34=mysqli_query($conn,"select * from club_master,faculty where club_master.MID=faculty.FID and club_master.ClubID={$ct['CId']}");
                  
                  echo "<tr>
                    <td>".$SNO.".</td>
                    <td>".$ct['Cname']."</td>
                    <td>";
                 while($cm=mysqli_fetch_assoc($sql34))
                    {echo $cm['Fname']."<br/>";}
                echo  "</td><td><div onClick='SHOWINFO(".$ct['CId'].")'><a href='#data'><img src='./image/".$ct['club_logo']."' width='100' height='100'></a></div></td>
                </tr>";
                $SNO++;}
                }
                ?>
            </table>
        
            <br>
          

            
            <br>
            
              <!-- HTML !-->
         
            
            
        <div class="events" id="event">
            <h3 class="responsive-font-example">To know more about the clubs and the events organised by the clubs select club name to get data.</h3>
            <form class="responsive-font-example" name="form1" id="form1" action="">
<?php if($conn){
    $sql21=mysqli_query($conn,"select * from club order by club.Cname asc");
    if(mysqli_num_rows($sql21)>0)
    {
?>
		<label class="responsive-font-example" class="" for="clubname">Select Club Name:</label>
        <select name="clubname" id="clubname">
       <option value="0" selected="selected">Please select club name</option>
    <?php
    while($club1=mysqli_fetch_assoc($sql21)):;
    ?>
    <option class="responsive-font-example" value="<?php echo $club1['CId'];?>">
    <?php  echo $club1['Cname'];?>
    </option><br/><br/>
    <?php
    endwhile;
}
}
?></select>
  <br><br>
<label class="responsive-font-example" for="event" >Event:</label> 
<select name="events" id="events">
  <option class="responsive-font-example" value="" selected="selected">Please select club first</option>
  </select>
  <br><br>
  <input type="button" value="Show Info" name="Show_Info" id="Show_Info">


            </form>
             
            
    
<div  class="responsive-font-example" class="club" style="height:auto;"  id="data">

</div>
                     


            <div style="background-size: 100% auto;">
              <hr class="hr">
                <h1 class="responsive-font-example">CLUBS UNDER SAMPOORNA</h1>
                
             <marquee behavior="loop" direction="left">
                <img class="zoom" src="image/Yoga and Fitness_logo.jpg" alt="" width="100" height="100" >
                <img class="zoom" src="image/finance.jpg" alt="Finance club" width="100" height="100">
                <img class="zoom" src="image/marketing.jpg" alt="marketing club" width="100" height="100">
                <img class="zoom" src="image/hr.jpg" alt="HR club" width="100" height="100">
                <img class="zoom" src="image/enterprenurship.jpg" alt="Enterpreneurship Cell" width="100" height="100">
                <img class="zoom" src="image/commerce.jpg" alt="Commerce club" width="100" height="100">
                <img class="zoom" src="image/advertisment.jpg" alt="Advertising & PR Club" width="100" height="100">
                <img class="zoom" src="image/tourism.jpg" alt="Tourism Club" width="100" height="100">
                <img class="zoom" src="image/computer.jpg" alt="Computing Club" width="100" height="100">
                <img class="zoom" src="image/coding.jpg" alt="Coading Club" width="100" height="100">
             </marquee>
             <hr class="hr">
                <marquee behavior="loop" direction="right">
                 <img class="zoom" src="image/ai.jpg" alt="AI & Robotics club" width="100" height="100">
                 <img class="zoom" src="image/business.jpg" alt="Business Analytical club" width="100" height="100">
                 <img class="zoom" src="image/student_research.jpg" alt="student_research Cell" width="100" height="100">
                 <img class="zoom" src="image/litrary.jpg" alt="Litrary Club" width="100" height="100">
                 <img class="zoom" src="image/finearts.png" alt="Fine arts club" width="100" height="100">
                 <img class="zoom" src="image/performing .jpg" alt="Performing Arts & Theartre Club" width="100" height="100">
                 <img class="zoom" src="image/photography.jpg" alt="Photography club " width="100" height="100">
                 <img class="zoom" src="image/env.jpg" alt="Environment Club" width="100" height="100">
                 <img class="zoom" src="image/setu.jpg" alt="Social Connect Club" width="100" height="100">
                 <img class="zoom" src="image/festival.jpg" alt="Festival Club" width="100" height="100">
                </marquee>
            </div>
             
        </section>

        <br>
        <div class="yamini">
           
           <h3 style="color: white;">
   <head style="text-overflow: clip; font-style: italic; font-family: 'Times New Roman', Times, serif;">
     
   </head>              
   
     <head style="text-align: left; text-underline-position: above;"> 
        <b class="responsive-font-example">Core-committe of sampoorna Club </b>                  
 </head>             
     <br>
     Faculty Mentors:
   <ul class="responsive-font-example">
       Dr.Yamini Karmarkar
      | Mr.yogendra Singh Bawal
      | Mr.Basant Namdeo
      | Mr. Sanjay Narsinghani
      | Mr.Almas Nabi
   </ul>
      
   <br>
     
     <br>
     <b class="responsive-font-example">  student support team</b>
     <ul class="responsive-font-example">
        Himanshu Seroke
       | Aditi Singh Bhilware
       | Ishana Dashoriya
       | Sourav Bhatia 

     </ul>
    

</h3>         
</div>
 </div>
       
  
    </main>
    <div class="container">
    <footer>
        <a class="responsive-font-example" href="#">FAQ</a>
        <a class="responsive-font-example" href="#">Terms of Use</a>
        <a class="responsive-font-example" href="privacy.php">Privacy Policy</a>
        <a class="responsive-font-example" href="Sampoorna.php">&copy; 2023 | Sampoorna clubs</a>
        <a class="responsive-font-example" href="team.php"> About Developers</a>
        <br>
    </footer>
      
         <div class="hero" id="contect">
            <h1>Contact Us</h1>
            <div class="social-links">
                <a href="https://facebook.com" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://www.youtube.com/channel/UCEgynqpTF1ZAisYUrKnOgZg" target="_blank"><i  class="fa-brands fa-youtube"></i></a>
                <a href="#" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                <a href="sampoorna.iips@iips.edu.in" target="_blank"><i class="fa-brands fa-at"></i></a>
                <a href="https://www.instagram.com/sampoorna.iips/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
      
        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
   
         <h4 class="responsive-font-example"> <bold>Copyright  <span>&#169</span> 2023 SAMPOORNA CLUB IIPS (DAVV). All Rights Reserved.</bold></h4>
         
         </div>
    </div>
   
  
</body>
</html>