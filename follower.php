<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Database</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<style type="text/css">
			form{ display: inline-block; }
			body{
				font-size: 16px;
			}
		</style>
	</head>
	<body>
		
		<div class="container">
		<?php
			// Create connection
			$con = mysqli_connect("localhost","root","", "twitter");

			// Check connection
			if (mysqli_connect_errno()) {
		  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}

			 $user_id =  $_GET["user_id"]; 

			$result = mysqli_query($con,"SELECT * FROM Followers WHERE user_id = $user_id");
			


			while($row = mysqli_fetch_array($result)) {
				echo "<center> <h1> Follower: ". $user_id ."</h1></center>";
				echo "<img src = ".$row['profile_image_url'] ."> <br>";
				echo "<b>Screen Name: </b> ". $row['screen_name'] . "<br>";
				echo "<b>Name: </b> ". $row['name'] . "<br>";
				echo "<b>Location : </b> ". $row['location'] . "<br>";
				echo "<b>Description: </b> ". $row['description'] . "<br>";
				echo "<b>Joined Twitter: </b> ". $row['created_at'] . "<br>";
				echo "<b>Tweets Count: </b> ". $row['statuses_count'] . "<br>";
				echo "<b>Followers Count: </b> ". $row['followers_count'] . "<br>";
				echo "<b>Friends Count: </b> ". $row['friends_count'] . "<br>";
				echo "<b>Time Zone: </b> ". $row['time_zone'] . "<br>";
				echo "<b>Last Tweet: </b> ". $row['last_update'] . "<br>";

			}

			mysqli_close($con);
		?>

	</div>
	</body>
</html>