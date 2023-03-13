<?php 
 session_start();
 if(isset($_SESSION['e_pass']) && isset($_SESSION['user_id'])):
?>
<html>
<head>
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
$("#f1").on("submit",function(e){
    e.preventDefault();
     var fd = new FormData(this);
    $.ajax({  
              url:'Add Club Description.php',
              type:'POST',
              data:fd,
              contentType:false,
              processData:false,
              success:function(result){
                  $('#ctable').html(result);
                 }
          });});});
</script>
</head><body><h1 class="sidebar-header" style="color:white;background-color:#0b3262;">Add Club details as Follows:</h1>
<form id="f1">
		<label for="clubname">Club Name:</label>
  		<input type="text" id="clubname" name="clubname" required ><br><br>
  		<label for="formation date">Formation Date:</label>
		<input type="date" id="formation_date" name="formation_date" required ><br><br>
        <span><label for="image">Club Logo:</label>
		<input type="file" accept="image/*" id="image" name="image" required><br><br></span>
		<input type="submit" class="btn-info" id="SADDC" name="submit" value="Submit">
		<input type="button" class="btn-danger" id="cancelADDC"name="cancel1" value="Cancel">
</form>
</body>
    </html>
    <?php endif; ?>