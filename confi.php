<?php 

   
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'idiccuss');
/*
if(! $conn ) {
echo 'Could not connect: ';
   //die('Could not connect: ' . mysqli_error());
}
else
echo 'Connected successfully';

//mysqli_close($conn);
$ceid="265823";
$name='Bharat Kumar';
$sql = "SELECT CEID, EmpName FROM pbtemployeetable where CEID='$ceid' and EmpName='$name'";


$retval=mysqli_query($conn ,$sql);
if($retval){
    ?>
    <table border="1">
<tr>
<th>EmpID</th><th>EmpName</th>

</tr>
<tr>
<td>1</td><td>Shatru</td>
</tr>
   
    <?php
    while($data=mysqli_fetch_assoc($retval)){
       ?>
       <tr>
       <td><?php echo $data['CEID']?></td>
       <td><?php echo $data['EmpName']?></td>
       </tr>
      
       <?php
        
        
    }?></table><?php
   
}
else{
    echo "Error";
}
*/


?>