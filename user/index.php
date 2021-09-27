<?php 
	


	session_start();
    if(!empty($_SESSION['user']))
    {
        $user = $_SESSION['user'];
        $user_name = $user['username'];
    }
    else
    {
      header('Location: ../login.php');

    }


	require '../db_config.php';


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


		$course_list = fetch_all_data_usingPDO($pdo, "select * from course order by id DESC");

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




<div class="container">
	<h2 class="text-center">
		Courses We Offer 
	</h2>


	<div class="row">

		<?php 


			foreach ($course_list as $key => $data) {
		?>


		<div class="col-4">

			<a href="course_details.php?id=<?= $data['id'] ?>" style="color:black;text-decoration:none;">
			<img src="<?php 

			$str =explode("../",$data['image']);

			echo '../'.$str[1];
			  ?>" style="width: 10rem;">
			<p>Course Name: 
				<span style="font-weight: 700;">
					<?= $data['course_name'] ?>
				</span>
				
			</p>

			</a>
		</div>

		<?php 
			}

		?>
		
	</div>
</div>













<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>