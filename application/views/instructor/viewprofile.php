<!DOCTYPE html>
<html lang="en">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin_pads.css') ?>">
	 
<head>
	<title>Profile- <?php echo $result->id_no?></title>
</head>
<br>
<body>
	<div class="container">
		<div class="row">

			<div class="col-sm-3">
				<div class="col-sm-12" align="center">
					<img src="<?php echo base_url('image/logout.png') ; ?>" alt="picture" id="reg_profile">
				</div>
				<div class="col-sm-12">
					<br>
				</div>
				<div class="col-sm-12" id="registration">
				<h4><b><?php echo $result->id_no?></b> <br> <i>Instructor</i></h4>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="col-sm-12" id="registration">
				<h4><i>Personal Information</i></h4>
				</div>
				<div class="col-sm-12"><br>
					<div class="col-sm-3">
						<label>Name</label>
					</div>
					<div class="col-sm-9">
						<p><?php echo $result->firstname?> <?php echo $result->middleinitial?> <?php echo $result->lastname?></p>
						
					</div><br>
					<div class="clearfix"></div>
					<br>

					<div class="col-sm-3">
						<label>College</label>
					</div>
					<div class="col-sm-9">
						<p><?php echo $result->college?></p>
					</div>	
					<div class="clearfix"></div><br>

					<div class="col-sm-3">
						<label>Gender</label>
					</div>
					<div class="col-sm-9">
						<p><?php echo $result->gender?></p>
					</div>	
					<div class="clearfix"></div><br>

					<div class="col-sm-3">
						<label>Address</label>
					</div>
					<div class="col-sm-9">
						<p><?php echo $result->address?></p>
					</div>
					<div class="clearfix"></div><br>

					<div class="col-sm-3">
						<label>Contact No.</label>
					</div>
					<div class="col-sm-9">
						<?php echo $result->contactnum?>
					</div>
					<div class="clearfix"></div><br>

					<div class="col-sm-3">
						<label>Email Address</label>
					</div>
					<div class="col-sm-9">
						<?php echo $result->email_add?>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		
			<div class="clearfix"></div>
		</div>
	</div>
</body>
</html>