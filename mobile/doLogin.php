<?php
header("Access-Control-Allow-Origin: *");//to allow cross-site

include '../core/init.php';

if(isset($_POST['username']) && isset($_POST['password'])) {
	// username and password sent from Form
	$username=sanitize($_POST['username']);
	//Here converting passsword into MD5 encryption. 
	$password=md5(sanitize($_POST['password']));
	
	$query = mysql_query("SELECT * FROM `users` WHERE `username` = '$username' AND `pass` = '$password'");
	if (mysql_num_rows($query) == 1) {
		$row = mysql_fetch_assoc($query);
		$message[]=$row;
		
		$logintime = date("l, j M Y - H:i A");
		mysql_query("UPDATE `users` SET `last_login` = '$logintime' WHERE `id` = " . $row['id']);
		
		//echo $_GET[jsoncallback] . "(" . json_encode($message) . ")";
		//$data['success'] = true;
		echo json_encode($message);
		//echo 'true';
	} else {
		//$data['success'] = false;
		//echo json_encode($data);
		//echo 'false';
	}
}
?>