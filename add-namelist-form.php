<?php
session_start();
require_once("authenticate.php");
require_once("modules/Table.inc");

if(!authenticate()){
	header("Location:index.php");
	exit;
}
// This is for getting information about the adder
$name = new Table('names');
$constraint = array('id'=>$_SESSION['s_name_id']);
$first_name = $_SESSION['s_name'];
$last_name = $name->get('last_name',$constraint);

// This section gets data if id is mentioned else nullifies array 
$nameListRowData;
if(isset($_GET['id'])){
	include('get-namelist-array.php');
	$nameListTable = new Table('namelist');
	$nameList_arr = $nameListTable->getALLValues(array('id'=>$_GET['id']));
	$nameListRowData = getRowValues($nameList_arr[0]);
}else{
	$nameListRowData = array(
			'id'=>0,
			'first_name'=>null,
			'last_name'=>null,
			'middle_name'=>null,
			'f_first_name'=>null,
			'f_last_name'=>null,
			'f_middle_name'=>null,
			'house'=>null,
			'address1'=>null,
			'address2'=>null,
			'phone'=>null,
			'mobile'=>null,
			'post_id'=>0,
			'photo'=>null,
			'vehicle_id'=>null
			);
}
?>
<html lang="en">
<head>
	<title>AutoFinance :: Add new defaultor</title>
	<?php include('add-bootstrap.html'); ?>

	<link href="style.css" rel="stylesheet" type="text/css">
	

	<script type="text/javascript">
		var districts = ["Kozhikode","Kasaragod","Idukki","Ernakulam","Cannanore","Mallapuram","Palghat","Pathanamthitta","Quilon","Trichur","Wayanad","Trivandrum","Kottayam","Alapuzzha"
];

		function getPostData(){
			$.post("get-post.php",{post: <?php echo $nameListRowData['post_id'] ;?>},function(data){
				setPostData(data);
			});
		}

		function setPostData(data){
			$('#post').append(data);
			//console.log(data);
		}

		
		function createPost(){
			//event.preventDefault();
			
		}

		$(document).ready(function(event){
			getPostData();

			var str = "";
			districts.sort();
			for(i=0; i<districts.length;i++){
				str += "<option>"+districts[i]+"</option>";
			}
			$("#district").append(str);
		});
	</script>

