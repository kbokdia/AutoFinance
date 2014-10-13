<?php
session_start();
require_once("authenticate.php");
require_once("modules/Table.inc");

if(!authenticate()){
	header("Location:index.php");
	exit;
}
$name = new Table('names');
$constraint = array('id'=>$_SESSION['s_name_id']);
$first_name = $_SESSION['s_name'];
$last_name = $name->get('last_name',$constraint);
?>
<html lang="en">
<head>
	<title>AutoFinance :: Add new defaultor</title>
	<?php include("add-bootstrap.php");?>
</head>
<body>
	<div id="wrapper" class="container">
		<p>
			<h3 class='h3'>New Defaultor</h3>
		</p>
		<form role='form'>
			<div class='row'>
				<div class='panel panel-default'>
					<div class='panel-heading'>
						<h4 class='panel-title'>Name</h4>
					</div>
					<div class='panel-body'>
						<div class='col-md-3'>
							<div class='form-group'>
								<label for='first_name'>First Name</label>
								<input id='first_name' name='first_name' class='form-control' required='required'/>
							</div>
						</div><!--Close col-->
						<div class='col-md-3'>
							<div class='form-group'>
								<label for='middle_name'>Middle Name</label>
								<input id='middle_name' name='middle_name' class='form-control' />
							</div>
						</div><!--Close col-->
						<div class='col-md-3'>
							<div class='form-group'>
								<label for='last_name'>Last Name</label>
								<input id='last_name' name='last_name' class='form-control' required='required'/>
							</div>
						</div><!--Close col-->
					</div><!--Close panel body-->
				</div><!--Close panel-->
			</div><!--Close row-->
			<div class='row'>
				<div class='panel panel-default'>
					<div class='panel-heading'>
						<h4 class='panel-title'>Father's Name</h4>
					</div>
					<div class='panel-body'>
						<div class='col-md-3'>
							<div class='form-group'>
								<label for='father_first_name'>First Name</label>
								<input id='father_first_name' name='father_first_name' class='form-control' required='required' />
							</div>
						</div><!--Close col-->
						<div class='col-md-3'>
							<div class='form-group'>
								<label for='father_middle_name'>Middle Name</label>
								<input id='father_middle_name' name='father_middle_name' class='form-control'/>
							</div>
						</div><!--Close col-->
						<div class='col-md-3'>
							<div class='form-group'>
								<label for='father_last_name'>Last Name</label>
								<input id='father_last_name' name='father_last_name' class='form-control' required='required' />
							</div>
						</div><!--Close col-->
					</div><!--Close panel body-->
				</div><!--Close panel-->
			</div><!--Close row-->
			<div class='row'>
				<div class="panel panel-default">
				  <div class="panel-heading">
				    <h4 class="panel-title">Contact Details</h4>
				  </div>
				  <div class="panel-body">
				   	<div class='row'>
						<div class='col-md-3'>
							<div class='form-group'>
								<label for='house'>House Name</label>
								<input id='house' name='house' class='form-control' required='required' />
							</div>
						</div>
						<div class='col-md-3 hidden-sm'>
							
						</div>
						<div class='col-md-3'>
							<div class='form-group'>
								<label for='mobile'>Mobile</label>
								<input id='mobile' name='mobile' class='form-control' required='required' />
							</div>
						</div>
					</div><!--Close row-->
					<div class='row'>
						<div class='col-md-3'>
							<div class='form-group'>
								<label for='address1'>Address Line 1</label>
								<input id='address1' name='address1' class='form-control'/>
							</div>
						</div>
						<div class='col-md-3 hidden-sm'>
							
						</div>
						<div class='col-md-3'>
							<div class='form-group'>
								<label for='phone'>Landline</label>
								<input id='phone' name='phone' class='form-control' />
							</div>
						</div>
					</div><!--Close row-->
					<div class='row'>
						<div class='col-md-3'>
							<div class='form-group'>
								<label for='address2'>Address Line 2</label>
								<input id='address2' name='address2' class='form-control'/>
							</div>
						</div>
					</div><!--Close row-->
					<div class='row'>
						<div class='col-md-3'>
							<div class='form-group'>
								<label for='post'>Post</label>
								<select id='post' name='post' class='form-control'>
								</select>
								<a href="add-post-form.php" id='post_btn' target='_blank'>New Post</a>
							</div>
						</div>
					</div><!--Close row-->
				  </div>
				</div><!--Close contact panel-->
			</div><!--Close Contact row-->
			<div class='row'>
				<div class='col-md-3'>
					<input type='hidden' name='member_id' value='<?php echo $_SESSION['s_id']; ?>' />
					<p>
						<h5 class='h5'>Added By</h5><?php echo $first_name." ".$last_name; ?>
					</p>
				</div>
			</div>
			<button type='submit' class='btn btn-default'>Submit</button>
		</form>
	</div>
	<script type="text/javascript">
		
	</script>
</body>
</html>
