<?php
session_start();
if(isset($_SESSION['e_pass']) && isset($_SESSION['user_id'])):
   include ('dbconnect.php');
?>
<html>
<head>
<?php
if($conn)
{if($_POST['Type']=="CM")
 {$CID=$_POST['ClubID'];
  $MID=$_POST['Master_id'];
   $sql35="delete from club_master where club_master.ClubID=$CID and club_master.MID=$MID";
   $stmt=$conn->prepare($sql35);
   $stmt->execute();
   $rcm=$_SESSION['storedmasters'];
   $rcm--;
   $_SESSION['storedmasters']=$rcm;
 }
else if($_POST['Type']=="CD")
 {$CID=$_POST['ClubID'];
  $DID=$_POST['DID'];
   $sql36="delete from club_description where club_description.ClubID=$CID and club_description.DID=$DID";
   $stmt=$conn->prepare($sql36);
   $stmt->execute();
   $rcd=$_SESSION['storedcdesc'];
   $rcd--;
   $_SESSION['storedcdesc']=$rcd;
 }
 else if($_POST['Type']=="OF")
 {$CID=$_POST['ClubID'];
  $EID=$_POST['EventID'];
  $OrgID=$_POST['OrgID'];
  $sql36="delete from event_organizer where event_organizer.ClubID=$CID and event_organizer.EventID=$EID and event_organizer.OrgID=$OrgID";
   $stmt=$conn->prepare($sql36);
   $stmt->execute();
   $rof=$_SESSION['storedOF'];
   $rof--;
   $_SESSION['storedOF']=$rof;
 }
 else if($_POST['Type']=="CO")
 {$CID=$_POST['ClubID'];
  $EID=$_POST['EventID'];
  $COID=$_POST['COID'];
  $sql36="delete from event_coordination where event_coordination.ClubID=$CID and event_coordination.EventID=$EID and event_coordination.COID=$COID";
   $stmt=$conn->prepare($sql36);
   $stmt->execute();
   $rco=$_SESSION['storedCS'];
   $rco--;
   $_SESSION['storedCS']=$rco;}
else if($_POST['Type']=="G")
   {$CID=$_POST['ClubID'];
    $EID=$_POST['EventID'];
    $SID=$_POST['SID'];
    $sql36="delete from speaker where speaker.ClubID=$CID and speaker.EventID=$EID and speaker.SID=$SID";
     $stmt=$conn->prepare($sql36);
     $stmt->execute();
for($j=0;$j<count($_SESSION['storedG']);$j++)
if($_SESSION['storedG'][$j]===$SID)
unset($_SESSION['storedG'][$j]);
}
else if($_POST['Type']=="ED")
   {$CID=$_POST['ClubID'];
    $EID=$_POST['EventID'];
    $DID=$_POST['DID'];
    $sql36="delete from event_description where event_description.ClubID=$CID and event_description.EventID=$EID and event_description.DID=$DID";
     $stmt=$conn->prepare($sql36);
     $stmt->execute();
for($j=0;$j<count($_SESSION['storedED']);$j++)
if($_SESSION['storedED'][$j]===$DID)
unset($_SESSION['storedED'][$j]);
}
else if($_POST['Type']=="EP")
   {$CID=$_POST['ClubID'];
    $EID=$_POST['EventID'];
    $PID=$_POST['PID'];
    $path=$_POST['pic_path'];
    $sql36="delete from event_pics where event_pics.ClubID=$CID and event_pics.EventID=$EID and event_pics.Sno=$PID";
     $stmt=$conn->prepare($sql36);
     $stmt->execute();
for($j=0;$j<count($_SESSION['storedEP']);$j++)
{if($_SESSION['storedEP'][$j]==$PID){
unset($_SESSION['storedEP'][$j]);
unlink("./image/$path");}}
}
else if($_POST['Type']=="CL")
 {$CID=$_POST['ClubID'];
   $path=$_POST['club_logo'];
unlink("./image/$path");
   $sql36="update club set club_logo=NULL where club.CId=$CID";
   $stmt=$conn->prepare($sql36);
   $stmt->execute();
   $_SESSION['logo']=0;}
else if($_POST['Type']=="E")
   {$CID=$_POST['ClubID'];
     $EID=$_POST['EID'];
     $sql53=mysqli_query($conn,"select pic_path from event_pics where event_pics.ClubID=$CID and event_pics.EventID=$EID");
     if(mysqli_num_rows($sql53)>0){
      while($r1=mysqli_fetch_assoc($sql53)){
         $image=$r1['pic_path'];
      unlink("./image/$image");}
     }
     $sql36="delete from eventt where eventt.ClubID=$CID and eventt.EID=$EID";
     $stmt=$conn->prepare($sql36);
     $stmt->execute();
     }
else if($_POST['Type']=="C")
     {$CID=$_POST['ClubID'];
            $sql53=mysqli_query($conn,"select club_logo from club where club.CId=$CID");
       if(mysqli_num_rows($sql53)>0){
        while($r1=mysqli_fetch_assoc($sql53)){
         $image=$r1['club_logo'];
        unlink("./image/$image");}
       }
       $sql54=mysqli_query($conn,"select pic_path from event_pics where event_pics.ClubID=$CID");
     if(mysqli_num_rows($sql54)>0){
      while($r2=mysqli_fetch_assoc($sql54)){
         $image1=$r2['pic_path'];
      unlink("./image/$image1");}
     }
       $sql36="delete from club where club.CId=$CID";
       $stmt=$conn->prepare($sql36);
       $stmt->execute();
       }
}?>
</head></html>
<?php endif; ?>