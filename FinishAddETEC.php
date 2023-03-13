<?php
session_start();
if(isset($_SESSION['e_pass']) && isset($_SESSION['user_id'])):
include ('dbconnect.php');
?>
<!DOCTYPE html>
<html>
<head>
<?php
if($conn):
$sql52=mysqli_query($conn,"select max(EID) as MAXID from eventt where eventt.ClubID='{$_SESSION['clubID']}'");
if(mysqli_num_rows($sql52)>0)
{$r=mysqli_fetch_assoc($sql52);
  if($r['MAXID'])
 $_SESSION['EID']=$r['MAXID']+1;
 else
 $_SESSION['EID']=$r['MAXID']+101;
}
else
$_SESSION['EID']=101;
    //inserting record in eventt table
    if($_POST['s']):
        $_SESSION["Ename"]=mysqli_real_escape_string($conn,$_POST['eventname']);
        if($_SESSION["Ename"]!=='')
        {$sql5="insert into eventt values('{$_SESSION['clubID']}','{$_SESSION['EID']}','{$_SESSION['Ename']}')";
        $stmt=$conn->prepare($sql5);
        $stmt->execute(); 
        }
        else
        {echo "<script type='text/javascript'>"; 
          echo "alert('Event Name cannot be left blank')"; 
          echo "</script>";}
          
//inserting record in event_organizer          
         for ($i=0;$i<count($_POST['OFID']); $i++){
          $_SESSION["Organizer"]=mysqli_real_escape_string($conn,$_POST['Organizer'][$i]);
       if($_SESSION["Organizer"]!==''){
      $sql6="select * from faculty where faculty.Fname='{$_SESSION['Organizer']}'";
      $check1=$conn->query($sql6);
    if($check1)
     {if(mysqli_num_rows($check1)>0)
      {$r1=mysqli_fetch_assoc($check1);
       $OFID=$r1['FID'];
       $sql7="INSERT INTO Event_organizer VALUES ('{$_SESSION['clubID']}','{$_SESSION['EID']}',$OFID)";
       $stmt=$conn->prepare($sql7);
       $stmt->execute();}
     else{
       $sql8="INSERT INTO faculty(Fname) VALUES ('{$_SESSION['Organizer']}')";
       $stmt=$conn->prepare($sql8);
       $stmt->execute();
       $_SESSION["lastfid"]=mysqli_insert_id($conn);
       $sql9="INSERT INTO Event_organizer VALUES ('{$_SESSION['clubID']}','{$_SESSION['EID']}','{$_SESSION['lastfid']}')";
       $stmt=$conn->prepare($sql9);
       $stmt->execute();
       }}}
       else{
             echo '<div class="alert alert-danger" role="alert">Organizing Faculty Name cannot be left blank</div>';
           }
       }
