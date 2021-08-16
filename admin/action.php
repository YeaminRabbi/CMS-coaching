<?php

	require '../db_config.php';
	
	//admin login
	if(isset($_POST['btn-login_admin']))
	{
		$email = $_POST['email'];
		$password = $_POST['password'];

		//die($password.'--'.$email);
		$sql = "Select count(*),id,admin_name from admin where email='$email' and password='$password';";
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		


		if($row['count(*)']=="1")
		{

			session_start();
			$_SESSION['admin']="VERIFIED";
			$_SESSION['admin_id']=$row['id'];
			$_SESSION['admin_name']=$row['admin_name'];

			header("Location: index.php");
		}
		else
		{
			header("Location: login.php?msg=error");
		}


	}



	if(isset($_POST['btn-course_insert'])){
		$course_name = $_POST['course_name'];
		$course_details = $_POST['course_details'];


		//check the file type whether IMAGE or not
		$check = 1;

		if($_FILES['upload']['type']!="application/pdf" && $_FILES['upload']['type']!="image/jpeg" &&  $_FILES['upload']['type']!="image/jpg" &&  $_FILES['upload']['type']!="image/png")
			{
				$check = 0;
				
			}
			
		
		if($check == 0)
		{
		
			header("Location: course_insert.php?FileError=on");
			die();
		}

		else{

			//getting the image data
			if (isset($_FILES["upload"]["name"])) {
			
				$target_dir = "../img/course_img/";
				$target_file = $target_dir . basename($_FILES["upload"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				
				if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
				    echo "The file ". htmlspecialchars( basename( $_FILES["upload"]["name"])). " has been uploaded.";
				  } else {
				    echo "Sorry, there was an error uploading your file.";
				  }


			}

			$sql = "INSERT INTO course (course_name, course_details, image) VALUES ('$course_name','$course_details','$target_file')";

			if ($db->query($sql) === TRUE) {
				header('Location: course_insert.php?success=on');
			 
			} else {
			  header('Location: course_insert.php?error=on');
			}



		}



	}

?>