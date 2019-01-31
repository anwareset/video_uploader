<?php
session_start();
include 'config.php';
$user = $_POST['user'];
$pass = $_POST['pass'];

$query = mysqli_query($con,"SELECT * FROM user WHERE username='$user' AND password='$pass'");
$data = mysqli_fetch_array($query);
$ceque = mysqli_num_rows($query);

if($ceque == '0'){
	$_SESSION['stat'] = 'err';
	header('location: login.php');
}else{
	$_SESSION['stat'] = 'suc';
	$_SESSION['id_user'] = $data['id_user'];
	header('location: index.php');
}