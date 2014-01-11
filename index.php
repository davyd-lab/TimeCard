<?php
	session_start();

	require("connection.php");

?>

<!doctype html>

<html>

  <head>
    <title>Summary</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="css/foundation.css">
  </head>

  <body>

  	<h1>Summary</h1>

 <table>
 	<tr>
 		<th>Name</th>
 		<th>Date</th>
 		<th>Clock In</th>
 		<th>Clock Out</th>
 		<th>Total Hours</th>
 		<th>Note</th>
 	</tr>
<?php
  	//get all data from db
  $query = "SELECT * FROM users";

  $posts = fetch_all($query);
  


	foreach ($posts as $post){

		$time_worked = $post['clock_out'] - $post['clock_in'];

		if( isset($post['clock_in']) && isset($post['clock_out'])){

		echo "<tr>";
		echo "<td>" . $post['name'] . "</td>";
		echo "<td>" . $post['date'] . "</td>";
		echo "<td>" . $post['clock_in'] . "</td>";
		echo "<td>" . $post['clock_out'] . "</td>";
		echo "<td>" . $time_worked . "</td>";
		echo "<td>" . $post['note'] . "</td>";
		echo "</tr>";
	}
}

?>
</table>

<a href="clock.php">Clock in/out</a>

  </body>

</html>