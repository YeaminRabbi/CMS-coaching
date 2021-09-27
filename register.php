<?php 
	
	require 'db_config.php';


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





	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
	  <!-- Brand/logo -->
	  <a class="navbar-brand" href="#">CMS</a>
	  
	  <div class="container">
	  	
	  
	  <!-- Links -->
	  <ul class="navbar-nav">
	    <li class="nav-item">
	      <a class="nav-link" href="index.php">Home</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link" href="login.php">Login</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link" href="register.php">Register</a>
	    </li>
	  </ul>

	  </div>
	</nav>


<div class="container">
		<div class="registration_form">
			<h3 class="text-center">Student Registration Form</h3>
			<form action="action.php" method="POST" enctype="multipart/form-data">
				
			  <div class="row">
			    <div class="col">
			      <label>Name:</label>
			      <input type="text" class="form-control" placeholder="Enter name" name="name">
			    </div>

			    <div class="col">
			      <label>Email:</label>
			      <input type="email" class="form-control" placeholder="Enter email" name="email">
			    </div>

			    <div class="col">
			      <label>Date of Birth:</label>
			      <input type="date" class="form-control" placeholder="Enter Birth date" name="dob">
			    </div>
			  </div>

			  <div class="row mt-4">
			    <div class="col">
			      <label>Phone Number:</label>
			      <input type="text" class="form-control" placeholder="Enter phone number" name="phone">
			    </div>

			    <div class="col">
			      <label>NID/Birth Certificate:</label>
			      <input type="text" class="form-control" placeholder="Enter NID no." name="nid">
			    </div>

			    <div class="col">
			      <label>Address:</label>
			      <input type="text" class="form-control" placeholder="Enter Address" name="address">
			    </div>
			  

			  

			    <div class="col">
			      <label>Password:</label>
			      <input type="password" class="form-control" placeholder="Enter Password" name="password">
			    </div>

			   
			  </div>

			    
			  <button class="btn btn-outline-primary mt-3" name="btn-register">Submit</button>

			  
			</form>
			<?php 

			      	if(isset($_GET['imsg']))
			      	{
			      ?>	
			      <br>
			      <br>
			      <span style="color: green;font-weight: 700;">Your informations have been submitted</span>
			      <br><a href="login.php" class="btn btn-warning">Login</a>
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