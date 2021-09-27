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

    $faculty_list = fetch_all_data_usingPDO($pdo, "select * from faculty order by id DESC");

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
      <span class="breadcrumb-item active">Create Batch</span>
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
            <h6 class="card-body-title">Batch informations</h6>
            <p class="mg-b-20 mg-sm-b-30">Fillup the boxes</p>
            

            <div class="form-layout">
              <div class="row mg-b-25">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" style="color:black;">Batch Code: </label>
                    <input class="form-control" type="text" name="batch_code" required>
                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" style="color:black;">Batch Name: </label>
                    <input class="form-control" type="text" name="batch_name" required>
                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" style="color:black;">Seat: </label>
                    <input class="form-control" type="number" min="1" name="seat" required>
                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" style="color:black;">Schedule Day: </label>
                    
                    <select class="form-control" name="schedule_day">
                      <option >--Select Option--</option>
                      <option value="Sun-Tue-Thur">Sun-Tue-Thur</option>
                      <option value="Sat-Mon-Wed">Sat-Mon-Wed</option>
                      <option value="Fri-Sat">Fri-Sat</option>
                    </select>
                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" style="color:black;">Schedule Time: </label>
                    
                    <select class="form-control" name="schedule_time">
                      <option >--Select Option--</option>
                      <option value="8:30am-10:00pm">8:30am-10:00pm</option>
                      <option value="10:30am-12:00pm">10:30am-12:00pm</option>
                      <option value="1:30pm-3:00pm">1:30pm-3:00pm</option>
                      <option value="3:30pm-5:00pm">3:30pm-5:00pm</option>


                    </select>
                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" style="color:black;">Course: </label>
                    
                    <select class="form-control" name="course_id">
                      <option >--Select Option--</option>
                      
                      <?php 

                        foreach ($course_list as $key => $data) {
                      ?>
                          <option value="<?= $data['id'] ?>" ><?= $data['course_name'] ?></option>
                      <?php     
                        }


                      ?>


                    </select>
                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" style="color:black;">Amount: </label>
                    <input class="form-control" type="number" min="1" name="amount" required>
                  </div>
                </div><!-- col-6 -->


                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" style="color:black;">Faculty: </label>
                     <select class="form-control" name="faculty">
                        <option >--Select Option--</option>
                        <?php

                          foreach ($faculty_list as $key => $data) {
                        ?>

                          <option value="<?= $data['id'] ?>" ><?= $data['faculty_name'] ?></option>


                        <?php 
                          }

                        ?>
                      </select>
                  </div>
                </div><!-- col-6 -->


                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" style="color:black;">Starting Date: </label>
                    <input class="form-control" type="date"  name="starting_date" required>
                  </div>
                </div><!-- col-6 -->

                 <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" style="color:black;">Ending Date: </label>
                    <input class="form-control" type="date"  name="ending_date" required>
                  </div>
                </div><!-- col-6 -->

              </div><!-- row -->

              <div class="form-layout-footer">
                <button class="btn btn-info mg-r-5" type="submit" name="btn-batch_insert">Submit</button>
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
