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

			$result = mysqli_query($con,"SELECT * FROM tweeters WHERE user_id = $user_id");
			
			while($row = mysqli_fetch_array($result)) {
				echo "<center> <h1> User: ". $user_id ."</h1></center>";
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

				echo "<center> <h1> List of Followers </h1></center>";
				echo "<table class= 'table table-hover table-bordered'>
				<tr>
				<th>No.</th>
				<th>ID</th>
				<th>ID</th>
				<th>ID</th>
				<th>ID</th>
				<th>ID</th>
				
				</tr>";
				$i = 1;
				$c = 1;
	
				$followers = mysqli_query($con,"SELECT * FROM following WHERE followed = $user_id");
				echo "<td>". $c . "</td>";
				while ($r = mysqli_fetch_array($followers)) {
			  		echo "<td>";
		  			echo 
  					 "<a href='follower.php?user_id=" . $r['followee'] ."'>".
  						$r['followee'] .	
					  "</a>";

	  				echo "</td>";
	  				if($i %5 ==0){
	  					echo "<tr> </tr>";
	  					$c++;
	  					echo "<td>". $c . "</td>";
	  					
	  				}
  					
  					$i++;
				}
				echo "</table>";

				echo "<center> <h1> List of friends </h1></center>";
				echo "<table class= 'table table-hover table-bordered'>
				<tr>
				<th>No.</th>
				<th>ID</th>
				<th>ID</th>
				<th>ID</th>
				<th>ID</th>
				<th>ID</th>
				
				</tr>";
				$i = 1;
				$c = 1;
	
				$followers = mysqli_query($con,"SELECT * FROM friendship WHERE follower = $user_id");
				echo "<td>". $c . "</td>";
				while ($r = mysqli_fetch_array($followers)) {
			  		echo "<td>";
		  			echo 
  					 "<a href='friend.php?user_id=" . $r['friend'] ."'>".
  						$r['friend'] .	
					  "</a>";

	  				echo "</td>";
	  				if($i %5 ==0){
	  					echo "<tr> </tr>";
	  					$c++;
	  					echo "<td>". $c . "</td>";
	  					
	  				}
  					
  					$i++;
				}
				echo "</table>";

				echo "<table class= 'table table-hover table-bordered'>
				<tr>
				<th>No.</th>
				<th>Tweet ID</th>
				<th>Tweet Text</th>
				<th>Geo-Lat.</th>
				<th>Geo-Long.</th>
				<th>Is retweeted</th>
				</tr>";

				$i = 1;
				$tweets = mysqli_query($con, "SELECT * FROM past_tweets WHERE user_id = $user_id");
				while ($r = mysqli_fetch_array($tweets)) {
					echo "<tr>";
		  			echo "<td>" . $i . "</td>";
  					echo "<td>" . $r['tweet_id'] . "</td>";
  					echo "<td>" . $r['tweet_text'] . "</td>";
  					echo "<td>" . $r['geo_lat'] . "</td>";
  					echo "<td>" . $r['geo_long'] . "</td>";
  					echo "<td>" . $r['is_rt'] . "</td>";
  					echo "</tr>";
  					$i++;
				}
			}

			echo "</table>";
			mysqli_close($con);
		?>

		</div>
	</body>
</html>