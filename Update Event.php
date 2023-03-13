<?php
session_start();
if(isset($_SESSION['e_pass']) && isset($_SESSION['user_id'])):
  include('dbconnect.php');
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
if($conn):
$_SESSION['CID']=$_POST['ClubID'];
$_SESSION['EID']=$_POST['EventID'];
$sql38=mysqli_query($conn,"select * from club,eventt where eventt.ClubID=club.CId and eventt.ClubID={$_SESSION['CID']} and eventt.EID={$_SESSION['EID']}");
if(mysqli_num_rows($sql38)>0):
$r=mysqli_fetch_assoc($sql38);
?>
<h2 class="sidebar-header" class="sidebar-header"style="color:white;background-color:#0b3262; border:1px solid black;">Update Event Details as follows:</h2><br/><br/><hr/>
<h3><b><u>Club Name:<?php echo $r['Cname'];?></u></b></h3><br/>
<h3><b><u>Event Name:<?php echo $r['Ename']; ?></u></b></h3><br/><hr/>
<form id="f6">
<label for="eventname">Event Name:</label>
<input type="text" id="eventname" name="eventname" value="<?php echo $r['Ename']; endif; ?>" required><br/><hr/><br/>
<!--existing organizing faculties-->
<?php
$sql39=mysqli_query($conn,"select * from faculty,event_organizer where event_organizer.OrgID=faculty.FID and event_organizer.ClubID={$_SESSION['CID']} and event_organizer.EventID={$_SESSION['EID']}");
if(mysqli_num_rows($sql39)>0):
$i=0;
while($r=mysqli_fetch_assoc($sql39)):
?>
<input type="hidden" name="OFID[]" id="OFID" value="<?php echo 101+$i; ?>" readonly=""><br/><br/>
<label for="Organizer">Organizer Faculty:</label>
<input type="text" name="Organizer[]" id="Organizer" value="<?php echo $r['Fname'];?>" readonly="">
<button type="button" class="btn-danger" onClick="RemoveOF(<?php echo $_POST['ClubID']; ?>,<?php echo $_POST['EventID']; ?>,<?php echo $r['OrgID']; ?>)">Remove</button><br/><hr/><br/>
<?php

$i++;
        endwhile;
        endif; ?>
<div id="nexto"></div>
<br/><button type="button" class="btn-primary" name="addrowo" id="addrowo" >Add Organizing Faculty</button> <br/><hr/><br/>
<!--existing coordinating students-->
<?php
$sql40=mysqli_query($conn,"select * from event_coordination,coordinator where event_coordination.COID=coordinator.COID and event_coordination.ClubID={$_SESSION['CID']} and event_coordination.EventID={$_SESSION['EID']}");
if(mysqli_num_rows($sql40)>0):
$j=0;
while($r=mysqli_fetch_assoc($sql40)):?>

 <input type="hidden" name="COID[]" id="COID" value="<?php echo 101+$j;?>" readonly=""><br/><br/>
 <label for="Coordinator">Coordinating Student:</label>
<input type="text" name="Coordinator[]" id="Coordinator" value="<?php echo $r['Coname'];?>" readonly=""><br/><br/>
<label for="Course">Course:</label>
<input type="text" name="Course[]" id="Course" placeholder="MCA(5yrs)/Mtech(5yrs)/other" value="<?php echo $r['course'];?>" readonly=""><br/><br/>
<label for="Cotype">Coordination or Support type:</label>
<input type="text" name="Cotype[]" id="Cotype" placeholder="Techincal/Management/other" value="<?php echo $r['Cotype'];?>" readonly="">
<button type="button" class="btn-danger" onClick="RemoveCO(<?php echo $_POST['ClubID']; ?>,<?php echo $_POST['EventID']; ?>,<?php echo $r['COID']; ?>)">Remove</button><br/><hr/><br/>
<?php

$j++;
      endwhile;
     endif; ?>
<div id="nextco"></div>
<br/><button type="button" class="btn-primary" name="addrowco" id="addrowco" >Add Coordinating Student</button> <br/><hr/><br/>
<!--existing guests-->
<?php
$sql41=mysqli_query($conn,"select * from speaker where speaker.ClubID={$_SESSION['CID']} and speaker.EventID={$_SESSION['EID']}");
if(mysqli_num_rows($sql41)>0):
$k=0;$_SESSION['storedG']=array();
while($r=mysqli_fetch_assoc($sql41)):?>
 <input type="hidden" name="SID[]" id="SID" value="<?php echo $r['SID'];?>" readonly=""><br/><br/>
 <label for="Speaker">Event Guest:</label>