</head>
<body>

    <?php include("add-navbar.php"); ?>

	<div id="wrapper" class="container">
		<div class='well well-lg'>
		<p>
			<center><h1 class='page-header title'>New Defaulter</h1></center>
		</p>
		<form role='form' action='add-namelist.php' method='post' id='namelist_form'>
			<div class='row'>
				<div class='panel panel-success'>
					<div class='panel-heading'>
						<h4 class='panel-title'>Name</h4>
					</div>
					<div class='panel-body'>
						<div class='row'>
							<div class='col-md-5'>
								<div class='form-group'>
									<label for='first_name'>Full Name</label>
									<input id='first_name' name='first_name' class='form-control upper-case' value='<?php echo $nameListRowData['first_name']; ?>' required='required' placeholder='Enter name as "Joseph Sunny"' />
								</div>
							</div>
							
							<div class='col-md-1 hidden-sm'>
							
							</div>
							
							<div class='col-md-5'>
								<div class='form-group'>
									<label for='last_name'>Initials</label>
									<input id='last_name' name='last_name' class='form-control all-upper-case' value='<?php echo $nameListRowData['last_name']; ?>' placeholder='Enter initials as "S.V"'/>
								</div>
							</div>
						</div><!-- Close inner Row -->
					</div><!--Close Panel Body-->
				</div><!--Close panel-->
			</div><!--Close row-->
			<div class='row'>
				<div class='panel panel-success'>
					<div class='panel-heading'>
						<h4 class='panel-title'>Father's Name</h4>
					</div>
					<div class='panel-body'>
						<div class='row'>
							<div class='col-md-5'>
								<div class='form-group'>
									<label for='father_first_name'>Full Name</label>
									<input id='father_first_name' name='father_first_name' class='form-control upper-case' value='<?php echo $nameListRowData['f_first_name']; ?>' required='required' placeholder='Enter name as "Sunny Johnson"'/>
								</div>
							</div>
		
							<div class='col-md-1 hidden-sm'>
	
							</div>
		
							<div class='col-md-5'>
								<div class='form-group'>
									<label for='father_last_name'>Initials</label>
									<input id='father_last_name' name='father_last_name' class='form-control all-upper-case' value='<?php echo $nameListRowData['f_last_name']; ?>' placeholder='Enter initials as "V.K"'/>
								</div>
							</div>
						</div><!-- Close inner Row -->
					</div><!--Close Panel Body-->
				</div><!--Close panel-->
			</div><!--Close row-->
			<div class='row'>
				<div class="panel panel-success">
					<div class="panel-heading">
					<h4 class="panel-title">Contact Details</h4>
					</div>
					<div class="panel-body">
						<div class='row'>
							<div class='col-md-5'>
								<div class='form-group'>
								<label for='house'>House Name</label>
								<input id='house' name='house' class='form-control all-upper-case' value='<?php echo $nameListRowData['house']; ?>' required='required' placeholder='Enter House Name'/>
							</div>
						</div>
						
					</div><!--Close row-->
					<div class='row'>
						<div class='col-md-5'>
							<div class='form-group'>
								<label for='address1'>Address Line 1</label>
								<input id='address1' name='address1'value='<?php echo $nameListRowData['address1']; ?>' class='form-control' placeholder='Enter Address'/>
							</div>
						</div>
						<div class='col-md-1 hidden-sm'>
							
						</div>
						<div class='col-md-5'>
							<div class='form-group'>
								<label for='address2'>Address Line 2</label>
								<input id='address2' name='address2' value='<?php echo $nameListRowData['address2']; ?>' class='form-control' placeholder='Enter Address'/>
							</div>
						</div>

					</div><!--Close row-->
					<div class='row'>
						<div class='col-md-5'>
							<div class='form-group'>
								<label for='mobile'>Mobile</label>
								<input id='mobile' name='mobile' class='form-control' value='<?php echo $nameListRowData['mobile']; ?>' placeholder='Enter mobile as "9876543210"'/>
							</div>
						</div>

						<div class='col-md-1 hidden-sm'>
							
						</div>
						
						<div class='col-md-5'>
							<div class='form-group'>
								<label for='phone'>Landline</label>
								<input id='phone' name='phone' value='<?php echo $nameListRowData['phone']; ?>' class='form-control' placeholder='Enter phone as "044-26789123"'/>
							</div>
						</div>
					</div><!--Close row-->
					<div class='row'>
						<div class='col-md-5'>
							<div class='form-group'>
								<label for='post'>Post</label>
								<select id='post' name='post' class='form-control'>
								</select>
								<a href='#NewPost' class='btn btn-danger label-top' data-toggle='modal' data-target='.bs-modal-sm' id='post_btn'>New Post</a>
							</div>
						</div>
					</div><!--Close row-->
				  </div>
				</div><!--Close contact panel-->
			</div><!--Close Contact row-->
			<div class='row'>
				<div class='panel panel-success'>
					<div class='panel-heading'>
						<h4 class='panel-title'>Reason</h4>
					</div>
					<div class='panel-body'>
						<div class='row'>
							<div class='checkbox' style='padding-left:10px'>
								
									<label><input type='checkbox' name='reason[]' value='Court Case' /> Court Case</label><br />
									<label><input type='checkbox' name='reason[]' value='Party dues defaulting' /> Party Dues defaulting</label><br />
									<label><input type='checkbox' name='reason[]' value='Liquor' /> Liquor </label><br />
									<label><input type='checkbox' name='reason[]' value='Sand mining' /> Sand Mining</label><br />
									<label><input type='checkbox' name='reason[]' value='Political problem' /> Political Problem </label><br />
									<label><input type='checkbox' name='reason[]' value='Absconding party' /> Absconding Party </label><br />
								
							</div>
						</div><!-- Close inner Row -->
					</div><!--Close Panel Body-->
				</div><!--Close panel-->
			</div><!--Close row-->
			<div class='row'>
				<div class='col-md-3'>
					<input type='hidden' name='member_id' value='<?php echo $_SESSION['s_id']; ?>' />
					<input type='hidden' name='id' value='<?php echo $nameListRowData['id']; ?>'>
					<p>
						<h5 class='h5'>Added By</h5><?php echo $first_name." ".$last_name; ?>
					</p>
				</div>
			</div>
			<center>
				<button type='submit' id='submit_namelist' class='btn btn-success btn-lg'>Submit</button>
			</center>
		</form>
	</div>

