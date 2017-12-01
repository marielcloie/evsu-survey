<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">

			<div class="col-md-5 col-sm-5 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<h4><i>Personal Information</i></h4>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-6">
					<p>Name</p>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-6">
					<p><?php echo $result->firstname?> <?php echo $result->middlename?> <?php echo $result->lastname?></p>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-6">
					<p>Gender</p>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-6">
					<p><?php echo $result->gender?></p>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-6">
					<p>Address</p>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-6">
					<p><?php echo $result->address?></p>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-6">
					<p>Contact number</p>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-6">
					<p><?php echo $result->contact_no?></p>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-6">
					<p>E-mail Address</p>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-6">
					<p><?php echo $result->email_add?></p>
				</div>
			</div>

			<div class="col-md-5 col-sm-5 col-xs-12">

				
				<div class="clearfix"></div>

				<div class="col-md-12 col-sm-12 col-xs-12">
					<h4><i>Account Information</i></h4>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-6">
					<p>Username</p>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-6">
					<p><?php echo $result->username?></p>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-6">
					<p>User type</p>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-6">
					<p><?php echo $result->userType?></p>
				</div>				
			</div>
			
			<div class="col-md-2 col-sm-2 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<h4><i>Action</i></h4>
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<a style="color: black;" class="btn btn-default btn-block bg-warning" href="<?php echo base_url('admin/edit_Admin/'.$result->username) ?>">Update</a></a>
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<a style="color: black;" class="btn btn-default btn-block bg-warning" href="<?php echo base_url('admin/changepassword') ?>">Change <br> Password</a></a>
				</div>
			</div>

		</div>
	</div>
</div>

<style type="text/css">
	h4 {background-color: #800000;padding: 10px; text-align: center; color: white;}
	

</style>
</body>
</html>