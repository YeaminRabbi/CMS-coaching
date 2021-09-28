<?php 
	
	require '../db_config.php';



	session_start();
    if(!empty($_SESSION['user']))
    {
        $user = $_SESSION['user'];
        $user_name = $user['username'];
        $user_id = $user['id'];
    }
    else
    {
      header('Location: ../login.php');

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
		if(isset($_GET['id']))
		{
			$course_id = $_GET['id'];
		}

		$enrolled_courses = fetch_all_data_usingPDO($pdo, "select * from enrollment join batch on enrollment.batch_id = batch.id where enrollment.student_id = '$user_id' and enrollment.status=0");
		

		
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CMS</title>
</head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">



<body>





	<?php require 'navbar.php';  ?>




<div class="container mt-3">
 

  <h2>Enrolled Course List with pending FEES</h2>
  
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Batch Code</th>
        <th>Batch name</th>
        <th>Day</th>
        <th>Time</th>
        <th>Fees</th>
        <th>Available Seat</th>

      </tr>
    </thead>
    <tbody>


    	<?php 

    		foreach ($enrolled_courses as $key => $data) {
    	?>
	 		<tr>
		        <td><?= $data['batch_code'] ?></td>
		        <td><?= $data['batch_name'] ?></td>
		        <td><?= $data['schedule_day'] ?></td>
		        <td><?= $data['schedule_time'] ?></td>
		        <td><?= $data['amount'] ?></td>
		        <td><?= $data['seat'] ?></td>
		        

		      </tr>
    	<?php 
    		}

    	?>
     
      
    </tbody>
  </table>
</div>









<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>