<!-- Start of New Post -->

<div class="modal fade bs-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" >
	<div class="modal-dialog modal-sm">
		<div class="modal-content">        
			<div class="modal-body">
				<center class="modal-header"><h3>New Post</h3></center>
					<div id="myTabContent" class="tab-content" style="padding-top: 20px;">
						<div class="tab-pane fade active in" id="signin">
							<form class="form-horizontal" id='post_form' role="form">
								<fieldset>
<!-- New Post -->

	<!-- Post -->
								<div class="control-group">
									<div class="controls">
										<label for='post_name'>Post</label>
										<input type='text' id='post_name' name='post_name' class='form-control add' required='required' placeholder="Enter New Post"/>
									</div>
								</div>

	<!-- District -->
								<div class="control-group">
									<div class="controls">
										<label for='district' class="label-top">District</label>
										<select name='district' id='district' class='form-control add'>
											<option selected="true">Select District</option>
										</select>
									</div>
								</div>

	<!-- Pincode -->
								<div class="control-group">
									<div class="controls">
										<label for='pincode' class="label-top">Pincode</label>
										<input type='number' id='pincode' name='pincode' class='form-control add' required='required' placeholder="Enter Pincode"/>
									</div>
								</div>

	<!-- State -->
								<div class="control-group">
									<div class="controls">
										<label for='state' class="label-top">State</label>
										<input type='text' id='state' name='state' class='form-control add' value='Kerala' readonly='readonly' />
									</div>
								</div>
								</fieldset>
							</form>
						</div>
					</div>
				<div class="modal-footer">
					<center>
						<button type='button' id='post_submit_btn' class='btn btn-success'>Submit</button>
						<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
					</center>
				</div><!--close footer-->
		</div><!--close modal-content-->
	</div><!--close modal-dialog-->
</div><!--close modal-->  
</div>
	<script src='js/script.js' type='text/javascript'></script>
	<script type="text/javascript">
		$('#namelist_form').submit(function(event){
			var checkedAtLeastOne = false;
			$('input[type="checkbox"]').each(function() {
			    if ($(this).is(":checked")) {
			        checkedAtLeastOne = true;
			    }
			});
			if(!checkedAtLeastOne){
				alert("Please select any one Reason !!!");
				event.preventDefault();
			}
		});

		$('#post_submit_btn').click(function(event){
			var post = $('#post_name').val();
			var	dist = $('#district').val();
			var	pin = $('#pincode').val();
			var	state = $('#state').val();

			//console.log(dist+pin+state);

			var posting = $.post("add-post.php", {
				post: post,
				district: dist,
				pincode: pin,
				state: state,
			});

			posting.done(function(data){
				if (data == 1) {
					$('#myModal').modal('hide');
					$('#post').empty();
					getPostData();
					$('#post_form').find("#post_name,#pincode").val("");
				}else{
					alert("Something is incorrect!!!");
				}
			});
		});
		
	</script>
</body>
</html>
