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


    $pending_list = fetch_all_data_usingPDO($pdo,'select * from enrollment join batch on enrollment.batch_id = batch.id join users on enrollment.student_id = users.id where enrollment.status=0');

    $pending = fetch_all_data_usingPDO($pdo, "select * from enrollment where status = 0 ");
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
      <span class="breadcrumb-item active">Faculty List</span>
    </nav>

    <div class="sl-pagebody"><!-- MAIN CONTENT -->
      <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Faculty Details</h6>
          
          <?php

            if(isset($_GET['update']))
            {
          ?>

           <div class="alert alert-success alert-dismissible" style="height: 50px;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
             Product Updated Successfully!
          </div>
          <?php 
            }
          ?>


          <?php

            if(isset($_GET['delete']))
            {
          ?>

           <div class="alert alert-danger alert-dismissible" style="height: 50px;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
              Deleted Successfully!
          </div>
          <?php 
            }
          ?>
         
          <div class="table-wrapper">
            <table id="myTable" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th >SL</th>

                  <th>Batch Code</th>
                  <th>Student name</th>
                  <th>Day</th>
                  <th>Time</th>
                  <th>Fees</th>
                  <th>Available Seat</th>

                  <th >Action</th>
                  
                </tr>
              </thead>
              <tbody>
                
                <?php

                    foreach ($pending_list as $key => $data) {
                ?>


                         <?php 


                          $enroll_id = $pending[$key]['id'];
                         ?>
                        
                    <tr>
                      <td><?php echo $key+1; ?></td>
                      <td><?= $data['batch_code'] ?></td>
                      <td><?= $data['username'] ?></td>
                      <td><?= $data['schedule_day'] ?></td>
                      <td><?= $data['schedule_time'] ?></td>
                      <td><?= $data['amount'] ?></td>
                      <td><?= $data['seat'] ?></td>
                     
                      <input type="hidden" name="course_id" class="pid" value="<?= $course_id ?> ">
                      
                      <td>
                      <a href="action.php?approve_id=<?= $enroll_id ?>" class="btn btn-success itemBUTTON">Approve</a>
                        

                      </td>
                    </tr>
                <?php
                    }

                ?>
               
                
               
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div>    

      
    </div><!-- sl-pagebody --><!-- END MAIN CONTENT -->


  <?php require 'd_footer.php' ?>
  </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->

  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function(){

      $(".itemBUTTON").on('click', function(){
        var $el =$(this).closest('tr');

        var pid = $el.find(".pid").val();
        
        location.reload(true);


        $.ajax({
          url: 'action.php',
          method: 'post',
          cache : false,
          data: {pid:pid},
          success: function(response){

            console.log(response);
          }
        });
      });
      
    });


  </script>


 
  <?php require 'd_javascript.php' ?>

 <!-- jQuery library -->
 


  
   <script>
    $('#myTable').DataTable({
    bLengthChange: true,
    searching: true,
    responsive: true
  });
  </script>
  </body>
</html>
