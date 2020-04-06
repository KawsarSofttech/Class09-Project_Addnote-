
<?php
session_start();
include 'Connection.php';
$db = new Connection();
if(isset($_SESSION['user_id'])){
	header("location: index.php");
}

?>




<!DOCTYPE html>
<html>
<head>
	<title>Log in</title>
</head>
<body style="background-color: green;">
	<?php
	if(isset($_POST['submit'])){
		$user = $_POST['username'];
		$pass = md5($_POST['password']);
		$query = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
		$result = $db->fetch($query,null);
		if(count($result)==1){
			session_start();
			foreach ($result as $data){
				$_SESSION['user_id'] = $data['id'];
				$_SESSION['user_name'] = $data['username'];		
			}
			header("location: index.php");
		}else{
			echo "<p style='color: maroon;'>Credential Does not Match</p>";
		}
		
		
	}

	?>
	<form method="POST" action="" style="text-align: center; padding: 20px;">
		<input type="text" name="username"  placeholder="Username" style="margin-bottom: 5px; padding: 10px; border: 1px solid red; border-radius: 10px;"><br>
		<input type="password" name="password"  placeholder="Password" style="margin-bottom: 5px; padding: 10px; border: 1px solid red; border-radius: 10px;"><br>
		<input type="submit" name="submit"  value="Log in" style="padding: 10px; border: 1px solid red; border-radius: 5px;"><br>
		
	</form>
	<a href="forgot.php" style="color: maroon; margin-left: 46%">Forgot Passwoed?</a>

</body>
</html>

