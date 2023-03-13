<?php
session_start();
if(isset($_SESSION['e_pass']) && isset($_SESSION['user_id'])):
  include('dbconnect.php');
?>
<!DOCTYPE html>
<html>
<body>
<?php

if($conn){

    

        for ($i=0;$i<count($_POST['DID']); $i++){
          $DID=101+$i;
          $_SESSION["desc_head"]=mysqli_real_escape_string($conn,$_POST['Desc_head'][$i]);
          $_SESSION["Description"]=mysqli_real_escape_string($conn,$_POST['Description'][$i]); 
       if($_SESSION["Description"]!==''){
       $sql="INSERT INTO Club_description VALUES ('{$_SESSION['lastid']}',$DID,'{$_SESSION['desc_head']}','{$_SESSION['Description']}')";
       $stmt=$conn->prepare($sql);
       $stmt->execute();
       echo '<div class="alert alert-success" role="alert">Submitted Successfully</div>';
       }
       else{
             echo '<div class="alert alert-danger" role="alert">Description cannot be left blank</div>';
           }
       }
       for ($i=0;$i<count($_POST['FID']); $i++){
        $_SESSION["Master"]=mysqli_real_escape_string($conn,$_POST['Master'][$i]);
     if($_SESSION["Master"]!==''){
    $sql1="select * from faculty where faculty.Fname='{$_SESSION['Master']}'";
    $check=$conn->query($sql1);
  if($check)
   {if(mysqli_num_rows($check)>0)
    {$r1=mysqli_fetch_assoc($check);
     $MID=$r1['FID'];
     $sql2="INSERT INTO Club_master VALUES ('{$_SESSION['lastid']}',$MID)";
     $stmt=$conn->prepare($sql2);
     $stmt->execute();}
   else{
     $sql3="INSERT INTO faculty(Fname) VALUES ('{$_SESSION['Master']}')";
     $stmt=$conn->prepare($sql3);
     $stmt->execute();
     $_SESSION["lastfid"]=mysqli_insert_id($conn);
     $sql4="INSERT INTO Club_master VALUES ('{$_SESSION['lastid']}','{$_SESSION['lastfid']}')";
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
       
    }
    else
    echo "<h6 color:red>Something went wrong,Check if the Club entered already exists or there is a connectivity error</h6>";
?>
<html>
<head>
<title></title>
<style> .container{
width: 80%;
height: 30%;
padding:20px;
}
</style>
<script src="jquery-3.6.2.min.js" lang="javascript"></script>
<script>
$(document).on('click','#Skip',function(){
                 var s=0;
              $.ajax({
              type:'POST',
              url:'Finish.php',
              data:{'s':s},
              success:function(result){
                  $('#ctable').html(result);
                 }
          });});
          $(document).ready(function(){
            var s=1;
$("#f3").on("submit",function(e){
    e.preventDefault();
     var fd = new FormData(this);
    $.ajax({  
              url:'Finish.php',
              type:'POST',
              data:fd,
              contentType:false,
              processData:false,
              success:function(result){
                  $('#ctable').html(result);
                 }
          });});});</script>
</head>
<body>
<div class="container">
<h3 class="sidebar-header" align="center" style="color:white;background-color:#0b3262;">Add Event and it's Description as Follows:</h3>
<br/><br/><br/>
 <form class="form-horizontal" id="f3">
<input type="hidden" name="s" id="s" value="1">
<label for="eventname">Event Name:</label>
 <input type="text" id="eventname" name="eventname" required><br/><hr/><br/>
 
 <input type="hidden" name="OFID[]" id="OFID" value="101" readonly=""><br/><br/>
 <label for="Organizer">Organizer Manager Faculty:</label>
<input type="text" name="Organizer[]" id="Organizer" required><br/><hr/><br/>
<div id="nexto"></div>
<br/><button type="button" class="btn-primary" name="addrowo" id="addrowo" >Add Organizing Faculty</button> <br/><hr/><br/>

 <input type="hidden" name="COID[]" id="COID" value="101" readonly=""><br/><br/>
 <label for="Coordinator">Coordinating Student:</label>
<input type="text" name="Coordinator[]" id="Coordinator" required><br/><br/>
<label for="Course">Course:</label>
<input type="text" name="Course[]" id="Course" placeholder="MCA(5yrs)/Mtech(5yrs)/other" required><br/><br/>
<label for="Cotype">Coordination or Support type:</label>
<input type="text" name="Cotype[]" id="Cotype" placeholder="Techincal/Management/other" required><br/><hr/><br/>
<div id="nextco"></div>
<br/><button type="button" class="btn-primary" name="addrowco" id="addrowco" >Add Coordinating Student</button> <br/><hr/><br/>

 <input type="hidden" name="SID[]" id="SID" value="101" readonly=""><br/><br/>
 <label for="Speaker">Event Guest:</label>
<input type="text" name="Speaker[]" id="Speaker" placeholder="Enter name"><br/><br/>
<label for="SpeakerDesc">Guest's Description:</label>
<input type="textarea" name="SpeakerDesc[]" id="SpeakerDesc" value="" placeholder="Enter Description" ><br/><hr/><br/>
<div id="nextg"></div>
<br/><button type="button" class="btn-primary" name="addrowg" id="addrowg" >Add Event Guest</button><br/><hr/><br/>

<input type="hidden" name="EDID[]" id="EDID" value="101" readonly=""><br/><br/>
<label for="EDesc_head">Event Description Heading:</label>
<input type="text" name="EDesc_head[]" id="EDesc_head" value="" placeholder="Enter Description heading" required><br/><br/>
<label for="EDescription">Event Description:</label>
<input type="textarea" name="EDescription[]" id="EDescription" placeholder="Enter Description" required>
<br/><hr/><br/>
<div id="next"></div>
<br/>
<button type="button" class="btn-primary" name="addrow" id="addrow" >Add More Event Description</button> <br/><hr/><br/>

<input type="hidden" name="PID[]" id="PID" value="1" readonly=""><br/><br/>
<label for="Eimage">Event Pic:</label>
<input type="file" accept="image/*" id="Eimage" name="Eimage[]" ><br/><hr/><br/>
 <div id="nextp"></div>
<br/>
<button type="button" class="btn-primary" name="addrowp" id="addrowp" >Add Event Pictures</button><br/><hr/><br/>
<button type="submit" class="btn-info" name="submit">Submit</button>  
<button type="button" class="btn-info" name="Skip" id="Skip">Skip</button>
</form></div>
<script lang="javascript" src="jquery-3.6.2.min.js"></script>
<script lang="javascript">
//inserting event description
var i=102;var j=0;var n=0;
$('#addrow').click(function(){
if(i<=101)
{i=102;j=0;}
var newrow=$('#next').append('<div class="row"><input type="hidden" name="EDID[]" value="'+i+'" readonly=""><br/><br/><label for="EDesc_head">Event Description Heading:</label><input type="text" name="EDesc_head[]" id="EDesc_head'+i+'" value="" placeholder="Enter Description Heading"><br/><br/><label for="EDescription">Event Description:</label><input type="textarea" name="EDescription[]" id="EDescription'+i+'" placeholder="Enter Description"><input type="button" class="btnRemove btn-danger" value="Remove"/><br/><hr/></div>');
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
var k=102;var m=0;var u=0;
$('#addrowo').click(function(){
if(k<=101)
{k=102;m=0;}
var newrow=$('#nexto').append('<div class="row"><input type="hidden" name="OFID[]" value="'+k+'" readonly=""><br/><br/><label for="Organizer">Organizing Faculty:</label><input type="text" name="Organizer[]" id="Organizer'+k+'"><br/><br/><input type="button" class="btnRemove1 btn-danger" value="Remove"/><br/><hr/></div>');
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
var a=102;var b=0;var c=0;
$('#addrowco').click(function(){
if(a<=101)
{a=102;b=0;}
var newrow=$('#nextco').append('<div class="row"><input type="hidden" name="COID[]" value="'+a+'" readonly=""><br/><br/><label for="Coordinator">Coordinating Student:</label><input type="text" name="Coordinator[]" id="Coordinator'+a+'"><br/><br/><label for="Course">Course:</label><input type="text" name="Course[]" id="Course'+a+'" placeholder="MCA(5yrs)/Mtech(5yrs)/other"><br/><br/><label for="Cotype">Coordination or Support type:</label><input type="text" name="Cotype[]" id="Cotype'+a+'" placeholder="Technical/Management/other"><br/><br/><input type="button" class="btnRemove2 btn-danger" value="Remove"/><br/><hr/></div>');
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
var d=102;var e=0;var f=0;
$('#addrowg').click(function(){
if(d<=101)
{d=102;e=0;}
var newrow=$('#nextg').append('<div class="row"><input type="hidden" name="SID[]" value="'+i+'" readonly=""><br/><br/><label for="Speaker">Event Guest:</label><input type="text" name="Speaker[]" id="Speaker'+i+'" value="" placeholder="Enter name"><br/><br/><label for="SpeakerDesc">Guest Description:</label><input type="textarea" name="SpeakerDesc[]" id="SpeakerDesc'+i+'" value="" placeholder="Enter Description"><input type="button" class="btnRemove3 btn-danger" value="Remove"/><br/><hr/></div>');
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
var x=2;var y=0;var z=0;
$('#addrowp').click(function(){
if(x<=1)
{x=2;y=0;}
var newrow=$('#nextp').append('<div class="row"><input type="hidden" name="PID[]" value="'+x+'" readonly=""><br/><br/><label for="Eimage">Event Pic:</label><input type="file" accept="image/*" name="Eimage[]" id="Eimage'+x+'"><br/><br/><input type="button" class="btnRemove4 btn-danger" value="Remove"/><br/><hr/></div>');
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
</body> </html>
<?php endif; ?>