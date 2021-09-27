<?php 
	

	session_start();
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
	
		$sql = "INSERT INTO users (username,email,dob,nid,contact,address,password) VALUES ('$name', '$email', '$dob','$nid','$phone','$address','$password')";
		$db->query($sql);

		header('Location: register.php?imsg=insert');

	}


	if(isset($_POST['btn-login']))
	{

		$email = $_POST['email'];
		$password = $_POST['password'];

		$sql = "select * from users where email = '$email' and password = '$password';";
		$stmt = $pdo->prepare($sql);
	    $stmt->execute(array(
	        ':email' => $email,
	        ':password' => $password));

	     if($stmt->rowCount()==1){
	     	
	     	  $user=getUserData($db,$email,$password);


               //Keeping useres all data in the session
               $_SESSION['user']=$user;

			header("Location: user/index.php");


	     }
	     else{
	     	
	     	header("Location: login.php?msg=error");
	     }

	}


	  function getUserData($db,$email,$password){

       	  $sql="Select * FROM users where email = '".$email."' and password = '".$password."';";
	      $result = mysqli_query($db,$sql);

	      // Assoc array
	      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	            
	      // Free result set
	      mysqli_free_result($result);
	      mysqli_close($db);

	      return $row;
  	 }


?> 