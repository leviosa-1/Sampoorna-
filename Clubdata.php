<?php
$servername="localhost";
$username="root";
$password="Ayush@1510";
$database="sampoorna";
$conn= new mysqli($servername,$username,$password,$database);?>
<html>
 <head>
     <link rel="stylesheet" href="style.css">
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
 </head>   
</html>
<?php
$Club_id=!empty($_POST['Club_id'])?$_POST['Club_id']:101;
$sql32=mysqli_query($conn,"select DID,Heading_of_description as H,Body as B from club_description where club_description.ClubID=$Club_id");
if(mysqli_num_rows($sql32)>0)
{
    while($r=mysqli_fetch_assoc($sql32))
{
    
    echo "<div class='responsive-font-example' class='club' id='".$r['H']."'> 

    <h1 class='responsive-font-example' >".$r['H']."</h1>
    
     
     <br>
    ".$r['B']."
   
    </div>"
    ;

}

}

?>