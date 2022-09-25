<?php
	include ('connection.php');
	$sql ="select news from app_version";
	$result=mysqli_query($connect, $sql);
		
		if (mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){
			echo "".$row['news'].";";
			}
		}
?>