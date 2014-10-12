<?php
session_start();
require_once("authenticate.php");
$str;

if(authenticate()){
  $str = "<nav class='navbar navbar-default' role='navigation'>
          <div class='container-fluid'>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class='navbar-header'>
              <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1'>
                <span class='sr-only'>Toggle navigation</span>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
              </button>
              <a class='navbar-brand' href='index.php'>Auto Finance</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
              <ul class='nav navbar-nav'>
                <li class='active'><a href='#'>Link</a></li>
            </ul>
            <form class='navbar-form navbar-left' role='search'>
                <div class='form-group'>
                  <input type='text' class='form-control' placeholder='Search'>
                </div>
                <button type='submit' class='btn btn-default'>Submit</button>
              </form>              
              <ul class='nav navbar-nav navbar-right'>
                <li class='dropdown'>
                  <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Hi ".$_SESSION['s_name']." <span class='caret'></span></a>
                  <ul class='dropdown-menu' role='menu'>
                    <li><a href='logout.php'>Logout</a></li>
                  </ul>
                </li>
              </ul>
              
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        <div id='name-list-table' class='container'>
          <h3 class='h3'>Namelist</h3>
          <table class='table'>
            <th>Name</th>
            <th>House</th>
            <th class='hidden-xs'>Added By</th>
            <th>Actions</th>
          </table>
        </div>
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
    <title>Bootstrap 101 Template</title>

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