<?php
session_start();
if(isset($_SESSION['e_pass']) && isset($_SESSION['user_id'])):
    include ('dbconnect.php');

?>
<html>
    <head>
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="new_css.css">
    <script src="jquery-3.6.2.min.js" lang="javascript"></script>    
<script>
    function DELETEE(x,y){
            var z="E";
            var r=confirm("Are you sure you want to delete this Event!");
            if(r)
              {$.ajax({
              type:'POST',
              url:'Delete.php',
              data:{'ClubID':x,
                     'EID':y,
                    'Type':z},
              success:function(result){
                alert('Deleted Successfully');
              $.ajax({
              type:'POST',
              url:'Eventtable.php',
              success:function(result){
                  $('#ctable').html(result);
                 }
          });
              }

          });}}
</script>
</head>
<body>
<center>
    <h1 class="sidebar-header"style="color:white;background-color:#0b3262; border:1px solid black;">Current Events:</h1>
</center>
<table>
<tr>
    <th>S.No</th>
    <th>Club Name</th>
    <th>Event Name</th>
    <th>Update</th>
    <th>Remove</th>
</tr>
<?php
$sql33=mysqli_query($conn," select club.CId,club.Cname,eventt.EID,eventt.Ename from club,eventt where club.CId=eventt.ClubID order by club.Cname asc, eventt.Ename asc;");
if(mysqli_num_rows($sql33)>0)
{$SNO=1;
    while($ct=mysqli_fetch_assoc($sql33)):;
 ?>
    <tr>
    <td><?php echo $SNO;?>.</td>
    <td><?php echo $ct['Cname'];?></td>
    <td><?php echo $ct['Ename'];?></td>
<td><button class="btn-warning" onClick="UPDATEE(<?php echo $ct['CId'];?>,<?php echo $ct['EID'];?>)">Update</button></td>
<td><button class="btn-danger" onClick="DELETEE(<?php echo $ct['CId'];?>,<?php echo $ct['EID'];?>)">Delete</button></td>
</tr><?php 
$SNO++; endwhile;}?>
</table>
<br/><br/>
</body>
</html>
<?php endif; ?>