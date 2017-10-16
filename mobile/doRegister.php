<?php
header("Access-Control-Allow-Origin: *");//to allow cross-site

include '../core/init.php';

if(isset($_POST['username']) && isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['password'])) {
	// username and password sent from Form
	$username=sanitize($_POST['username']);
	$fullname=sanitize($_POST['fullname']);
	$email=sanitize($_POST['email']);
	//Here converting passsword into MD5 encryption. 
	$pass=md5(sanitize($_POST['password']));
	
	if (user_exists($_POST['username']) === true) {
		$errors[] = 'Nama pengguna \'' . $_POST['username'] . '\' sudah didaftarkan.';
	}
	if (preg_match("/\\s/", $_POST['username']) == true) {
		$errors[] = 'Nama pengenalan tidak boleh mempunyai ruang.';
	}
	if (email_exists($_POST['email']) === true) {
		$errors[] = 'Alamat email \'' . $_POST['email'] . '\' sudah didaftarkan.';
	}
	if (empty($_POST) === false && empty($errors) === true) {
		mysql_query("INSERT INTO `users` (`username`, `fullname`, `email`, `pass`) VALUES ('$username', '$fullname', '$email', '$pass')");
		echo 'true';
	} else if (empty($errors) === false){
		echo output_errors($errors);
	}
}
?>