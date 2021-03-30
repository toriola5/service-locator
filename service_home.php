<?php 
	$db=mysqli_connect("localhost" , "root" , "" , "work") or die(mysqli_error($db));
	session_start();
	include("verify.php");
	?>

<!DOCTYPE html>
<html>
<head>
	<title>SERVICE | HOME</title>
	<style type="text/css">
		img{
			height: 100px;
			width: 100px;
			border-radius: 20px;
		}
	</style>
</head>
<body>
	<?php 
		$uid=$_SESSION['username'];
	$query=mysqli_query($db, "SELECT * FROM provider WHERE user_name='".$uid."'") or die(mysqli_error($db));  ?>
	<p>Here are your details</p>
	<?php while($result=mysqli_fetch_array($query)) { ?>
		<img src="<?php echo $result[11]?>">
		<p>NAME: <?php  echo $result[0]." ".$result[1]." ".$result[2];?></p>
		<p>Gender: <?php echo $result[3] ?></p>
		<p>Working adress: <?php echo $result[4] ?></p>
		<p>Phone Number: <?php echo $result[5] ?></p>
		<P>Email: <?php echo $result[6] ?></P>
		<p>service providing: <?php echo $result[10] ?></p>
		<p>Location: <?php echo $result[12] ?></p>
	<?php } ?>
	<a href="service_edit.php">EDIT DETAILS</a>
	<a href="logout.php  ?>">LOGOUT</a>
</body>
</html>