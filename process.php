<?php
require("connection.php");
session_start();

if (isset($_POST['action']) and $_POST['action'] == "getUser")
{

	$user_record = fetch_record("SELECT * FROM users WHERE user_id = '{$_POST['id']}' ORDER BY date DESC LIMIT 1");

	$data['user_record'] = $user_record;

	echo json_encode($data);
}

elseif (isset($_POST['action']) and $_POST['action'] == "clockIn")
{
var_dump($_POST);


$query ="INSERT INTO users(name, date, clock_in, user_id) VALUES('{$_POST['name']}', now(), now(), '{$_POST['id']}')";

// echo $query;

$insert_query= mysql_query($query);
header('Location: clock.php');


}

elseif (isset($_POST['action']) and $_POST['action'] == "clockOut")
{
$update_query = "UPDATE users SET clock_out= now(), note='{$_POST['note']}' WHERE id='{$_POST['id']}'";

mysql_query($update_query);
header('Location: clock.php');
}

else{
	echo "Howd I get here?";
}


?>