//inserting record in event_coordination  
for ($i=0;$i<count($_POST['COID']); $i++){
  $_SESSION["Coordinator"]=mysqli_real_escape_string($conn,$_POST['Coordinator'][$i]);
  $_SESSION["Course"]=mysqli_real_escape_string($conn,$_POST['Course'][$i]);
  $_SESSION["Cotype"]= mysqli_real_escape_string($conn,$_POST['Cotype'][$i]);
if($_SESSION["Coordinator"]!=='' && $_SESSION["Course"]!=='' && $_SESSION["Cotype"]!==''){
$sql10="select * from Coordinator where Coordinator.Coname='{$_SESSION['Coordinator']}' and Coordinator.course='{$_SESSION['Course']}'";
$check2=$conn->query($sql10);
if($check2)
{if(mysqli_num_rows($check2)>0)
{$r1=mysqli_fetch_assoc($check2);
$COID=$r1['COID'];
$sql11="INSERT INTO Event_coordination VALUES ('{$_SESSION['clubID']}','{$_SESSION['EID']}',$COID,'{$_SESSION['Cotype']}')";
$stmt=$conn->prepare($sql11);
$stmt->execute();}
else{
$sql12="INSERT INTO Coordinator(Coname,Course) VALUES ('{$_SESSION['Coordinator']}','{$_SESSION['Course']}')";
$stmt=$conn->prepare($sql12);
$stmt->execute();
$_SESSION["lastCoid"]=mysqli_insert_id($conn);
$sql13="INSERT INTO Event_coordination VALUES ('{$_SESSION['clubID']}','{$_SESSION['EID']}','{$_SESSION['lastCoid']}','{$_SESSION['Cotype']}')";
$stmt=$conn->prepare($sql13);
$stmt->execute();
}}}
else{
     echo '<div class="alert alert-danger" role="alert">Coordinator Name cannot be left blank</div>';
   }
}
//inserting record for speaker or guest
 for ($i=0;$i<count($_POST['SID']); $i++){
  $_SESSION["Speaker"]=mysqli_real_escape_string($conn,$_POST['Speaker'][$i]);
  $_SESSION["SpeakerDesc"]=mysqli_real_escape_string($conn,$_POST['SpeakerDesc'][$i]);
if($_SESSION["Speaker"]!==''){
$sql16="select max(SID) as MAXID from Speaker group by Speaker.ClubID,Speaker.EventID having Speaker.ClubID='{$_SESSION['clubID']}'";
$check4=$conn->query($sql16);
if($check4)
{if(mysqli_num_rows($check4)>0)
  {$r1=mysqli_fetch_assoc($check4);
  $MAXID=$r1['MAXID'];
  $NEWSID=$MAXID+1;
  $sql17="INSERT INTO Speaker VALUES ('{$_SESSION['clubID']}','{$_SESSION['EID']}',$NEWSID,'{$_SESSION['Speaker']}','{$_SESSION['SpeakerDesc']}')";
  $stmt=$conn->prepare($sql17);
  $stmt->execute();}
  else
{$sql18="INSERT INTO Speaker(ClubID,EventID,Sname,Sdescription) VALUES ('{$_SESSION['clubID']}','{$_SESSION['EID']}','{$_SESSION['Speaker']}','{$_SESSION['SpeakerDesc']}')";
$stmt=$conn->prepare($sql18);
$stmt->execute();}
}
else{
     echo '<div class="alert alert-danger" role="alert">Speaker Name cannot be left blank</div>';
   }
}}
//inserting record for event description
for ($i=0;$i<count($_POST['EDID']); $i++){
  $EDID=101+$i;
  $_SESSION["EDesc_head"]= mysqli_real_escape_string($conn,$_POST['EDesc_head'][$i]);
  $_SESSION["EDescription"]= mysqli_real_escape_string($conn,$_POST['EDescription'][$i]); 
if($_SESSION["EDescription"]!==''){
$sql19="INSERT INTO Event_description VALUES ('{$_SESSION['clubID']}','{$_SESSION['EID']}',$EDID,'{$_SESSION['EDesc_head']}','{$_SESSION['EDescription']}')";
$stmt=$conn->prepare($sql19);
$stmt->execute();
//echo '<div class="alert alert-success" role="alert">Submitted Successfully</div>';
}
else{
     echo '<div class="alert alert-danger" role="alert">Description cannot be left blank</div>';
   }
}
//inserting event pics
for ($i=0;$i<count($_POST['PID']); $i++){
  $SNO=1+$i;
  $filename= mysqli_real_escape_string($conn,$_FILES['Eimage']['name'][$i]);
  $tempname=$_FILES["Eimage"]["tmp_name"][$i];
if($filename!==''){
$tempname=$_FILES["Eimage"]["tmp_name"][$i];
$extension=pathinfo($filename,PATHINFO_EXTENSION);
$new_name="C".$_SESSION['clubID']."_E".$_SESSION['EID']."_Sno".$SNO.".".$extension;
$folder="./image/".$new_name;
$sql20="INSERT INTO Event_pics VALUES ($SNO,'{$_SESSION['clubID']}','{$_SESSION['EID']}','$new_name')";
$stmt=$conn->prepare($sql20);
$stmt->execute();
move_uploaded_file($tempname,$folder);
//echo '<div class="alert alert-success" role="alert">Submitted Successfully</div>';
}
else{
     echo '<div class="alert alert-danger" role="alert">Image cannot be left blank</div>';
   }
}

 echo "<script type='text/javascript'>alert('Submitted successfully')</script>";
  

?>

</head>
<body>
<h3>Details Uploaded Successfully</h3>
<div style="float:right; padding-top:50%; height:100px; ">
<button class="btn-success" id="finish">Finish</button>
  </div>
  </body>
  </html>
<?php
endif;
else:
echo "<script type='text/javascript'>alert('Submitted successfully')</script>"; 
endif; 
endif;
?>