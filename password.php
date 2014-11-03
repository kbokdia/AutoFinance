<?php
session_start();
require_once("authenticate.php");
require_once("modules/Table.inc");

if(!authenticate()){
	header("Location:index.php");
	exit;
}

if(isset($_POST['password'])){
	$memberTable = new Table('members');
	$memberTable->save(array('password'=>$_POST['password']),array('id'=>$_SESSION['s_id']));
	$memberTable->close();
	header('Location:index.php?alert=2');
}

?>
<html lang='en'>
<head>
	<title>AutoFinance :: Change Password</title>
	<?php include('add-bootstrap.html'); ?>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php include("add-navbar.php"); ?>
	
	<div class='login_bg'>
        <div class='login'>
	      <div class='login-screen'>
	        <div class='app-title'>
	          <h1>Change Password</h1>
	        </div>

	        <div class='login-form'>
	          
	          <form action='password.php' method='POST' role='form' id='password_form'>
		          <div class='form-group'>
			          <input type='password' class='login-field login_main' id='c_password' name='c_password' placeholder='Enter Current Password' required='required' autofocus='autofocus' />
			          <label class='login-field-icon fui-lock' for='c_password'></label>
		          </div>

		          <div class='control-group'>
		          	<input type='password' class='login-field login_main' id='password' name='password' placeholder='Enter New Password' required='required'>
		          	<label class='login-field-icon fui-lock' for='password'></label>
		          </div>

		          <div class='control-group'>
		          	<input type='password' class='login-field login_main' id='r_password' name='r_password' placeholder='Re-Enter New Password' required='required'>
		          	<label class='login-field-icon fui-lock' for='password'></label>
		          </div>

	          	  <button type='submit' id='submit_btn' class='btnnew'>Submit</button>
	          </form>
	        </div><!--Login form-->
	      </div><!--Login Screen-->
    	</div><!--Login-->
    </div><!--Login_bg-->
    <script type="text/javascript">
    	var flag =[];
    	$('#c_password').focusout(function(event){
    		var password = $('#c_password').val();
    		var posting = $.post('get-password.php',{password:password}); 

    		posting.done(function(data){
    			if(data == '1'){
    				$('#c_password').css("border","2px solid green");
    				flag[0] = true;
    			}
    			else{
    				$('#c_password').css("border","2px solid red");
    				flag[0] = false
    			}
    		});
    	});

    	$('#password').focusout(function(event){
    		var password = $('#password').val();
    		if (password.length > 4) {
    			$('#password').css("border","2px solid green");
    			flag[1] = true;
    		}
    		else{
    			$('#password').css("border","2px solid red");
    			flag[1] = false
    		}
    	});

    	$('#r_password').keyup(function(event){
    		var password = $('#password').val();
    		var r_password = $('#r_password').val();
    		if(password == r_password){
    			$('#r_password').css("border","2px solid green");
    			flag[2] = true;
    		}
    		else{
    			$('#r_password').css("border","2px solid red");
    			flag[2] = false
    		}
    	});

    	$('#password_form').submit(function(event){
    		var canSubmit = true;

    		for(f in flag){
    			if (!flag[f]) {
    				canSubmit = false;
    				break;
    			};
    		}

    		if (!canSubmit) {
    			event.preventDefault();
    		}
    	});
    </script>
</body>
</html>