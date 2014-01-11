<?php
require("connection.php");
session_start(); 

?>
<!doctype html>
<html lang="en">

<head>
    <title>Clock In/Out</title>
    <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="css/foundation.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
		$(document).ready(function(){

			$("#getUsers").on("submit", function(){
				var form = $(this);
				$.post(form.attr("action"), form.serialize(), function(data){

					var myDate = new Date();
					var displayDate = (myDate.getMonth()+1) + '/' + (myDate.getDate()) + '/' + myDate.getFullYear();
					var displayTime = (myDate.getHours() + ':' + myDate.getMinutes() + ':' + myDate.getSeconds());

					if (data.user_record.clock_out == null && data.user_record.clock_in != null){
					var html =  '<hr>' +
								'<h4>Hi ' + data.user_record.name +'!</h4>' +
								'<h5>Date: ' + displayDate + '</h5>' +
								'<h5>Time: ' + displayTime + '</h5>' +
								'<form action="process.php" method="post">Notes<textarea name="note"></textarea>' +
								'<input name="action" type="hidden" value="clockOut">' +
								'<input name="id" type="hidden" value="'+ data.user_record.id +'">' +
								'<input type="submit" value="Clock Out">'
								'</form>';
					}
					else {
						var html =  '<hr>' +
								'<h4>Hi ' + data.user_record.name +'!</h4>' +
								'<h5>Date: ' + displayDate + '</h5>' +
								'<h5>Time: ' + displayTime + '</h5>' +
								'<form action="process.php" method="post">' +
								'<input name="action" type="hidden" value="clockIn">' +
								'<input name="name" type="hidden" value="'+ data.user_record.name +'">' +
								'<input name="id" type="hidden" value="'+ data.user_record.user_id +'">' +
								'<input type="submit" value="Clock in">'
								'</form>';
					}
								
					$("#userData").append(html);

				}, "json");
				return false;
			
			});
		});
</script>

  </head>

  <body>
<h3>Step 1: Choose your name</h3>

<form id="getUsers" action="process.php" method="POST">
<select name='id'>

  <?php
  	//get all data from db
  $query = "SELECT id, name FROM user_names";

  $users = fetch_all($query);

	foreach ($users as $user){

	echo "<option name='id' value='" . $user['id'] . "'>" . $user['name'] . "</option>";

	}

?>
</select>
<input name="action" type="hidden" value="getUser">
<input type="submit" value="Update">
</form>

<div id="userData">
</div>

<a href="index.php">Back to Summary</a>

  </body>

</html>