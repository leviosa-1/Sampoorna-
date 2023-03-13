<?php
session_start();
if(isset($_SESSION['e_pass']) && isset($_SESSION['user_id'])):
  include ('dbconnect.php');
?>
<html>
<head>
<?php
if($conn){
 if($_POST['eventname']!==""){
$_SESSION['Uename']=mysqli_real_escape_string($conn,$_POST['eventname']);
$sql44="update eventt set Ename='{$_SESSION['Uename']}' where eventt.ClubID={$_SESSION['CID']} and eventt.EID={$_SESSION['EID']}";
$stmt=$conn->prepare($sql44);
$stmt->execute();}
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
 $sql7="INSERT INTO Event_organizer VALUES ('{$_SESSION['CID']}','{$_SESSION['EID']}',$OFID)";
 $stmt=$conn->prepare($sql7);
 $stmt->execute();}
else{
 $sql8="INSERT INTO faculty(Fname) VALUES ('{$_SESSION['Organizer']}')";
 $stmt=$conn->prepare($sql8);
 $stmt->execute();
 $_SESSION["lastfid"]=mysqli_insert_id($conn);
 $sql9="INSERT INTO Event_organizer VALUES ('{$_SESSION['CID']}','{$_SESSION['EID']}','{$_SESSION['lastfid']}')";
 $stmt=$conn->prepare($sql9);
 $stmt->execute();
 }}}
 else{
       echo '<div class="alert alert-danger" role="alert">Managing Faculty Name cannot be left blank</div>';
     }
 }
 //inserting record in event_coordination  
for ($i=0;$i<count($_POST['COID']); $i++){
    $_SESSION["Coordinator"]=mysqli_real_escape_string($conn,$_POST['Coordinator'][$i]);
    $_SESSION["Course"]=mysqli_real_escape_string($conn,$_POST['Course'][$i]);
    $_SESSION["Cotype"]=mysqli_real_escape_string($conn,$_POST['Cotype'][$i]);
  if($_SESSION["Coordinator"]!=='' && $_SESSION["Course"]!=='' && $_SESSION["Cotype"]!==''){
  $sql10="select * from Coordinator where Coordinator.Coname='{$_SESSION['Coordinator']}' and Coordinator.course='{$_SESSION['Course']}'";
  $check2=$conn->query($sql10);
  if($check2)
  {if(mysqli_num_rows($check2)>0)
  {$r1=mysqli_fetch_assoc($check2);
  $COID=$r1['COID'];
  if($i<=$_SESSION['storedCS'])
  { $sql11="INSERT INTO Event_coordination VALUES ('{$_SESSION['CID']}','{$_SESSION['EID']}',$COID,'{$_SESSION['Cotype']}')";
  $stmt=$conn->prepare($sql11);
  $stmt->execute();
 }
  else{
  $sql11="INSERT INTO Event_coordination VALUES ('{$_SESSION['CID']}','{$_SESSION['EID']}',$COID,'{$_SESSION['Cotype']}')";
  $stmt=$conn->prepare($sql11);
  $stmt->execute();}}
  else{
  $sql12="INSERT INTO Coordinator(Coname,Course) VALUES ('{$_SESSION['Coordinator']}','{$_SESSION['Course']}')";
  $stmt=$conn->prepare($sql12);
  $stmt->execute();
  $_SESSION["lastCoid"]=mysqli_insert_id($conn);
  $sql13="INSERT INTO Event_coordination VALUES ('{$_SESSION['CID']}','{$_SESSION['EID']}','{$_SESSION['lastCoid']}','{$_SESSION['Cotype']}')";
  $stmt=$conn->prepare($sql13);
  $stmt->execute();
  }}}
  else{
       echo '<div class="alert alert-danger" role="alert">Managing Faculty Name cannot be left blank</div>';
     }
  }
