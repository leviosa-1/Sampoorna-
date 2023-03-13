<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<?php
 if(isset($_SESSION['e_pass']) && isset($_SESSION['user_id'])):
    include ('dbconnect.php');
if($conn){
    
	$_SESSION["cname"]=mysqli_real_escape_string($conn,$_POST['clubname']);
    $_SESSION["fd"]=$_POST['formation_date'];
    $filename=mysqli_real_escape_string($conn,$_FILES["image"]["name"]);
    if($filename!=="")
    {$tempname=$_FILES["image"]["tmp_name"];
    $extension=pathinfo($filename,PATHINFO_EXTENSION);
    $new_name=$_SESSION['cname']."_logo.".$extension;
    $folder="./image/".$new_name;
    $result=mysqli_query($conn,"insert into Club(Cname,Formation_date,Club_logo) values('{$_SESSION['cname']}','{$_SESSION['fd']}','$new_name')");
    move_uploaded_file($tempname,$folder);}
    else
    $result=mysqli_query($conn,"insert into Club(Cname,Formation_date,Club_logo) values('{$_SESSION['cname']}','{$_SESSION['fd']}','bydefault club logo.png')");
    $_SESSION['lastid']=mysqli_insert_id($conn);
    if($result)
    {echo "<script language='javascript'>alert('Details uploaded!!')</script>";
?><html>
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
$(document).on('click','#cancelADDC',function(){$.ajax({
              type:'POST',
              url:'clubtable.php',
              success:function(result){
                  $('#ctable').html(result);
                 }
          });});
$(document).ready(function(){
$("#f2").on("submit",function(e){
    e.preventDefault();
     var fd = new FormData(this);
    $.ajax({  
              url:'Add Event.php',
              type:'POST',
              data:fd,
              contentType:false,
              processData:false,
              success:function(result){
                  $('#ctable').html(result);
                 }
          });});});
</script>
</head>
<body>
<div class="container">
<h3 class="sidebar-header" align="center" style="color:white;background-color:#0b3262;">Add Club description as Follows:</h3>
<br/><br/><br/>
 <form class="form-horizontal" id="f2">

<input type="hidden" name="FID[]" id="FID" value="101" readonly=""><br/><br/>
 <label for="Master">Club Manager Faculty:</label>
<input type="text" name="Master[]" id="Master" required><br/><br/>

<input type="text" name="DID[]" id="DID" value="101" readonly=""><br/><br/>
<label for="Desc_head">Description Heading:</label>
<input type="text" name="Desc_head[]" id="Desc_head" value="" placeholder="Enter Description heading" required><br/><br/>
<label for="Description">Description:</label>
<input type="textarea" name="Description[]" id="Description" placeholder="Enter Description" required>
<br/><hr/><br/>
<div id="next"></div>
<br/>
<div id="nextf"></div>
<br/>
<button type="button" class="btn-primary" name="addrow" id="addrow" >Add More Description</button>  <button type="button" class="btn-primary" name="addrowf" id="addrowf" >Add Manager Faculty</button> <br/><br/>
<button type="submit" class="btn-info" name="submit" >Submit</button>
</form></div>
<script lang="javascript">
var i=102;var j=0;var n=0;
$('#addrow').click(function(){
if(i<=101)
{i=102;j=0;}
var newrow=$('#next').append('<div class="row"><input type="text" name="DID[]" value="'+i+'" readonly=""><br/><br/><label for="Desc_head">Description Heading:</label><input type="text" name="Desc_head[]" id="Desc_head'+i+'" value="" placeholder="Enter Description Heading"><br/><br/><label for="Description">Description:</label><input type="textarea" name="Description[]" id="Description'+i+'" placeholder="Enter Description"><input type="button" class="btnRemove btn-danger" value="Remove"/><br/><hr/></div>');
if(i<j)
{i++;}
j=i++;
});
var k=102;var m=0;var u=0;
$('#addrowf').click(function(){
if(k<=101)
{k=102;m=0;}
var newrow=$('#nextf').append('<div class="row"><input type="hidden" name="FID[]" value="'+k+'" readonly=""><br/><br/><label for="Master">Club Managing Faculty:</label><input type="text" name="Master[]" id="Master'+k+'"><br/><br/><input type="button" class="btnRemove1 btn-danger" value="Remove"/><br/><hr/></div>');
if(k<m)
{k++;}
m=k++;
});
$('body').on('click','.btnRemove1',function() { 
$(this).closest("div").remove()
u++;k--;
if(u%2==1)
k--;});
$('body').on('click','.btnRemove',function() { 
$(this).closest("div").remove()
n++;i--;
if(n%2==1)
i--;});
</script>
</body> </html>
<?php
    }
else
    echo "<h6 color:red>Something went wrong,Check if the Club entered already exists or there is a connectivity error</h6>";
}
endif;
?>
</body>
</html>