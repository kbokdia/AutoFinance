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
                    <a href='#' class='dropdown-toggle' data-toggle='dropdown'>".$_SESSION['s_name']."<span class='caret'></span></a>
                    <ul class='dropdown-menu' role='menu'>
                      <li class='nav-right'><a href='logout.php'>Logout</a></li>
                    </ul>
                  </li>
                </ul>
              </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
          </nav>
          </div>";

echo $navbar_str;
?>