<input type="text" name="Speaker[]" id="Speaker" placeholder="Enter name" value="<?php echo $r['Sname'];?>"><br/><br/>
<label for="SpeakerDesc">Guest's Description:</label>
<input type="textarea" name="SpeakerDesc[]" id="SpeakerDesc" value="<?php echo $r['Sdescription'];?>" placeholder="Enter Description">
<button type="button" class="btn-danger" onClick="RemoveG(<?php echo $_POST['ClubID']; ?>,<?php echo $_POST['EventID']; ?>,<?php echo $r['SID']; ?>)">Remove</button><br/><hr/><br/>
<?php
if($r['SID']){
array_push($_SESSION['storedG'],$r['SID']);
$k=$r['SID']%100;}
else{$k=0;}
endwhile;
endif;?>
<div id="nextg"></div>
<br/><button type="button" class="btn-primary" name="addrowg" id="addrowg" >Add Event Guest</button><br/><hr/><br/>
<!--existing event description-->
<?php
$sql42=mysqli_query($conn,"select * from event_description where event_description.ClubID={$_SESSION['CID']} and event_description.EventID={$_SESSION['EID']}");
if(mysqli_num_rows($sql42)>0):
$w=0;$_SESSION['storedED']=array();
while($r=mysqli_fetch_assoc($sql42)):?>
<input type="hidden" name="EDID[]" id="EDID" value="<?php echo $r['DID'];?>" readonly=""><br/><br/>
<label for="EDesc_head">Event Description Heading:</label>
<input type="text" name="EDesc_head[]" id="EDesc_head" value="<?php echo $r['Heading_of_description'];?>" placeholder="Enter Description heading"><br/><br/>
<label for="EDescription">Event Description:</label>
<input type="textarea" name="EDescription[]" id="EDescription" placeholder="Enter Description" value="<?php echo $r['Body'];?>">
<button type="button" class="btn-danger" onClick="RemoveED(<?php echo $_POST['ClubID']; ?>,<?php echo $_POST['EventID']; ?>,<?php echo $r['DID']; ?>)">Remove</button><br/><hr/><br/>
<?php
if($r['DID']){
array_push($_SESSION['storedED'],$r['DID']);
$w=$r['DID']%100;}
else{
$w=0;
}
endwhile;
endif;?>
<div id="next"></div>
<br/>
<button type="button" class="btn-primary" name="addrow" id="addrow" >Add More Event Description</button> <br/><hr/><br/>
<!--existing images-->
<?php
$sql43=mysqli_query($conn,"select * from event_pics where event_pics.ClubID={$_SESSION['CID']} and event_pics.EventID={$_SESSION['EID']}");
if(mysqli_num_rows($sql43)>0):
$u=0;$v=0;$_SESSION['storedEP']=array();
while($r=mysqli_fetch_assoc($sql43)):?>
<label for="PID">Image</label>
<input type="text" name="PID[]" id="PID" value="<?php echo $r['Sno'];?>" readonly=""><br/><br/>
<img src="./image/<?php echo $r['pic_path'];?>" style="height:300px;width:300px;"/>
<button type="button" class="btn-danger" onClick="RemoveEP(<?php echo $_POST['ClubID']; ?>,<?php echo $_POST['EventID']; ?>,<?php echo $r['Sno']; ?>,'<?php echo $r['pic_path']; ?>')">Remove</button><br/><hr/><br/>
<?php
if($r['Sno']){
array_push($_SESSION['storedEP'],$r['Sno']);
$u=$r['Sno'];
$v++;}
else{
$u=0;
}
endwhile;
else:
$v=0;
endif;
$_SESSION['storedOF']=$i-1;
$_SESSION['storedCS']=$j-1;
$_SESSION['storedNEP']=$v;
?>
<div id="nextp"></div>
<br/>
<button type="button" class="btn-primary" name="addrowp" id="addrowp" >Add Event Pictures</button><br/><hr/><br/>

<button type="submit" class="btn-info" name="submit">Submit</button>
</form>
<script src="jquery-3.6.2.min.js" lang="javascript"></script>    
<script>
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
$(document).ready(function(){
$("#f6").on("submit",function(e){
    e.preventDefault();
    var fd = new FormData(this);
    $.ajax({  
              url:'Finisheventupdate.php',
              type:'POST',
              data:fd,
              contentType:false,
              processData:false,
              success:function(result){
                  $('#ctable').html(result);
                 }
          });
    
          });});
