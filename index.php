<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Database</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<style type="text/css">
			form{ display: inline-block; }
		</style>
	</head>
	<body>
		<center> <h1> Database </h1></center>
		<div class="container">
		<?php
			// Create connection
			$con = mysqli_connect("localhost","root","", "twitter");

			// Check connection
			if (mysqli_connect_errno()) {
		  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			$result = mysqli_query($con,"SELECT * FROM search_tweets");

			echo "<h3> Summary </h3> "; 
			$num_rows = $result->num_rows;
			echo "<b>No. of Tweets:</b> ". (string) $num_rows. "</br>"; 
			
			$geo_tag = mysqli_query($con,"SELECT * FROM search_tweets where geo_lat != 0 AND geo_long != 0");
			$geo_rows = $geo_tag->num_rows;
			echo "<b>Tweets with Geo-Location :</b> ". ($geo_rows/$num_rows)*100; 
			echo "%</br>";
			echo "<h3> KFC Tweets </h3> "; 
			echo "<table class= 'table table-hover table-bordered'>
			<tr>
			<th>No.</th>
			<th>Tweet ID</th>
			<th>Tweet Text</th>
			<th>Location</th>
			<th>Geo-Lat.</th>
			<th>Geo-Long.</th>
			<th>User ID</th>
			<th>Is retweeted</th>
			</tr>";
			$i =1;

			while($row = mysqli_fetch_array($result)) {
		  		echo "<tr>";
		  		echo "<td>" . $i . "</td>";
  				echo "<td>" . $row['tweet_id'] . "</td>";
  				echo "<td>" . $row['tweet_text'] . "</td>";
  				echo "<td>" . $row['location'] . "</td>";
  				echo "<td>" . $row['geo_lat'] . "</td>";
  				echo "<td>" . $row['geo_long'] . "</td>";
  				echo "<td>" .
  					 "<a href='user.php?user_id=" . $row['user_id'] ."'>".
  						$row['user_id'] .	
					  "</a>"
  				. "</td>";
  				echo "<td>" . $row['is_rt'] . "</td>";
  				echo "</tr>";
  				$i++;
			}

			echo "</table>";
			mysqli_close($con);
		?>

	</div>
	</body>
</html>