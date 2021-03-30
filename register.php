<?php
		$db=mysqli_connect("localhost", "root" , "" , "work") or die(mysqli_error($db));
		$query=mysqli_query($db, "SELECT * FROM services") or die(mysqli_error($db));
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<style type="text/css">
		
	input[type=text]{
		width: 300px;
		height: 30px;
		border-radius: 7px;
		background-color: lightgrey;
		border-width: 0px;
		position: absolute;
		right: 10px;
	}
	textarea{
		border-radius: 10px;
		background-color: lightgrey;
		border-width: 0px;
		width: 370px;
	}
	input[type=email]{
		width: 300px;
		height: 30px;
		border-radius: 7px;
		background-color: lightgrey;
		border-width: 0px;
		position: absolute;
		right: 10px;
	}
	select{
		width: 300px;
		height: 30px;
		border-radius: 7px;
		background-color: silver;
		border-width: 0px;
		position: absolute;
		right: 10px;
	}
	input[type=submit]{
		margin-left: 100px;
		width: 200px;
		height: 25px;
		border-radius: 5px;
		border-width: 0px;
		background-color: lightgrey;
	}
	div{
		border: 1px solid white;
		position: relative;
		width: 450px;
		background-color: grey;
		padding-left: 10px;
		padding-right:10px;
	}
	input[type=password]{
		width: 300px;
		height: 30px;
		border-radius: 7px;
		background-color: lightgrey;
		border-width: 0px;
		position: absolute;
		right: 10px;
	}
	div p{
		color: white;
		text-transform: capitalize;
		font-family: cursive;
		font-size: 17px;
	}
	</style>
</head>
<body>				
					<?php
					$maxsize=2000000;
					$extension=array('image/jpg' , 'image/jpeg' , 'image/png' ,'');


					if(isset($_POST['submit'])){
						$error=array();
						if(!in_array($_FILES['picture']['type'], $extension)){
							$error[]="picture type not acceptable";
						}

						if($_FILES['picture']['size'] > $maxsize){
							$error[]="Image Size is greater than the required size ".$maxsize;
						}
						$filename=str_replace(" ","_", $_FILES['picture']['name']);
						$destination='image/'.$filename;

						if(!move_uploaded_file($_FILES['picture']['tmp_name'] , $destination)){
							$error[]="Profile picture not sucessfully updated";
						}

						if(empty($_POST['fname'])){
							$error[]="Please input your firstname";
						}
						else{
							$fname=mysqli_real_escape_string($db, $_POST['fname']);
						}

						if(empty($_POST['sname'])){
							$error[]="Please input your Secondname";
						}
						else{
							$sname=mysqli_real_escape_string($db, $_POST['sname']);
						}

						if(empty($_POST['lname'])){
							$error[]="Please input your last name";
						}
						else{
							$lname=mysqli_real_escape_string($db, $_POST['lname']);
						}

						if(empty($_POST['gender'])){
							$error[]="Please select your Gender";
						}
						else{
							$gender=mysqli_real_escape_string($db, $_POST['gender']);
						}

						if(empty($_POST['work'])){
							$error[]="Please Select the service you would be providing";
						}
						else{
							$work=mysqli_real_escape_string($db, $_POST['work']);
						}

						if(empty($_POST['adress'])){
							$error[]="Please input your shop adress";
						}
						else{
							$adress=mysqli_real_escape_string($db, $_POST['adress']);
						}

						if(empty($_POST['pnumber'])){
							$error[]="please input your phone number";
						}
						else{
							$pnumber=mysqli_real_escape_string($db, $_POST['pnumber']);
						}

						if(empty($_POST['email'])){
							$error[]="Please input your email";
						}
						else{
							$email=mysqli_real_escape_string($db , $_POST['email']);
						}

						if(empty($_POST['username'])){
							$error[]="Please select a user name for login";
						}
						else{
							$username=mysqli_real_escape_string($db, $_POST['username']);
						}

						if(empty($_POST['password'])){
							$error[]="Please input a password for you login";
						}
						else{
							$password=mysqli_real_escape_string($db, $_POST['password']);
						}

						if(empty($_POST['area'])){
							$error[]="Please select your location";
						}
						else{
							$area=mysqli_real_escape_string($db, $_POST['area']);
						}
							foreach ($error as $key) {
								echo $key."<br>";
							}
				

						if(empty($error)){
							$query=mysqli_query($db, "INSERT INTO provider VALUES('".$fname."' , '".$sname."' , '".$lname."' , '".$gender."' , '".$adress."', '".$pnumber."' , '".$email."' , '".$username."' , '".$password."' , '".md5($password)."' ,	'".$work."' , '".$destination."' , '".$area."')") or die(mysqli_error($db));
							header("location:login.php");
						}
						else{
						}
					}
					?>

					<h1>Welcome to the best cutomers connectors. Register to get connected to the customer's coloser to you</h1>
					<div>
				<form enctype="multipart/form-data" action="" method="post">
					<p>Firstname<input type="text" name="fname"></p>
					<p>Secondname<input type="text" name="sname"></p>
					<p>Lastname<input type="text" name="lname"></p>
					<p>Gender: Male<input type="radio" name="gender" value="M">
						Female<input type="radio" name="gender" value="F"></p>
					<p>Service providing<select name="work">
						<option>Select service to provide</option>
						<?php while($result=mysqli_fetch_array($query)) { ?>
						<option value="<?php echo $result[0] ?>"><?php echo $result[0] ?></option>
					<?php } ?>
					</select></p>
					<p>Adress<textarea rows="10" cols="30" name="adress"></textarea></p>
					<p>Phone Number<input type="text" name="pnumber" maxlength="11"></p>
					<p>Email<input type="email" name="email" placeholder="serviceprovider@gmail.com"></p>
					<p>username<input type="text" name="username"></p>
					<p>Password<input type="Password" name="password"></p>
					<p>Picture:<input type="file" name="picture"></p>
					<?php $location=array("Yaba" ,"Abule-egba" , "Ikeja" , "Ojuelegba");?>
					<p>Location
				<select name="area">
					<option>Select your location</option>
				<?php foreach($location as $loc){ ?>
					<option value="<?php echo $loc?>"><?php echo $loc ?></option>
				<?php } ?>
			</select></p>
					<input type="submit" name="submit" value="Register">
				</form>
			</div>
			<a href="home.php">HOME</a>
	
</body>
</html>