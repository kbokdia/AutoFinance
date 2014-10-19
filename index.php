<?php
session_start();
require_once("authenticate.php");
require_once("modules/Table.inc");

$str;

if(authenticate()){

  $str = "<div id='header'>

          <nav class='navbar navbar-inverse navbar-fixed-top' role='navigation'>
            <div class='container-fluid'>
              <div class='navbar-header'>
                <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1'>
                  <span class='sr-only'>Toggle navigation</span>
                  <span class='icon-bar'></span>
                  <span class='icon-bar'></span>
                  <span class='icon-bar'></span>
                </button>
                <a class='navbar-brand' href='index.php'>Auto Finance</a>
              </div>

              <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
                <ul class='nav navbar-nav'>
                  <li><a href='add-namelist-form.php'>New Defaulter</a></li>
                </ul>
                <ul class='nav navbar-nav navbar-right'>
                  <li class='dropdown'>
                    <a href='#' class='dropdown-toggle' data-toggle='dropdown'>".$_SESSION['s_name']."<span class='caret'></span></a>
                    <ul class='dropdown-menu' role='menu'>
                      <li class='nav-right'><a href='logout.php'>Logout</a></li>
                    </ul>
                  </li>
                </ul>
              </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
          </nav>
          </div>
          <br/>
          <p class='hello'>
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
                  <tr>
                    <td><input type='text' placeholder='Search' class='form-control' id='search_name' /></td>
                    <td><input type='text' placeholder='Search' class='form-control' id='search_house' /></td>
                    <td class='hidden-sm hidden-xs'><input type='text' placeholder='Search' id='search_member' class='form-control' /></td>
                  </tr>
                </thead>
                <tbody id='namelist_rows'></tbody>
              </div>
          </p>
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
  $str = "
      <div class='container'>
        <div class='well well-lg'>
        <h1 class='page-header'><center>Login</center></h1>
        <form action='checkuser.php' method='POST' role='form' id='login_form'>
          <div class='row'>
            <div class='form-group'>
              <div>
                <label for='email'>Email address</label>
                <input type='email' class='form-control' id='email' name='email' placeholder='Enter email' required='required'>
              </div>
            </div>
          </div>
          <div class='row'>
            <div class='form-group'>
              <div class='top'> 
                <label for='password'>Password</label>
                <input type='password' class='form-control' id='password' name='password' placeholder='Password' required='required'>
              </div>
            </div>
          </div>
          <center>
            <button type='submit' id='login_btn' class='btn btn-success btn-lg top'>Login</button>
          </center>
        </form>
        </div>
      </div>";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>AutoFinance</title>
    <?php include("add-bootstrap.php"); ?>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
  </head>
  <body>

    

    <div id="wrapper" class="container">

        <?php echo $str;?>
    </div>
    

    <script type="text/javascript">

      var is_all = true;
      $("#search_name").keyup(function(event){
          var name = $("#search_name").val();
          if(name == ""){
            if(is_all){
              return;
            }
            else{
              return setAllData();
            }
          }
          $('#namelist_rows').empty();
          $.post('get-namelist-table.php',{name: name},function(data){
              setPostTableData(data);
              is_all = false;
          });
      });

      $("#search_house").keyup(function(event){
          var house = $("#search_house").val();
          if(house == ""){
              if(is_all){
                return;
              }
              else{
                return setAllData();
              }
          }
          $('#namelist_rows').empty();
          $.post('get-namelist-table.php',{house:house},function(data){
            setPostTableData(data);
            is_all = false;
          });
      });

      $('#search_member').keyup(function(event){
          var member = $('#search_member').val();
          if(member == ""){
            if(is_all){
              return;
            }
            else{
              return setAllData();
            }
          }
          $('#namelist_rows').empty();
          $.post('get-namelist-table.php',{member:member},function(data){
            setPostTableData(data);
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