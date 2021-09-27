<?php


require '../db_config.php';
session_start();
if(isset($_GET['enroll_id']) && isset($_GET['cod']))
{

	 $course_id=$_GET['cod'];
	 $user = $_SESSION['user'];

	 $user_id = $user['id'];
	 $batch_id = $_GET['enroll_id'];
	 $batch_details = fetch_all_data_usingDB($db, "select * from batch where id  = '$batch_id'");

	 $amount = $batch_details['amount'];


	 $check= fetch_all_data_usingDB($db, "select count(*) as 'count' from enrollment where student_id = '$user_id' and batch_id = '$batch_id'");

	

	 if($check['count'] != 0)
	 {

		header("Location: course_details.php?id=$course_id&exist=on");

	 	die();
	 }



	 $sql = "INSERT INTO enrollment (batch_id,student_id,amount,status) VALUES ('$batch_id', '$user_id', '$amount',0)";
		$db->query($sql);


		

	header("Location: course_details.php?id=$course_id&update=on");
	



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