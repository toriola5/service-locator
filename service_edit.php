<?php
	$db=mysqli_connect("localhost" , "root" , "" , "work") or die(mysqli_error($db));
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>EDIT | details</title>
	<style type="text/css">
		
	</style>
</head>
<body>
		<?php
			$user=$_SESSION['username'];
			$query=mysqli_query($db, "SELECT * FROM provider where user_name='".$user."'") or die(mysqli_error($db));
			while($result=mysqli_fetch_array($query)){
				extract($result);
			}
			$query1=mysqli_query($db, "SELECT * FROM services where duty='".$services."'") or die(mysqli_error($db));
			while($result1=mysqli_fetch_array($query1)){
				extract($result1);
			}
		
			$query2=mysqli_query($db, "SELECT * FROM services ") or die(mysqli_error($db));
			if(isset($_POST['submit'])){
				$error=array();
				if(isset($_POST['fname'])){
					$fname=mysqli_real_escape_string($db, $_POST['fname']);
				}
				else{
					$error="Please ensure the first name field is not empty";
				}

				if(isset($_POST['sname'])){
					$sname=mysqli_real_escape_string($db, $_POST['sname']);
				}
				else{
					$error[]="please ensure the second name field is not empty";
				}

				if(isset($_POST['lname'])){
					$lname=mysqli_real_escape_string($db, $_POST['lname']);
				}
				else{
					$error[]="please ensure the last name field is not empty";
				}

				if(isset($_POST['gender'])){
					$sex=mysqli_real_escape_string($db, $_POST['gender']);
				}
				else{
					$error[]="please ensure you select your gender";
				}

				if(isset($_POST['work'])){
					$work=mysqli_real_escape_string($db, $_POST['work']);
				}
				else{
					$error[]="please ensure the services rendered is selected";
				}

				if(isset($_POST['address'])){
					$address=mysqli_real_escape_string($db, $_POST['address']);
				}
				else{
					$error[]="please ensure the adress filed is not empty";
				}

				if(isset($_POST['pnumber'])){
					$pnumber=mysqli_real_escape_string($db, $_POST['pnumber']);
				}
				else{
					$error[]="please ensure the phone number field is not empty";
				}

				if(isset($_POST['mail'])){
					$mail=mysqli_real_escape_string($db, $_POST['mail']);
				}
				else{
					$error[]="please ensure the email field is not empty";
				}
				if(isset($_POST['username'])){
					$username=mysqli_real_escape_string($db, $_POST['username']);
				}
				else{
					$error[]="pleae ensure the username field is not empty";
				}

				if(isset($_POST['area'])){
					$area=mysqli_real_escape_string($db, $_POST['area']);
				}
				else{
					$error[]=mysqli_real_escape_string($db, $_POST['area']);
				}

				if(empty($error)){
					$enter=mysqli_query($db, "UPDATE provider SET first_name='".$fname."', second_name='".$sname."', last_name='".$lname."' , gender='".$sex."' , adress='".$address."' , phone_number='".$pnumber."' , email='".$mail."' , user_name='".$username."' , password='".$password."' , secured_password='".$secured_password."', services='".$work."', picture='".$picture."' ,location='".$area."' WHERE user_name='".$user."'") or die(mysqli_error($db));
				}
				else{
					foreach ($error as $key) {
						echo $key."<br>";
					}
				}

			}

			
		?>
		<form action="" method="post">
		<p>Firstname<input type="text" name="fname" value="<?php echo $first_name ?>"></p>
					<p>Secondname<input type="text" name="sname" value="<?php echo $second_name ?>"></p>
					<p>Lastname<input type="text" name="lname" value="<?php echo $last_name ?> "></p>
					<p>Gender: Male<input type="radio" name="gender" value="M" <?php if($gender =='M' ) echo 'checked="checked"'?>>
						Female<input type="radio" name="gender" value="F" <?php if($gender =='F') echo 'checked="checked"' ?>> </p>
					<p>Service providing<select name="work">
						<option>Select service to provide</option>
						<?php while($answer=mysqli_fetch_array($query2)) { ?>
						<option value="<?php echo $answer[0] ?>" <?php if($duty == $answer[0]) echo 'selected="selected"' ?>><?php echo $answer[0] ?></option>
					<?php } ?>
					</select></p>
					<p>Adress<textarea rows="10" cols="30" name="address"> <?php echo $adress ?></textarea></p>
					<p>Phone Number<input type="text" name="pnumber" maxlength="11" minlength="11" value="<?php echo $phone_number ?>"></p>
					<p>Email<input type="email" name="mail" placeholder="serviceprovider@gmail.com" value="<?php echo $email ?>"></p>
					<p>username<input type="text" name="username" value="<?php echo $user_name ?>"></p>
					<!-- <p>Password<input type="Password" name="password"></p> -->
					<?php $local =array("Yaba" ,"abule-egba" , "Ikeja" , "Ojuelegba");?>
					<p>Location
				<select name="area">
					<option>Select your location</option>
				<?php foreach($local as $loc){ ?>
					<option value="<?php echo $loc?>" <?php if(isset($location) && $location == $loc)  echo 'selected="selected"'?>><?php echo $loc ?></option>
				<?php } ?>
			</select></p>
					<input type="submit" name="submit" value="EDIT">
				</form>
				<a href="service_home.php">HOME</a>

</body>
</html>