//inserting event description
var i=101+parseInt(<?php echo $w;?>);var j=0;var n=0;
$('#addrow').click(function(){
if(i<=101)
{i=102;j=0;}
var newrow=$('#next').append('<div class="row"><input type="hidden" name="EDID[]" value="'+i+'" readonly=""><br/><br/><label for="EDesc_head">Event Description Heading:</label><input type="text" name="EDesc_head[]" id="EDesc_head'+i+'" value="" placeholder="Enter Description Heading"><br/><br/><label for="EDescription">Event Description:</label><input type="textarea" name="EDescription[]" id="EDescription'+i+'" placeholder="Enter Description"> <input type="button" class="btnRemove btn-danger" value="Remove"/><br/><hr/></div>');
if(i<j)
{i++;}
j=i++;
});
$('body').on('click','.btnRemove',function() { 
$(this).closest("div").remove()
n++;i--;
if(n%2==1)
i--;});
//inserting organizing faculty
var k=101+parseInt(<?php echo $i;?>);var m=0;var u=0;
$('#addrowo').click(function(){
if(k<=101)
{k=102;m=0;}
var newrow=$('#nexto').append('<div class="row"><input type="hidden" name="OFID[]" value="'+k+'" readonly=""><br/><br/><label for="Organizer">Organizing Faculty:</label><input type="text" name="Organizer[]" id="Organizer'+k+'"> <input type="button" class="btnRemove1 btn-danger" value="Remove"/><br/><hr/></div>');
if(k<m)
{k++;}
m=k++;
});
$('body').on('click','.btnRemove1',function() { 
$(this).closest("div").remove()
u++;k--;
if(u%2==1)
k--;});
//inserting coordinating student
var a=101+parseInt(<?php echo $j;?>);var b=0;var c=0;
$('#addrowco').click(function(){
if(a<=101)
{a=102;b=0;}
var newrow=$('#nextco').append('<div class="row"><input type="hidden" name="COID[]" value="'+a+'" readonly=""><br/><br/><label for="Coordinator">Coordinating Student:</label><input type="text" name="Coordinator[]" id="Coordinator'+a+'"><br/><br/><label for="Course">Course:</label><input type="text" name="Course[]" id="Course'+a+'" placeholder="MCA(5yrs)/Mtech(5yrs)/other"><br/><br/><label for="Cotype">Coordination or Support type:</label><input type="text" name="Cotype[]" id="Cotype'+a+'" placeholder="Technical/Management/other"> <input type="button" class="btnRemove2 btn-danger" value="Remove"/><br/><hr/></div>');
if(a<b)
{a++;}
b=a++;
});
$('body').on('click','.btnRemove2',function() { 
$(this).closest("div").remove()
c++;a--;
if(c%2==1)
a--;});
//inserting Event Guest
var d=101+parseInt(<?php echo $k;?>);;var e=0;var f=0;
$('#addrowg').click(function(){
if(d<=101)
{d=102;e=0;}
var newrow=$('#nextg').append('<div class="row"><input type="hidden" name="SID[]" value="'+i+'" readonly=""><br/><br/><label for="Speaker">Event Guest:</label><input type="text" name="Speaker[]" id="Speaker'+i+'" value="" placeholder="Enter name"><br/><br/><label for="SpeakerDesc">Guest Description:</label><input type="textarea" name="SpeakerDesc[]" id="SpeakerDesc'+i+'" value="" placeholder="Enter Description"> <input type="button" class="btnRemove3 btn-danger" value="Remove"/><br/><hr/></div>');
if(d<e)
{d++;}
e=d++;
});
$('body').on('click','.btnRemove3',function() { 
$(this).closest("div").remove()
f++;d--;
if(f%2==1)
d--;});
//inserting event pics
var x=parseInt(<?php echo $v;?>)+1;var y=0;var z=0;
$('#addrowp').click(function(){
if(x<=1)
{x=2;y=0;}
var newrow=$('#nextp').append('<div class="row"><label for="PID">Image</label><input type="text" name="PID[]" value="'+x+'" readonly=""><br/><br/><label for="Eimage">Event Pic:</label><input type="file" accept="image/*" name="Eimage[]" id="Eimage'+x+'"><br/><br/><input type="button" class="btnRemove4 btn-danger" value="Remove"/><br/><hr/></div>');
if(x<y)
{x++;}
y=x++;
});
$('body').on('click','.btnRemove4',function() { 
$(this).closest("div").remove()
z++;x--;
if(z%2==1)
x--;});
</script>
<?php endif; ?>
</body>
</html>
<?php endif; ?>