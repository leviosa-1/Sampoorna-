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
    function DELETE(x){
            var z="C";
            var r=confirm("Are you sure you want to delete this Club!");
            if(r)
              {$.ajax({
              type:'POST',
              url:'Delete.php',
              data:{'ClubID':x,
                    'Type':z},
              success:function(result){
                alert('Deleted Successfully');
                $.ajax({
              type:'POST',
              url:'clubtable.php',
             success:function(result){
                  $('#ctable').html(result);
                 }
          });
              }

          });}}
</script>
</head>
<body>
<center><h1 class="sidebar-header"style="color:white;background-color:#0b3262; border:1px solid black;">Current Clubs:</h1>
</center>
<table>
<tr>
    <th>S.No</th>
    <th>Clubs</th>
    <th>Formation Date</th>
    <th>Mentors</th>
    <th>Club logo</th>
    <th>Update</th>
    <th>Remove</th>
</tr>
<?php
$sql33=mysqli_query($conn,"select * from club");
if(mysqli_num_rows($sql33)>0)
{while($ct=mysqli_fetch_assoc($sql33)):;
 $sql34=mysqli_query($conn,"select * from club_master,faculty where club_master.MID=faculty.FID and club_master.ClubID={$ct['CId']}");
  $SNO=$ct['CId']%100;?>
    <tr>
    <td><?php echo $SNO;?>.</td>
    <td><?php echo $ct['Cname'];?></td>
    <td><?php echo $ct['Formation_date'];?></td><td><?php
 while($cm=mysqli_fetch_assoc($sql34))
     echo $cm['Fname']."<br/>";?>
</td><td><div onClick="SHOWINFO(<?php echo $ct['CId'];?>)"><a href='#data'><img src="./image/<?php echo $ct['club_logo'];?>" width='100' height='100'></a></div></td>
<td><button class="btn-warning" onClick="UPDATE(<?php echo $ct['CId'];?>)">Update</button></td>
<td><button class="btn-danger" onClick="DELETE(<?php echo $ct['CId'];?>)">Delete</button></td>
</tr><?php endwhile;}?>
</table>
<br/><br/>
</body>
</html>
<?php endif; ?>