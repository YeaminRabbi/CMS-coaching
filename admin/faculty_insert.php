<?php 
  

    session_start();
    require 'custom_function.php';

    if(!empty($_SESSION['admin']))
    {
        $admin = $_SESSION['admin'];
        $admin_name = $_SESSION['admin_name'];
    }
    else
    {
      header('Location: login.php');

    }

    $course_list = fetch_all_data_usingPDO($pdo, "select * from course order by id DESC");
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
      <span class="breadcrumb-item active">Faculty Information</span>
    </nav>

    <div class="sl-pagebody"><!-- MAIN CONTENT -->
          <?php

            if(isset($_GET['success']))
            {
          ?>

           <div class="alert alert-success alert-dismissible" style="height: 50px;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
             <p style="color:black;">Information Inserted!</p>
          </div>
          <?php 
            }
          ?>

          <?php

            if(isset($_GET['error']))
            {
          ?>

           <div class="alert alert-danger alert-dismissible" style="height: 50px;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
             <p style="color:black;">Information Error!</p>
          </div>
          <?php 
            }
          ?>

      <form action="action.php" method="POST" enctype="multipart/form-data">
          <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Faculty informations</h6>
            <p class="mg-b-20 mg-sm-b-30">Fillup the boxes</p>
            

            <div class="form-layout">
              <div class="row mg-b-25">
                
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" style="color:black;">Faculty Name: </label>
                    <input class="form-control" type="text" name="faculty_name" required>
                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" style="color:black;">Age: </label>
                    <input class="form-control" type="text" name="age" required>
                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" style="color:black;">Contact: </label>
                    <input class="form-control" type="text" name="contact" required>
                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" style="color:black;">Email: </label>
                    <input class="form-control" type="text" name="email" required>
                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" style="color:black;">Skills: </label>
                    <input class="form-control" type="text" name="skills" placeholder="PHP, C, JAVA, Graphics Design, Web development" required>
                  </div>
                </div><!-- col-4 -->

               

              </div><!-- row -->

              <div class="form-layout-footer">
                <button class="btn btn-info mg-r-5" type="submit" name="btn-faculty_insert">Submit</button>
                <a href="batch_list.php" class="btn btn-dark">Back</a>
                
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

      

    </div><!-- sl-pagebody --><!-- END MAIN CONTENT -->


  <?php require 'd_footer.php' ?>
  </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->

  <?php require 'd_javascript.php' ?>
  </body>
</html>
