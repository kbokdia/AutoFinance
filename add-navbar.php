<?php
$navbar_str = "<div id='header'>

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
                    <a href='#' class='dropdown-toggle' data-toggle='dropdown'>".$_SESSION['s_name']." <span class='caret'></span></a>
                    <ul class='dropdown-menu' role='menu'>
                      <li class='nav-right'><a id='view_profile_btn' onclick='view_profile(event);' href='view-profile.php'><span class='glyphicon glyphicon-user'></span> &nbspMy details</a></li>
                      <li class='nav-right'><a href='logout.php'><span class='glyphicon glyphicon-log-out'></span> &nbspLogout</a></li>
                    </ul>
                  </li>
                </ul>
              </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
          </nav>
          </div>
          <div class='modal fade bs-example-modal-sm' id='view_member_modal' tabindex='-1' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-sm'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
                  <h4 class='modal-title text-center'>Profile</h4>
                </div><!--Header-->
                <div class='modal-body'>
                  <div id='view_member_modal_body'></div>
                </div>
              </div><!--modal-content-->
            </div><!--modal-dialog-->
          </div><!--view_member_modal-->
          <script type='text/javascript'>

            function view_profile(event){
              event.preventDefault();
              loc = $(event.target).attr('href');
              $.post(loc,function(data){
                $('#view_member_modal_body').empty();
                $('#view_member_modal_body').append(data);
                $('#view_member_modal').modal('show');
              })
            }
          </script>
          ";

echo $navbar_str;
?>