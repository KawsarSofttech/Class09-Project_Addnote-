<?php
session_start();
include 'Connection.php';
$db = new Connection();
if($_SESSION['user_id'] == null){
	header("location: login.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>done</title>
</head>
<body style="background-color: green;">

	<?php
	$user_id = $_SESSION['user_id'];
	$query = "SELECT * FROM tasks WHERE user_id = '$user_id' AND status = 0;";
	$results = $db->fetch($query,null);
	
	?>
	<table border="1px">
		<tr>
			<th>Title</th>
			<th>Details</th>
			<th>Date</th>
			<th>Action</th>
		</tr>
	<?php
		foreach ($results as $data) {

	?>	
		<tr>
			<td><?php echo $data['title']; ?></td>
			<td><?php echo $data['details']; ?></td>
			<td><?php echo $data['day']; ?></td>
			<td>Done!!</td>
		</tr>
	<?php
		}
	?>	
	</table>

</body>
</html>