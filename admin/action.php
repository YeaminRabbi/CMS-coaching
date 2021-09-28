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


	//course insert
	if(isset($_POST['btn-course_insert'])){
		$course_name = $_POST['course_name'];
		$course_details = $_POST['course_details'];


		//check the file type whether IMAGE or not
		$check = 1;

		if($_FILES['upload']['type']!="image/jpeg" &&  $_FILES['upload']['type']!="image/jpg" &&  $_FILES['upload']['type']!="image/png")
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


	//course update
	if(isset($_POST['CourseUpdate'])){

		$course_name = $_POST['course_name'];
		$course_details = $_POST['course_details'];
		$course_id = $_POST['course_id'];
		$course_image = $_POST['course_image'];

		

		if (!empty($_FILES["upload"]["name"])) {
			
			unlink($course_image);

			//check the file type whether IMAGE or not
			$check = 1;

			if($_FILES['upload']['type']!="image/jpeg" &&  $_FILES['upload']['type']!="image/jpg" &&  $_FILES['upload']['type']!="image/png")
				{
					$check = 0;
					
				}
				
			
			if($check == 0)
			{
			
				header("Location: course_edit.php?course_id=$course_id&FileError=on");
				die();
			}

			$target_dir = "../img/course_img/";
			$target_file = $target_dir . basename($_FILES["upload"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				
			if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
				echo "The file ". htmlspecialchars( basename( $_FILES["upload"]["name"])). " has been uploaded.";

				$sql = "UPDATE `course` SET course_name = '$course_name' , course_details = '$course_details',image = '$target_file' WHERE id='$course_id'";

				$db->query($sql);
				header("Location: course_edit.php?course_id=$course_id&update=on");

			} 
			
		}
		else{

			$sql = "UPDATE `course` SET course_name = '$course_name' , course_details = '$course_details'  WHERE id='$course_id'";

			$db->query($sql);
			header("Location: course_edit.php?course_id=$course_id&update=on");


		}



	}


	//course delete
	if(isset($_GET['course_delete']))
	{
		$course_id = $_GET['course_delete'];
		$course_image = $_GET['img'];


		unlink($course_image);

		$sql = "delete from course where id='$course_id';";
		$db->query($sql);

		header("Location: course_list.php?delete=on");

	}


	//batch insert code
	if(isset($_POST['btn-batch_insert'])){
		$batch_code = $_POST['batch_code'];
		$batch_name = $_POST['batch_name'];
		$seat = $_POST['seat'];
		$schedule_day = $_POST['schedule_day'];
		$schedule_time = $_POST['schedule_time'];
		$course_id = $_POST['course_id'];
		$amount = $_POST['amount'];
		$faculty = $_POST['faculty'];
		$starting_date = $_POST['starting_date'];
		$ending_date = $_POST['ending_date'];


		$sql = "INSERT INTO batch (batch_code, batch_name, seat,schedule_day,schedule_time,course_id,amount,faculty,starting_date,ending_date) VALUES ('$batch_code','$batch_name','$seat', '$schedule_day', '$schedule_time', '$course_id','$amount','$faculty','$starting_date', '$ending_date')";

		if ($db->query($sql) === TRUE) {
				header('Location: batch_insert.php?success=on');
			 
		} else {
			  header('Location: batch_insert.php?error=on');
		}
	}


	//faculty insertion code
	if(isset($_POST['btn-faculty_insert'])){
		$faculty_name = $_POST['faculty_name'];
		$age = $_POST['age'];
		$email = $_POST['email'];
		$contact = $_POST['contact'];
		$skills = $_POST['skills'];

		$sql = "INSERT INTO faculty (faculty_name, age, email,contact,skills) VALUES ('$faculty_name','$age','$email', '$contact', '$skills')";

		if ($db->query($sql) === TRUE) {
				header('Location: faculty_insert.php?success=on');
			 
		} else {
			  header('Location: faculty_insert.php?error=on');
		}

	}


	//updating the faculty information
	if(isset($_POST['btn-faculty_update'])){
		
		$faculty_name = $_POST['faculty_name'];
		$age = $_POST['age'];
		$email = $_POST['email'];
		$contact = $_POST['contact'];
		$skills = $_POST['skills'];

		$faculty_id= $_POST['faculty_id'];

		$sql = "UPDATE `faculty` SET faculty_name = '$faculty_name' , age = '$age', email = '$email',contact = '$contact', skills = '$skills'  WHERE id='$faculty_id'";

		$db->query($sql);
		header("Location: faculty_edit.php?faculty_id=$faculty_id&update=on");



	}


	//deleting a faculty with ID
	if(isset($_GET['faculty_delete']))
	{
		$id = $_GET['faculty_delete'];
		$sql = "delete from faculty where id='$id';";
		$db->query($sql);

		header("Location: faculty_list.php?delete=on");

	}


	//deleting a batch with ID
	if(isset($_GET['batch_delete'])){

		$id = $_GET['batch_delete'];
		$sql = "delete from batch where id='$id';";
		$db->query($sql);

		header("Location: batch_list.php?delete=on");
	}



	//approving a student to courses
	

	//code for ajax auto update in cart for product quantities
	if(isset($_GET['data1'])){
		
		$pid =$_POST['data1'];
		

		$stmt = $db->prepare("update enrollment set status=1 where id=?");

		$stmt-> bind_param("i", $pid);
		$stmt-> execute();

		//header("Location: student_pending.php");


	}

	if(isset($_POST['pid'])){
		
		$pid =$_POST['pid'];
		

		$stmt = $db->prepare("update enrollment set status=1 where id=?");

		$stmt-> bind_param("i", $pid);
		$stmt-> execute();


	}


		if(isset($_GET['approve_id']))
		{
			$id = $_GET['approve_id'];
			
			$sql = "UPDATE `enrollment` SET status = 1 WHERE id='$id'";

		$db->query($sql);

		$enrool = fetch_all_data_usingDB($db, "select * from enrollment");

		$batch_id = $enrool['batch_id'];



		$sql2 = "UPDATE `batch` SET seat =seat - 1 WHERE id='$batch_id'";

		$db->query($sql2);


		header("Location: student_pending.php");

		}


		function fetch_all_data_usingPDO($pdo,$sql)
	{
		
		$statement = $pdo->prepare($sql);
		$statement->execute();
		$row = $statement->fetchAll();

		return $row;
	}



	 function fetch_all_data_usingDB($db,$sql){
			
			$result = mysqli_query($db,$sql);
		    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		    mysqli_free_result($result);
		    return $row;
		}

?>