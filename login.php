<?php
	$db=mysqli_connect("localhost" , "root" , "" , "work") or die(mysqli_error($db));
	session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>
		LOGIN | service
	</title>
	<style type="text/css">
		div{
			width: 500px;
			background-color: grey;
			height: 230px;
			padding-left: 20px;
			padding-top: 20px;
			border-radius: 30px;
		}
		input[type=text]{
		width: 300px;
		height: 30px;
		border-radius: 7px;
		background-color: lightgrey;
		border-width: 0px;
	}
	textarea{
		border-radius: 10px;
		background-color: lightgrey;
		border-width: 0px;
	}
	input[type=email]{
		width: 300px;
		height: 30px;
		border-radius: 7px;
		background-color: lightgrey;
		border-width: 0px;
	}
	select{
		width: 300px;
		height: 30px;
		border-radius: 7px;
		background-color: silver;
		border-width: 0px;
	}
	input[type=submit]{
		margin-left: 100px;
		width: 200px;
		height: 25px;
		border-radius: 5px;
		border-width: 0px;
		background-color: silver;
	}
	input[type=password]{
		width: 300px;
		height: 30px;
		border-radius: 7px;
		background-color: lightgrey;
		border-width: 0px;
	</style>
</head>
<body>		
	<?php
		if(isset($_POST['submit'])){
			$error=array();
			if(empty($_POST['uname'])){
				$error[]="The username field can't be empty";
			}
			else{
				$uname=mysqli_real_escape_string($db, $_POST['uname']);
			}

			if(empty($_POST['password'])){
				$error[]="The password field cant be empty";
			}
			else{
				$password=mysqli_real_escape_string($db, $_POST['password']);
			}

			
			if(empty($error)){
				$query=mysqli_query($db, "SELECT * FROM provider WHERE user_name='".$uname."' AND secured_password='".md5($password)."'") or die(mysqli_error($db));
				if(mysqli_num_rows($query) == 1){
					$_SESSION['username']=$uname;
					header("location:service_home.php");
			}else{
				$error[]="wrong username or password";
			}
			
		}
		foreach ($error as $key) {
				echo $key."<br>";
			}
	}
	?>
		<div>
		<p>Input details to login</p>
		<form action="" method="post">
			<p>USERNAME: <input type="text" name="uname"></p>
			<P>PASSWORD: <input type="password" name="password"></P>
			<input type="submit" name="submit" value="LOGIN">
		</form>
	</div>
	<a href="home.php">HOME</a>
</body>
</html>