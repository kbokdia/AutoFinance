<?php
session_start();
require_once("authenticate.php");

if(!authenticate()){
	header("Location:index.php");
	exit;
}
?>
<html lang='en'>
<head>
	<title>AutoFinance :: New Post</title>
	<?php include('add-bootstrap.php'); ?>
	<script type="text/javascript">
		var districts = ["Kozhikode","Kasaragod","Idukki","Ernakulam","Cannanore","Mallapuram","Palghat","Pathanamthitta","Quilon","Trichur","Wayanad","Trivandrum","Kottayam","Alapuzzha"
];
		$(document).ready(function(event){
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
	<div id='wrapper' class='container'>
		<p>
			<h3 class='h3'>New Post</h3>
		</p>
		<form action='add-post.php' role='form' id='post_form'>
			<div class='row'>
				<div class='col-md-3'>
					<div class='form-group'>
						<label for='post'>Post</label>
						<input type='text' id='post' name='post' class='form-control' required='required'/>
					</div>
				</div><!--Close Col-->
			</div><!--Close Row-->
			<div class='row'>
				<div class='col-md-3'>
					<div class='form-group'>
						<label for='district'>District</label>
						<select name='district' id='district' class='form-control'>
						</select>
					</div>
				</div><!--Close Col-->
			</div><!--Close Row-->
			<div class='row'>
				<div class='col-md-3'>
					<div class='form-group'>
						<label for='pincode'>Pincode</label>
						<input type='number' id='pincode' name='pincode' class='form-control' required='required'/>
					</div>
				</div><!--Close Col-->
			</div><!--Close Row-->
			<div class='row'>
				<div class='col-md-3'>
					<div class='form-group'>
						<label for='state'>State</label>
						<input type='text' id='state' name='state' class='form-control' value='Kerala' readonly='readonly' />
					</div>
				</div><!--Close Col-->
			</div><!--Close Row-->
			<button type='submit' id='submit_btn' class='btn btn-default'>Submit</button>
		</form>
	</div>
	<script type="text/javascript">
		$('#post_form').submit(function(event){
			event.preventDefault();
			var post = $('#post').val();
			var	dist = $('#district').val();
			var	pin = $('#pincode').val();
			var	state = $('#state').val();

			console.log(dist+pin+state);

			var posting = $.post("add-post.php", {
				post: post,
				district: dist,
				pincode: pin,
				state: state,
			});

			posting.done(function(data){
				if (data == 1) {
					window.close();
				}else{
					alert("Something is incorrect!!!");
				}
			});
		});
	</script>
</body>
</html>