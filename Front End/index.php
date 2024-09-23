<?php 
	
	$conn = mysqli_connect('localhost','root','','db_sepc') or die("Connection Failed");
	$query = mysqli_query($conn,"");
	$result = mysqli_fetch_array($query);
?>

<?php ?>
<table>
	<thead>
		<tr>
			<th>a</th>
			<th>b</th>
			<th>c</th>
			<th>d</th>
			<th>e</th>
		</tr>
	</thead>
</table>

<?php ?>