<?php

include ("dbconnect.php");
?>
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
     <script src="jquery-3.6.2.min.js" lang="javascript"></script>
      </head>

        <body>
            

<?php $Club_id=!empty($_POST['Club_id'])?$_POST['Club_id']:0;
$Event_id=!empty($_POST['Event_id'])?$_POST['Event_id']:0;
$sql32=mysqli_query($conn,"select DID,Heading_of_description as H,Body as B from event_description where event_description.ClubID=$Club_id and event_description.EventID=$Event_id");

if(mysqli_num_rows($sql32)>0)
{
    while($r=mysqli_fetch_assoc($sql32))
{
    
    echo "<div id='".$r['H']."'> 
     <h1 class='responsive-font-example' >".$r['H']."</h1>
     </div>
   
     <div class='responsive-font-example' id='".$r['DID']."'>

    ".$r['B']."
    </div>";
}
}
?>
<div><h2 class="responsive-font-example" style="text-align: center;">Image Gallary</h2></div>
<?php  
$sql56= mysqli_query($conn,"select * from event_pics where event_pics.ClubID=$Club_id and event_pics.EventID=$Event_id");
if(mysqli_num_rows($sql56)>0):
?>
<div class="container">
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
  <?php while($i=mysqli_fetch_assoc($sql56)):?>
    <div class="carousel-item active">
      <img src="./image/<?php echo $i['pic_path']; ?>" class="d-block w-100" alt="...">
    </div>
    <?php endwhile; ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>




     <?php
     //endwhile;
    endif;
    ?>
   
</body>
</head>
</html>