<?php 
  
    require 'custom_function.php';

    session_start();

    if(!empty($_SESSION['admin']))
    {
        $admin = $_SESSION['admin'];
    }
    else
    {
      header('Location: login.php');

    }

    if(isset($_GET['course_id']))
    {
        $course_id = $_GET['course_id'];
    }
    else
    {
       header('Location: course_list.php');
    }

   
    $course_info = fetch_all_data_usingDB($db,"select * from course where id='$course_id';");

?>


<?php require 'd_header.php' ?>

<!-- ########## START: LEFT PANEL ########## -->
<?php require 'd_leftpanel.php' ?>
<!-- ########## END: LEFT PANEL ########## -->

<!-- ########## START: HEAD PANEL ########## -->
<?php require 'd_headpanel.php' ?>
<!-- ########## END: HEAD PANEL ########## -->

    

  <!-- ########## START: MAIN PANEL ########## -->
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.php">CMS</a>
      <span class="breadcrumb-item active">Course Edit</span>
    </nav>

    <div class="sl-pagebody"><!-- MAIN CONTENT -->
          <?php

            if(isset($_GET['update']))
            {
          ?>

           <div class="alert alert-success alert-dismissible" style="height: 50px;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
             <p style="color:black;">Information Updated!</p>
          </div>
          <?php 
            }
          ?>

          <?php

            if(isset($_GET['FileError']))
            {
          ?>

           <div class="alert alert-danger alert-dismissible" style="height: 50px;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
             <p style="color:black;">Invalid File Formate!</p>
          </div>
          <?php 
            }
          ?>

          <?php

            if(isset($_GET['FileAdded']))
            {
          ?>

           <div class="alert alert-warning alert-dismissible" style="height: 50px;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
             <p style="color:black;">File Added!</p>
          </div>
          <?php 
            }
          ?>

      <form action="action.php" method="POST" enctype="multipart/form-data">


        <input type="hidden" name="course_id" value="<?= $course_info['id'] ?>">
        <input type="hidden" name="course_image" value="<?= $course_info['image'] ?>">

          <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Course informations</h6>
            <p class="mg-b-20 mg-sm-b-30">Fillup the boxes</p>
            

            <div class="form-layout">
              <div class="row mg-b-25">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" style="color:black;">Course Name: </label>
                    <input class="form-control" type="text" name="course_name" value="<?= $course_info['course_name'] ?>" required>
                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" style="color:black;">Course Image: <span style="color:red;font-weight: 700;">(Upload if you want to change the image)</span> </label>
                    <input class="form-control" type="file" name="upload">
                  </div>
                </div><!-- col-4 -->
                
                
                 <div class="col-lg-4">
                  <div class="form-group">
                    <img src="<?= $course_info['image'] ?>" style="width: 200px;height: 100px;border: 5px solid #D3D3D3;">
                  </div>
                </div><!-- col-4 -->
               
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" style="color:black;">Course Details: </label>
                    <textarea rows="3" class="form-control" name="course_details"><?= $course_info['course_details'] ?></textarea>
                  </div>
                </div><!-- col-4 -->

              </div><!-- row -->

              <div class="form-layout-footer">
                <button class="btn btn-success mg-r-5" type="submit" name="CourseUpdate">Update</button>
                <a href="course_list.php" class="btn btn-dark">Back</a>

              </div><!-- form-layout-footer -->
              <?php

                if(isset($_GET['FileError']))
                {
              ?>
                 <p style="color:red;font-weight: 700;">Invalid File type! (Insert IMAGE)</p>
              
              <?php 
                }
              ?>

             


            </div><!-- form-layout -->
          </div><!-- card -->
        
      </form>
      <br>

        

    </div><!-- sl-pagebody --><!-- END MAIN CONTENT -->

  <?php require 'd_footer.php' ?>
  </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->

  <?php require 'd_javascript.php' ?>
  <script>
    $('#myTable').DataTable({
    bLengthChange: true,
    searching: true,
    responsive: true
  });
  </script>
  </body>
</html>
