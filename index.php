<?php
session_start();
include 'Connection.php';
$db = new Connection();

if($_SESSION['user_id'] == null){
	header("location: login.php");
}




?>

<!DOCTYPE html>
<head>
	<title>Add a note</title>
<html>
</head>

<body>

	<p style="margin-left: 90%;">(<?php echo $_SESSION['user_name'];?>)<a href="logout.php">Log Out</a></p>
	
	<div class="Add" style="background-color: red;">
		<div class="Container" style="text-align: center; background-color: green; width: 95%; margin: auto;">

			<h2 style="text-align: center; font-size: 30px; color: yellowgreen;">Add a note</h2>
			<?php

				if(isset($_POST['submit'])){
					if(!empty($_POST['title']) && !empty($_POST['details']) && !empty($_POST['day'])){
						$img_name = uniqid().".jpg";
						$db->addNote($_POST['title'],$_POST['details'],$_POST['day'],$_SESSION['user_id'],$img_name);
						$tmp = $_FILES['image']['tmp_name'];
						
						move_uploaded_file($tmp,"photos/".$img_name);
						echo "Note Added!";

					}else{
						echo "All fields must required";
				
					}
				}

				// mark as archive
				if(isset($_GET['mark_id'])){
					$id = $_GET['mark_id'];
					$query = "UPDATE tasks SET status=0 WHERE id='$id'";
					$db->insert($query,null);
					header("location: index.php");
				}

			?>
			<form method="POST" action="" enctype="multipart/form-data" style="text-align: center; padding: 20px;">
				<input type="text" name="title"  placeholder="Title" style="margin-bottom: 5px; padding: 10px; border: 1px solid red; border-radius: 10px;"><br>
				<input type="text" name="day"  placeholder="Date" style="margin-bottom: 5px; padding: 10px; border: 1px solid red; border-radius: 10px;"><br>
				<textarea name="details" placeholder="Details" style="margin-bottom: 5px; padding: 10px; border: 1px solid red; border-radius: 10px;"></textarea><br>
				<input type="file" name="image" accept="image/*" style="margin-left: 400px;"><br>
				<input type="submit" name="submit"  value="Add" style="padding: 10px; border: 1px solid red; border-radius: 5px;"><br>
				
			</form>
			<a href="done.php">Done</a>

			<hr>
			<?php

				$results = $db->getAllnotes($_SESSION['user_id']);
				
			?>
			<table border="1px">
				<tr>
					<th>Title</th>
					<th>Details</th>
					<th>Date</th>
					<th>Image</th>
					<th>Action</th>
				</tr>
			<?php
				foreach ($results as $data) {
	
			?>	
				<tr>
					<td><?php echo $data['title']; ?></td>
					<td><?php echo $data['details']; ?></td>
					<td><?php echo $data['day']; ?></td>
					<td>
						<?php
							if($data['image'] != null){
						?>
						<img width="50px" height="30px" src="photos/<?php echo $data['image']; ?>">
						<?php
							}else{
								echo "No Image";
							}
						?>



					</td>
					<td><a href="update.php?id=<?php echo $data['id']; ?>">View</a> | <a onclick="return confirm('Are you sure?');" href="delete.php?id=<?php echo $data['id']; ?>">Delete</a> || 
						<?php
							if($data['status'] == 1){
						?>
						
						<a href="?mark_id=<?php echo $data['id']; ?>">Mark as Done</a>
						<?php 

							}else{
								echo "Done!!";
							}
						?>



					</td>
				</tr>
			<?php
				}
			?>	
			</table>
			


			
		</div>
		
	</div>



</body>
</html>