//inserting record for speaker or guest
for ($i=0;$i<count($_POST['SID']); $i++){
   $_SESSION["SID"]=mysqli_real_escape_string($conn,$_POST['SID'][$i]);
    $_SESSION["Speaker"]=mysqli_real_escape_string($conn,$_POST['Speaker'][$i]);
    $_SESSION["SpeakerDesc"]=mysqli_real_escape_string($conn,$_POST['SpeakerDesc'][$i]);
  if($_SESSION["Speaker"]!==''){
    if(in_array($_SESSION['SID'],$_SESSION['storedG']))
    {$sql7="update speaker set speaker.Sname='{$_SESSION['Speaker']}', speaker.Sdescription='{$_SESSION['SpeakerDesc']}' where speaker.ClubID={$_SESSION['CID']} and speaker.EventID={$_SESSION['EID']} and speaker.SID={$_SESSION['SID']}";
     $stmt=$conn->prepare($sql7);
     $stmt->execute();}
    else{
     $sql7="insert into speaker values('{$_SESSION['CID']}','{$_SESSION['EID']}','{$_SESSION['SID']}','{$_SESSION['Speaker']}','{$_SESSION['SpeakerDesc']}')";
     $stmt=$conn->prepare($sql7);
     $stmt->execute();
    }
  }
 else{
       echo '<div class="alert alert-danger" role="alert">Guest Name cannot be left blank</div>';
     }
  }
//inserting record in event description
for ($i=0;$i<count($_POST['EDID']); $i++){
  $_SESSION['EDID']=$_POST['EDID'][$i];
  $_SESSION["EDesc_head"]=mysqli_real_escape_string($conn,$_POST['EDesc_head'][$i]);
  $_SESSION["EDescription"]=mysqli_real_escape_string($conn,$_POST['EDescription'][$i]);
if($_SESSION["EDescription"]!==''){ 
  if(in_array($_SESSION['EDID'],$_SESSION['storedED']))
  {$sql7="update event_description set Heading_of_Description='{$_SESSION['EDesc_head']}' ,Body='{$_SESSION['EDescription']}' where event_description.ClubID='{$_SESSION['CID']}' and event_description.EventID='{$_SESSION['EID']}'and event_description.DID='{$_SESSION['EDID']}'";
     $stmt=$conn->prepare($sql7);
     $stmt->execute();}
  else{ $sql7="insert into event_description values('{$_SESSION['CID']}','{$_SESSION['EID']}','{$_SESSION['EDID']}','{$_SESSION['EDesc_head']}','{$_SESSION['EDescription']}')";
  $stmt=$conn->prepare($sql7);
  $stmt->execute();
}}}
//inserting record in event pics
if(count($_POST['PID'])){
for ($i=0;$i<count($_POST['PID']); $i++){
$n=count($_POST['PID']);
$_SESSION['PID']=$_POST['PID'][$i];
if(!in_array($_SESSION['PID'],$_SESSION['storedEP']))
  {$filename=mysqli_real_escape_string($conn,$_FILES['Eimage']['name'][$i-$_SESSION['storedNEP']]);  
if($filename!==''){
$tempname=$_FILES["Eimage"]["tmp_name"][$i-$_SESSION['storedNEP']];
$extension=pathinfo($filename,PATHINFO_EXTENSION);
$new_name="C".$_SESSION['CID']."_E".$_SESSION['EID']."_Sno".$_SESSION['PID'].".".$extension;
$folder="./image/".$new_name;
$sql20="INSERT INTO Event_pics VALUES ('{$_SESSION['PID']}','{$_SESSION['CID']}','{$_SESSION['EID']}','$new_name')";
$stmt=$conn->prepare($sql20);
$stmt->execute();
move_uploaded_file($tempname,$folder);}
//echo '<div class="alert alert-success" role="alert">Submitted Successfully</div>';
else{
     echo '<div class="alert alert-danger" role="alert">Image cannot be left blank</div>';
   }}
}}
}?>

</head>
<body>
<h3>Details Uploaded Successfully</h3>
<div style="float:right; padding-top:50%; height:100px; ">
<button class="btn-success" id="finish">Finish</button>
  </div>
  </body>
  </html>
  <?php endif; ?>