<?php
session_start();
if(isset($_SESSION['e_pass']) && isset($_SESSION['user_id'])):
?>
<!DOCTYPE html>
<html>
<head>
<script src="jquery-3.6.2.min.js" lang="javascript"></script>    
<script>
function Remove(x,y){var z="CM";
            var result=confirm("Are you sure you want to delete this Managing Faculty!");
            if(result)
              {$.ajax({
              type:'POST',
              url:'Delete.php',
              data:{'ClubID':x,
                     'Master_id':y,
                    'Type':z},
            success:function(result){
              alert('Deleted Successfully');
                var Club_id=x;
              $.ajax({
              type:'POST',
              url:'Update Club.php',
              data:{'ClubID':Club_id},
              success:function(result){
                  $('#ctable').html(result);
                 }
          });
              }
          });}}
function RemoveCD(x,y){
            var z="CD";
            var r=confirm("Are you sure you want to delete this Club Description!");
            if(r)
              {$.ajax({
              type:'POST',
              url:'Delete.php',
              data:{'ClubID':x,
                     'DID':y,
                    'Type':z},
              success:function(result){
                alert('Deleted Successfully');
                var Club_id=x;
              $.ajax({
              type:'POST',
              url:'Update Club.php',
              data:{'ClubID':Club_id},
              success:function(result){
                  $('#ctable').html(result);
                 }
          });
              }

          });}}
 function RemoveCL(x,y){var z="CL";
            var result=confirm("Are you sure you want to delete this Club logo!");
            if(result)
              {$.ajax({
              type:'POST',
              url:'Delete.php',
              data:{'ClubID':x,
                    'club_logo':y,
                   'Type':z},
            success:function(result){
              alert('Deleted Successfully');
              $.ajax({
              type:'POST',
              url:'Update Club.php',
              data:{'ClubID':x},
              success:function(result){
                  $('#ctable').html(result);
                 }
          });
              }
          });}}
          $(document).ready(function(){
$("#f4").on("submit",function(e){
    e.preventDefault();
    var Club_id=$('#clubname').val();
     
     $.ajax({  
              type:'POST',
              url:'Update Club.php',
              data:{'ClubID':Club_id},
              success:function(result){
                  $('#ctable').html(result);
                 }
          });
          });});
$(document).on('click','#cancel1',function(){$.ajax({
              type:'POST',
              url:'clubtable.php',
              success:function(result){
                  $('#ctable').html(result);
                 }
          });});
$(document).ready(function(){
$("#f5").on("submit",function(e){
    e.preventDefault();
    var fd = new FormData(this);
    $.ajax({  
              url:'Finishclubupdate.php',
              type:'POST',
              data:fd,
              contentType:false,
              processData:false,
              success:function(result){
                  $('#ctable').html(result);
                 }
          });
    
          });});
