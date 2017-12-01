<!DOCTYPE html>
<html lang="en">
	 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin_pads.css') ?>">
<head>
	<title>Add Student</title>
	<script src="<?php echo base_url('assets/bootstrap/js/jquery.min.js') ?>"></script>
  	<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
  	<script src="<?php echo base_url('assets/automatic-dash.js') ?>"></script>
</head>

<body>
	<div class="container">
		<div class="row">
		
		<?php if (!empty(validation_errors())): ?>
				<div class="col-md-12 col-sm-12 col-xs-12 alert alert-danger">
					<?php echo validation_errors(); ?>
				</div>
		<?php endif ?>

		<form action="" method="POST">
			<div class="col-sm-6">
				<div class="col-sm-12" id="registration">
				<h4><i>Personal Information</i></h4>
				</div>
				<div class="col-sm-12"><br>
					<div class="col-sm-3">
						<label>Name</label>
					</div>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="lastname" value="<?php echo set_value('lastname');?>" required>
						<small class="help-block">Last name</small>
						<input class="form-control" type="text" name="firstname" value="<?php echo set_value('firstname');?>" required>
						<small class="help-block">First name</small>
						<input class="form-control" type="text" name="middleinitial" value="<?php echo set_value('middleinitial');?>" required>
						<small class="help-block">Middle Initial</small>
					</div><br>
					<div class="clearfix"></div>
					<br>

					<div class="col-sm-3">
						<label>Gender</label>
					</div>
					<div class="col-sm-9">
						<div class="col-sm-6">
							<input type="radio" name="gender" value="Male" checked="checked" >Male
						</div>
						<div class="col-sm-6">
							<input type="radio" name="gender" value="Female">Female
						</div>
					</div>	
					<div class="clearfix"></div><br>

					<div class="col-sm-3">
						<label>Address</label>
					</div>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="address" value="<?php echo set_value('address');?>" required>
					</div>
					<div class="clearfix"></div><br>

					<div class="col-sm-3">
						<label>Contact No.</label>
					</div>
					<div class="col-sm-9">
						<input class="form-control" type='text' id="PhoneNo" name='contactnum' maxlength='13' value="<?php echo set_value('contactnum');?>" required>
					</div>
					<div class="clearfix"></div><br>

					<div class="col-sm-3">
						<label>Email Address</label>
					</div>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="email_add" value="<?php echo set_value('email_add');?>" required>
					</div>
					<div class="clearfix"></div><br>
				</div>

				<div class="col-sm-12" id="registration">
				<h4><i>Course Information</i></h4>
				</div>
				<div class="col-sm-12"><br>
					<div class="col-sm-3">
						<label>Department</label>
					</div>
					<div class="col-sm-9">
						<select class="btn-block" name="course" required>
							<option value="">Please choose course</option>
							<?php foreach ($courses as $c_info): ?>
								<option value="<?php echo $c_info->course_name ?>"><?php echo $c_info->course_name ?></option>
							<?php endforeach ?>
						</select>

					</div><br>
					<div class="clearfix"></div>
					<br>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="col-sm-12" id="registration">
				<h4><i>Account Information</i></h4>
				</div>
				<div class="col-sm-12" align="center"><br>
					<img src="<?php echo base_url('image/logout.png') ; ?>" alt="picture" id="reg_profile">
				</div>
				<div class="col-sm-12"><br>
					<div class="col-sm-3">
						<label>ID No.</label>
					</div>
					<div class="col-sm-9">
						<input class="form-control"  type='text'  id="idNo" name='id_no'   maxlength='10' placeholder="x x x x - x x x x x " value="<?php echo set_value('id_no');?>" required><br>
					</div>
					<div class="clearfix"></div>

					<div class="col-sm-3">
						<label>Password</label>
					</div>
					<div class="col-sm-9">
						<input class="form-control" type="password" name="password" required>
						<small class="help-block"><b>Secure your password.</b> Password must be at least minimum of 8 characters and maximum of 15</small>
					</div>
					<div class="clearfix"></div>

					<div class="col-sm-3">
						<label>Confirm Password</label>
					</div>
					<div class="col-sm-9">
						<input class="form-control" type="password" name="passconf" required>
					</div>
					<div class="clearfix"></div><br><br><br>


					<div class="col-md-12 col-sm-12 col-xs-12 text-right"><br>
					<input class="btn btn-success btn-block bg-primary" type="Submit" value="Add Student" />
					</div>			
				</div>
			</div>
		</form>
	</div>
</div>
</body>
</body>
</html>