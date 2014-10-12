<?php
session_start();
require_once("authenticate.php");
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
            <h3 class='h3'>Namelist</h3>
            <table class='table'>
              <th>Name</th>
              <th>House</th>
              <th>Added By</th>
              <th>Actions</th>
            </table>
          </p>
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AutoFinance</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div id="wrapper">
        <?php echo $str;?>
    </div>
    

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    
    </script>
  </body>
</html>