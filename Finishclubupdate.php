<?php
session_start();
if(isset($_SESSION['e_pass']) && isset($_SESSION['user_id'])):
   include ('dbconnect.php');

?>
<!DOCTYPE html>
<html>
<head>
<?php

if($conn){

    if($_POST['uclubname']!==""){
      if($_SESSION['logo']===1){
        $uname=mysqli_real_escape_string($conn,$_POST['uclubname']);
        $udate=$_POST['uformation_date'];
       $sql51=mysqli_query($conn,"select club_logo,SUBSTRING(club_logo,-3,3) as ext from club where club.CId='{$_SESSION['clubID']}'");
        $r4=mysqli_fetch_assoc($sql51);
        $ext=$r4['ext'];
        $old_name=$r4['club_logo'];
       $new_name=$uname."_logo.".$ext;
       $oldfolder="./image/".$old_name;
       $newfolder="./image/".$new_name;
       rename($oldfolder,$newfolder);
          $sql37="update club set club.Cname='$uname',club.Formation_date='$udate',club.club_logo='$new_name' where club.CId={$_SESSION['clubID']}";
          $stmt=$conn->prepare($sql37);
          $stmt->execute(); 
      }
    else{  
    $filename=mysqli_real_escape_string($conn,$_FILES["uimage"]["name"]);
    if($filename!=="")
    {$tempname=$_FILES["uimage"]["tmp_name"];
    $extension=pathinfo($filename,PATHINFO_EXTENSION);
    $uname=mysqli_real_escape_string($conn,$_POST['uclubname']);
    $udate=mysqli_real_escape_string($conn,$_POST['uformation_date']);
    $new_name=$uname."_logo.".$extension;
    $folder="./image/".$new_name;
      $sql37="update club set club.Cname='$uname',club.Formation_date='$udate',club.club_logo='$new_name' where club.CId={$_SESSION['clubID']}";
      $stmt=$conn->prepare($sql37);
      $stmt->execute();
      move_uploaded_file($tempname,$folder);}}
        for ($i=0;$i<count($_POST['uDID']); $i++){
          $DID=101+$i;
          $_SESSION["desc_head"]=mysqli_real_escape_string($conn,$_POST['uDesc_head'][$i]);
          $_SESSION["Description"]=mysqli_real_escape_string($conn,$_POST['uDescription'][$i]); 
       if($DID<=101+$_SESSION['storedcdesc'])
        {if($_SESSION["desc_head"]!==""&&$_SESSION["Description"]!=="")
           {$sql25="update Club_description set club_description.Heading_of_description='{$_SESSION['desc_head']}',club_description.Body='{$_SESSION['Description']}' where club_description.ClubID={$_POST['CID']} and club_description.DID=$DID";
        $stmt=$conn->prepare($sql25);
        $stmt->execute();}}
       else{if($_SESSION["Description"]!==''){
       $sql="INSERT INTO Club_description VALUES ('{$_SESSION['clubID']}',$DID,'{$_SESSION['desc_head']}','{$_SESSION['Description']}')";
       $stmt=$conn->prepare($sql);
       $stmt->execute();
       //echo '<div class="alert alert-success" role="alert">Submitted Successfully</div>';
    }
    else{
        echo '<div class="alert alert-danger" role="alert">Description cannot be left blank</div>';
      }}
       
       }
       for ($i=0;$i<count($_POST['uFID']); $i++){
        $_SESSION["Master"]=mysqli_real_escape_string($conn,$_POST['uMaster'][$i]);
     if($_SESSION["Master"]!==''){
    $sql1="select * from faculty where faculty.Fname='{$_SESSION['Master']}'";
    $check=$conn->query($sql1);
  if($check)
   {if(mysqli_num_rows($check)>0)
    {$r1=mysqli_fetch_assoc($check);
     $MID=$r1['FID'];
     $sql2="INSERT INTO Club_master VALUES ('{$_SESSION['clubID']}',$MID)";
     $stmt=$conn->prepare($sql2);
     $stmt->execute();}
   else{
     $sql3="INSERT INTO faculty(Fname) VALUES ('{$_SESSION['Master']}')";
     $stmt=$conn->prepare($sql3);
     $stmt->execute();
     $_SESSION["lastfid"]=mysqli_insert_id($conn);
     $sql4="INSERT INTO Club_master VALUES ('{$_SESSION['clubID']}','{$_SESSION['lastfid']}')";
     $stmt=$conn->prepare($sql4);
     $stmt->execute();
     }}}
     else{
           echo '<div class="alert alert-danger" role="alert">Managing Faculty Name cannot be left blank</div>';
         }
     }

       echo "<script type='text/javascript'>"; 
       echo "alert('Submitted successfully')"; 
       echo "</script>";
       }}
  
?>
<body>
<h3>Details Uploaded Successfully</h3>
<div style="float:right; padding-top:50%; height:100px; ">
<button class="btn-success" id="finish">Finish</button>
  </div>
  </body>
  </html>
  <?php endif; ?>