</script>
</head>
<body>
<?php
include ('dbconnect.php');
if($conn){
    $sql21=mysqli_query($conn,"select * from club");
    if(mysqli_num_rows($sql21)>0)
    {
?><h1 class="sidebar-header" align="center" style="color:white;background-color:#0b3262;">Update Club details as Follows:</h1>
<form id="f4">
		<label for="clubname">Select Club Name to be updated:</label>
        <select name="clubname" id="clubname">
    <?php
    while($club=mysqli_fetch_assoc($sql21)):;
    ?>
    <option value="<?php echo $club['CId'];?>" <?php if($_POST['ClubID']===$club['CId']) echo 'selected';?>>
    <?php echo $club['Cname'];?>
    </option><br/><br/>
    <?php
    endwhile;?>
    <input type="submit" class="btn-info" name="submit" value="Submit">
    <input type="button" id="cancel1" class="btn-danger" name="cancel" value="Cancel"><hr/>
</form>


<?php
$i=0;
$j=0;
if(isset($_POST['ClubID']))
$_SESSION['clubID']=$_POST['ClubID'];
if(isset($_SESSION['clubID']))
{
$sql22=mysqli_query($conn,"select * from club where club.CId={$_SESSION['clubID']}");
$r1=mysqli_fetch_assoc($sql22);
$sql23=mysqli_query($conn,"select * from club_description where club_description.ClubID={$_SESSION['clubID']}");
$sql24=mysqli_query($conn,"select * from club_master,faculty where club_master.ClubID={$_SESSION['clubID']} and club_master.MID=faculty.FID");
if($sql23)?>
<form class="form-horizontal" id="f5">
<label for="uclubname">Club Name:</label>
    <input type="hidden" id="CID" name="CID" value="<?php echo $_POST['ClubID'];?>">
  	<input type="text" id="uclubname" value="<?php echo $r1['Cname'];?>"name="uclubname" required>
  	<label for="uformation date">Formation Date:</label>
    <input type="date" id="uformation_date" value="<?php echo $r1['Formation_date'];?>" name="uformation_date" >
    <label for="Image">Club Logo:</label>
    <?php if($r1['club_logo']===NULL): 
    $_SESSION['logo']=0; ?>
    <input type="file" accept="image/*" id="uimage"  name="uimage" required><br/><hr/><br/>
    <?php else: ?>
      <img src="./image/<?php $_SESSION['logo']=1; echo $r1['club_logo'];?>" style="height:150px;width:150px;"/> <button type="button" class="btn-danger" onClick="RemoveCL(<?php echo $_POST['ClubID']; ?>,'<?php echo $r1['club_logo'];?>')">Remove</button><br><hr/><br>
    <?php 
    endif;
    while($mf=mysqli_fetch_assoc($sql24)):;?>
    
   <input type="hidden" name="uFID[]" id="uFID" value="<?php echo 101+$i ;?>" readonly=""><br/><br/>
   <label for="uMaster">Club Manager Faculty:</label>
   <input type="text" name="uMaster[]" value="<?php echo $mf['Fname']; ?>"id="uMaster">
   <button type="button" class="btn-danger" onClick="Remove(<?php echo $_POST['ClubID']; ?>,<?php echo 101+$i; ?>)">Remove</button><br/><hr/><br/>
   <?php
   $i++;
   endwhile;
   while($cdesc=mysqli_fetch_assoc($sql23)):;?>
   
   <input type="hidden" name="uDID[]" id="uDID" value="<?php echo $cdesc['DID'] ?>" readonly=""><br/><br/>
   <label for="uDesc_head">Description Heading:</label>
   <input type="text" name="uDesc_head[]" id="uDesc_head" value="<?php echo $cdesc['Heading_of_description'] ?>" placeholder="Enter Description heading"><br/><br/>
   <label for="uDescription">Description:</label>
   <input type="textarea" name="uDescription[]" id="uDescription" value="<?php echo $cdesc['Body'] ?>" placeholder="Enter Description">
   <button type="button" class="btn-danger" onClick="RemoveCD(<?php echo $_POST['ClubID'] ?>,<?php echo $cdesc['DID']; ?>)">Remove</button>
   <br/><hr/><br/>
   <?php
   $j++;
   endwhile;?>
   <div id="next"></div>
   <br/>
   <div id="nextf"></div>
   <br/>
   <button type="button" class="btn-primary" name="addrow" id="addrow" >Add More Description</button> 
  <button type="button" class="btn-primary" name="addrowf" id="addrowf" >Add Manager Faculty</button> <br/><br/>
   <button type="submit" class="btn-info" name="submit" >Submit</button>
   </form></div>
   <script lang="javascript" src="jquery-3.6.2.min.js"></script>
   <script lang="javascript">
   var i=101+parseInt(<?php echo $j;?>);var j=0;var n=0;
   $('#addrow').click(function(){
   if(i<=101)
   {i=102;j=0;}
   var newrow=$('#next').append('<div class="row"><input type="hidden" name="uDID[]" value="'+i+'" readonly=""><br/><br/><label for="uDesc_head">Description Heading:</label><input type="text" name="uDesc_head[]" id="uDesc_head'+i+'" value="" placeholder="Enter Description Heading"><br/><br/><label for="uDescription">Description:</label><input type="textarea" name="uDescription[]" id="uDescription'+i+'" placeholder="Enter Description"><input type="button" class="btnRemove btn-danger" value="Remove"/><br/><hr/></div>');
   if(i<j)
   {i++;}
   j=i++;
   });
   var k=101+parseInt(<?php echo $i;?>);var m=0;var u=0;
   $('#addrowf').click(function(){
   if(k<=101)
   {k=102;m=0;}
   var newrow=$('#nextf').append('<div class="row"><input type="hidden" name="uFID[]" value="'+k+'" readonly=""><br/><br/><label for="uMaster">Club Managing Faculty:</label><input type="text" name="uMaster[]" id="uMaster'+k+'"><br/><br/><input type="button" class="btnRemove1 btn-danger" value="Remove"/><br/><hr/></div>');
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
<?php 
$_SESSION['storedmasters']=$i-1;
$_SESSION['storedcdesc']=$j-1;}}
else 
echo "No Clubs formed yet.";}
else{
echo "Something went wrong.";
}
?>
</body>
</html>
<?php endif; ?>