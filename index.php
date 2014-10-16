<?php
session_start();
require_once("authenticate.php");
require_once("modules/Table.inc");

$str;

if(authenticate()){
  include("get-namelist-array.php");

  $nameListTable = new Table('namelist');
  $nameListDataTable = array();
  $nameList = $nameListTable->getAll();

  foreach ($nameList as $key => $value) {
    array_push($nameListDataTable, getRowValues($value));    
  }


  $nameListTable->close();

  $table_str = "";

  foreach ($nameListDataTable as $key => $row) {
    $table_str .= "<tr>";
    $table_str .= "<td>".$row['name']."</td>";
    $table_str .= "<td>".$row['house']."</td>";
    $table_str .= "<td class='hidden-sm hidden-xs'>".$row['added']."</td>";
    $table_str .= "<td><a href='add-namelist-form.php?id=".$row['id']."'>Edit</a>&nbsp&nbsp<a href='#'>Delete</a></td>";
    $table_str .= "</tr>";
  }

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
            <table class='table'>
              <th>Name</th>
              <th>House</th>
              <th class='hidden-sm hidden-xs'>Added By</th>
              <th>Actions</th>".$table_str."
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