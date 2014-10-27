<?php
session_start();
require_once("authenticate.php");
require_once("modules/Table.inc");
require_once("admin.php");
require_once("function_random_string.php");

if(!authenticate()){
	header("Location:index.php");
	exit;
}

if(isset($_POST['id'])){
	$memberData = array('mobile'=>$_POST['mobile'],'email'=>$_POST['email']);
	$memberData['password'] = $_POST['first_name'].random_string(4);

	$name = new Table("names");
	
	$data = array("first_name"=>$_POST['first_name'], "last_name"=>$_POST['last_name'],"middle_name"=>$_POST["middle_name"]);
	$name->save($data);
	$memberData["name_id"] = $name->getLastid();

	$message = "Hi ".$_POST['first_name']." ".$_POST['last_name']." ".$_POST['middle_name']."\n";
	$message .= "Thank for using Auto Finance. These are your credentials\n\n";
	$message .= "Email : ".$memberData['email']."\n";
	$message .= "Password : ".$memberData['password']."\n\n";
	$message .= "Click here to login <a href='http://www.incorelabs.com/AutoFinance'>Auto Finance</a>";
	$subject = "Auto Finance Credentials";
	
	mail($memberData['email'], $subject, $message,"From: kbokdia@incorelabs.com");

	$memberTable = new Table('members');
	
	if($_POST['id'] == 0){
		$memberTable->save($memberData);
	}

	header('Location:index.php');
}

if(in_array($_SESSION['s_username'],$admin)){
	$memberRowData = array(
			'id'=>0,
			'first_name'=>null,
			'last_name'=>null,
			'middle_name'=>null,
			'mobile'=>null,
			'email'=>null,
			);
}
else{
	header("Location:index.php");
}
?>
<html lang='en'>
<head>
	<title>Add Member</title>
	<?php include('add-bootstrap.html'); ?>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php include("add-navbar.php"); ?>
	
	<div id="wrapper" class="container">
		<div class='well well-lg'>
			<p>
				<center><h1 class='page-header title'>Member Details</h1></center>
			</p>
			<form role='form' action='add-member.php' method='post' id='member_form'>
				<div class='row'>
					<div class='panel panel-success'>
						<div class='panel-heading'>
							<h4 class='panel-title'>Name</h4>
						</div>
						<div class='panel-body'>
							<div class='row'>
								<div class='col-md-4'>
									<div class='form-group'>
										<label for='first_name'>First Name</label>
										<input id='first_name' name='first_name' class='form-control upper-case' value='<?php echo $memberRowData['first_name']; ?>' required='required' placeholder='Enter first name' />
									</div>
								</div>
								
								<div class='col-md-4 hidden-sm'>
									<div class='form-group'>
										<label for='middle_name'>Middle Name</label>
										<input id='middle_name' name='middle_name' class='form-control upper-case' value='<?php echo $memberRowData['middle_name']; ?>' placeholder='Enter middle name' />
									</div>
								</div>
								
								<div class='col-md-4'>
									<div class='form-group'>
										<label for='last_name'>Last Name</label>
										<input id='last_name' name='last_name' class='form-control upper-case' value='<?php echo $memberRowData['last_name']; ?>' placeholder='Enter last name'/>
									</div>
								</div>
							</div><!-- Close inner Row -->
						</div><!--Close Panel Body-->
					</div><!--Close panel-->
				</div><!--Close row-->
				<div class='row'>
					<div class='panel panel-success'>
						<div class='panel-heading'>
							<h4 class='panel-title'>Contact</h4>
						</div>
						<div class='panel-body'>
							<div class='row'>
								<div class='col-md-4'>
									<div class='form-group'>
										<label for='email'>Email</label>
										<input id='email' type='email' name='email' class='form-control upper-case' value='<?php echo $memberRowData['email']; ?>' required='required' placeholder='Enter email address' />
									</div>
								</div>
								<div class='col-md-4'>
									<div class='form-group'>
										<label for='mobile'>Mobile</label>
										<input id='mobile' type='number' name='mobile' class='form-control upper-case' value='<?php echo $memberRowData['mobile']; ?>' required='required' placeholder='Enter mobile number' />
									</div>
								</div>
							</div><!-- Close inner Row -->
						</div><!--Close Panel Body-->
					</div><!--Close panel-->
				</div><!--Close row-->
				<div class='row'>
					<div class='col-md-3'>
						<input type='hidden' name='id' value='<?php echo $memberRowData['id']; ?>' />
					</div>
				</div>
				<center>
					<button type='submit' class='btn btn-success btn-lg'>Submit</button>
				</center>
			</form>
		</div>
	</div>
</body>
</html>