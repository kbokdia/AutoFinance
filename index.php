<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Auto Finance</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <?php include('add-bootstrap.html'); ?>
  </head>
  <body>

<?php
session_start();
require_once("authenticate.php");
require_once("modules/Table.inc");

$str;

if(authenticate()){
  include("add-navbar.php");
  $alert_msg = "";

  if (isset($_GET['alert'])) {
    if ($_GET['alert'] == 1) {
      $alert_msg = "<div class='alert alert-success' role='alert'>New member has been registered. Please check the registered email to know the password</div>";
    }
    elseif ($_GET['alert'] == 2) {
      $alert_msg = "<div class='alert alert-success' role='alert'>Password has changed successfully!!!</div>";
    }
  }

  $str = "<br/>
          <p class='hello'>".$alert_msg."

          <input class='search_input search_wrap' type='text' id='search_name' placeholder='Search'>
          <input class='search_input search_wrap' type='submit'>
          
            <h3 class='h1'><center>Namelist</center></h1>
            <div id='namelist_table'>
              <table class='table table-striped'>
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>House</th>
                    <th class='hidden-sm hidden-xs'>Added By</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id='namelist_rows'></tbody>
              </div>
          </p>

          <div class='modal fade bs-example-modal-sm' id='view_namelist_modal' tabindex='-1' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-sm'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
                  <h4 class='modal-title text-center'>Defaulter</h4>
                </div><!--Header-->
                <div class='modal-body'>
                  <div id='view_namelist_modal_body'></div>
                </div>
              </div><!--modal-content-->
            </div><!--modal-dialog-->
          </div><!--view_namelist_modal-->
          
          <script type='text/javascript'>
            $(document).ready(function(event){
              getPostTableData();
            });
      
            function deleteName(event){
              event.preventDefault();
              if(confirm('Are you sure?')){
                var id = $(event.target).attr('href');
                $('#namelist_rows').empty();

                $.post('delete-namelist.php',{id:id},function(data){
                  getPostTableData();
                });
              }
            }

            function viewMember(event){
              event.preventDefault();
              var id = $(event.target).attr('href');
              
              $.post('view-namelist.php',{id:id},function(data){
                $('#view_namelist_modal_body').empty();
                $('#view_namelist_modal_body').append(data);
                $('#view_namelist_modal').modal('show');
              });
            }

            function getPostTableData(){
              $.post('get-namelist-table.php',{require:'all'},function(data){
                  setPostTableData(data);
              });
            }

            function setPostTableData(data){
              $('#namelist_rows').append(data);
            }

          </script>
          ";
}
else{
  $alert_msg = "";

  if(isset($_GET['error'])){
    $alert_msg = "<div class='alert alert-danger' role='alert'>".$_GET['error']."</div>";
  }
  
  $str = "
      <div class='login_bg'>
        <div class='login'>
        <div class='login-screen'>
          <div class='app-title'>
            <h1>Login</h1>
          </div>

          <div class='login-form'>
            
            <form action='checkuser.php' method='POST' role='form' id='login_form'>
              <div class='control-group'>
                <input type='text' class='login-field login_main' id='email' name='email' placeholder='Email or Mobile' required='required' autofocus='autofocus' />
                <label class='login-field-icon fui-user' for='email'></label>
              </div>

              <div class='control-group'>
                <input type='password' class='login-field login_main' id='password' name='password' placeholder='Enter Password' required='required'>
                <label class='login-field-icon fui-lock' for='password'></label>
              </div>

                <button type='submit' id='login_btn' class='btnnew'>login</button>
            </form>
            ".$alert_msg."
          </div><!--Login form-->
        </div><!--Login Screen-->
      </div><!--Login-->
    </div><!--Login_bg-->";
}
?>
    <div id="wrapper" class="container">

        <?php echo $str;?>
    </div>
    
    <script src='js/script.js' type='text/javascript'></script>

    <script type="text/javascript">

      var is_all = true;
      $("#search_name").keyup(function(event){
          var name = $("#search_name").val();

          $.post('get-namelist-table.php',{name: name},function(data){
            $('#namelist_rows').empty();
              setPostTableData(data);
              is_all = false;
          });
      });

      

      function setAllData(){
        $('#namelist_rows').empty();
        getPostTableData();
        is_all = true;
        return;
      }
    </script>
  </body>
</html>