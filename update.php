<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
</head>
<body style="background-color: green;">

	<?php
	include 'Connection.php';
	$db = new Connection();


	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$getNote = $db->getNote($_GET['id']);	
	}
	
	if(isset($_POST['submit'])){
		$db->update($_POST['title'],$_POST['details'],$_POST['day'],$id);
		header("location: index.php");
	}

	?>


	<?php
		// var_dump($getNote);
		foreach($getNote as $data){	
	?>

	<form method="POST" action="" style="text-align: center; padding: 20px;">
		<input type="text" name="title"  placeholder="Title" value="<?php echo $data['title'];?>" style="margin-bottom: 5px; padding: 10px; border: 1px solid red; border-radius: 10px;"><br>
		<input type="text" name="day"  placeholder="Date" value="<?php echo $data['day'];?>" style="margin-bottom: 5px; padding: 10px; border: 1px solid red; border-radius: 10px;"><br>
		<textarea name="details" placeholder="Details" style="margin-bottom: 5px; padding: 10px; border: 1px solid red; border-radius: 10px;"><?php echo $data['details'];?></textarea><br>
		<input type="submit" name="submit"  value="Update" style="padding: 10px; border: 1px solid red; border-radius: 5px;"><br>
		
	</form>

<?php
	}
?>

</body>
</html>