<?php
session_start();
require_once("authenticate.php");
require_once("modules/Table.inc");

$str;

if(authenticate()){

  $str = "<div id='header'>
            <p>
              <ul>
                <li>Hi ".$_SESSION['s_name']."</li>
                <li><a href='logout.php'>Logout</a></li>
              </ul>
            </p>
          </div>
          <br />
          <p>
            <a href='add-namelist-form.php'>Add new defaultor</a>
          </p>
          <p>
            <h3 class='h3'>Namelist</h3>
            <div id='namelist_table'></div>
          </p>
          <script type='text/javascript'>
            $(document).ready(function(event){
              getPostTableData();
            });

            function getPostTableData(){
              $.post('get-namelist-table.php',{require:'all'},function(data){
                  setPostTableData(data);
              });
            }

            function setPostTableData(data){
              $('#namelist_table').append(data);
            }
          </script>
          ";
}
else{
  $str = "<h3>Login</h3>
        <form action='checkuser.php' method='POST' role='form' id='login_form'>
          <div class='form-group'>
            <label for='email'>Email address</label>
            <input type='email' class='form-control' id='email' name='email' placeholder='Enter email'>
          </div>
          <div class='form-group'>
            <label for='password'>Password</label>
            <input type='password' class='form-control' id='password' name='password' placeholder='Password'>
          </div>
          <button type='submit' id='login_btn' class='btn btn-default'>Login</button>
        </form>";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>AutoFinance</title>
    <?php include("add-bootstrap.php"); ?>

  </head>
  <body>
    <div id="wrapper" class="container">
        <?php echo $str;?>
    </div>
    
    <script type="text/javascript">
    
    </script>
  </body>
</html>