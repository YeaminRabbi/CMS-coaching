<?php 
	
	require 'db_config.php';

	if(isset($_POST['btn-register']))
	{
		$name=$_POST['name'];
		$email=$_POST['email'];
		$dob=$_POST['dob'];
		$nid=$_POST['nid'];
		$phone=$_POST['phone'];
		
		$address=$_POST['address'];
		
		$password=$_POST['password'];
	
		$sql = "INSERT INTO users (username,email,dob,nid,phone,address,password) VALUES ('$name', '$email', '$dob','$nid','$phone','$address','$password')";
		$db->query($sql);

		header('Location: user_registration.php?imsg=insert');

	}




?> 