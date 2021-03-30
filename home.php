<?php
		$db=mysqli_connect("localhost", "root" , "" , "work") or die(mysqli_error($db));
?>
<!DOCTYPE html>
<html>
<head>
	<title>HOME | Services</title>
</head>
<style type="text/css">
	div{
		/*border: 1px solid black;*/
		width: 100%;
		height: 110px;
		border-radius: 10px;
		background-color: grey;
		padding-left: 10px;
		margin-bottom: 10px;

	}
	h1{
		color: white;
		font-family: cursive;
		font-weight: bolder;
	}
	.custom-select{
		width: 600px;
		height: 50px;
		margin-top: 20px;
		background-color: grey;
		border-radius: 20px;
		padding-top: 10px;
		font-family: arial;
	}
	select{
		background-color: silver;
			border: 1px silver;
			width: 250px;
			height: 40px;
			color: white;
			border-radius: 10px;

	}
		img{
			height: 100px;
			width: 100px;
		}
		input[type=submit]{
			background-color: white;
			height: 41px;
			border-width: 0px;
		}
		th{
			background-color: grey;
			color: black;
		}
		tr:nth-child(even) {background-color: #f2f2f2;}
		tr , th{
			border-bottom: 1px solid black;
			padding: 20px;
			text-align: left;
		}
		a{
			text-decoration: none;
		}
		tr:hover {background-color: silver;}
		a:hover{
			color: red;
		}
</style>
<body>
			<div><h1>Welcome to the best online service provider we make it easy for you to get intouch with the service provider closer to you.</h1></div>
			<?php

			$query1=mysqli_query($db, "SELECT * FROM services") or die(mysqli_error($db));
				if(isset($_POST['submit'])){
					$error=array();
					if(empty($_POST['service'])){
						$error[]="Please select the service you are looking for";
					}
					else{
						$service=mysqli_real_escape_string($db , $_POST['service']);
					}

					if(empty($_POST['area'])){
						$error[]="please select the area where you would be needing the service";
					}
					else{
						$area=mysqli_real_escape_string($db, $_POST['area']);
					}
					$query=mysqli_query($db, "SELECT * FROM provider WHERE services='".$service."' AND location='".$area."'") or die(mysqli_error($db));
					if(mysqli_num_rows($query) == 0){
						$error[]="No registered aprentice in this area yet";
					}
					if(empty($error)){ ?>
							<table>
					<tr>
						<th>Image</th>
						<th>Name</th>
						<th>Gender</th>
						<th>Adress</th>
						<th>Location</th>
						<th>Phone Number</th>

					</tr>
					<?php while($result=mysqli_fetch_array($query)){ ?>
					<tr>
						<td> <img src="<?php echo $result[11] ?>"> </td>
						<td> <?php echo $result[0]." ".$result[1]." ".$result[2]?></td>
						<td> <?php echo $result[3] ?></td>
						<td> <?php echo $result[4] ?></td>
						<td> <?php echo $result[12] ?></td>
						<td> <?php echo $result[5] ?></td>
						
					
					</tr>
					<?php } ?>
				</table>

				<?php 	}else{
					foreach ($error as $key) {
						echo $key."<br>";
					}
				} 
			}
				?>
			
			<form action="" method="post">
			<div class="custom-select">
			<select name="service">
				<option value="">Select services required</option>
				<?php 
				// $query=mysqli_query($db, "SELECT * FROM provider WHERE services='".$service."' AND location='".$area."'") or die(mysqli_error($db));
				while($result=mysqli_fetch_array($query1)) { ?> 
				<option value="<?php echo $result[0] ?>"><?php echo $result[0] ?></option>
			<?php } ?>
			</select>
		
			<?php $location=array("Yaba" ,"abule-egba" , "Ikeja" , "Ojuelegba");?>
			<select name="area">
				<option value="">Location where services is needed</option>
				<?php foreach($location as $location){ ?>
					<option value="<?php echo $location?>"><?php echo $location ?></option>
				<?php } ?>
			</select>
			<input type="submit" name="submit" value="SEARCH">
			</div>
			</form>
			<p>If you are a service provider please click here to register  <a href="Register.php">REGISTER</a></p>
			<p>Click here to login <a href="login.php">LOGIN</a></p>
</body>
</html>