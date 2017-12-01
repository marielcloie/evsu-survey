<!DOCTYPE html>
<html lang="en">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin_pads.css') ?>">
	 
<head>
	<title>Edit Instructor</title>
</head>
<br>
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
				<div class="col-sm-12"><br>
					<div class="col-sm-3">
						<label>Name</label>
					</div>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="lastname" value="<?php echo $result->lastname;?>" required>
						<small class="help-block">Last name</small>
						<input class="form-control" type="text" name="firstname" value="<?php echo $result->firstname;?>" required>
						<small class="help-block">First name</small>
						<input class="form-control" type="text" name="middleinitial" value="<?php echo $result->middleinitial;?>" required>
						<small class="help-block">Middle Initial</small>
					</div><br>
					<div class="clearfix"></div>
					<br>

					<div class="col-sm-3">
						<label>Gender</label>
					</div>
					<div class="col-sm-9">
						<?php if ($result->gender=='Male'): ?>
							<div class="col-sm-6">
								<input type="radio" name="gender" value="Male" checked="checked" >Male
							</div>
							<div class="col-sm-6">
								<input type="radio" name="gender" value="Female">Female
							</div>
						<?php else: ?>
							<div class="col-sm-6">
								<input type="radio" name="gender" value="Male">Male
							</div>
							<div class="col-sm-6">
								<input type="radio" name="gender" value="Female" checked="checked">Female
							</div>
						<?php endif; ?>					
					</div>	
					<div class="clearfix"></div><br>

					<div class="col-sm-3">
						<label>Address</label>
					</div>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="address" value="<?php echo $result->address;?>" required>
					</div>
					<div class="clearfix"></div><br>

					<div class="col-sm-3">
						<label>Contact No.</label>
					</div>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="contactnum" value="<?php echo $result->contactnum;?>" required>
					</div>
					<div class="clearfix"></div><br>

					<div class="col-sm-3">
						<label>Email Address</label>
					</div>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="email_add" value="<?php echo $result->email_add;?>" required>
					</div>
					
					<div class="clearfix"></div><br>

					<div class="col-sm-3">
						<label>College</label>
					</div>
					<div class="col-sm-9">
						<select class="btn-block" name="college">
					 		<<?php foreach ($colleges as $c_info): ?>
					 			<?php if ($c_info->college_alias==$result->college): ?>
					 			<option value="<?php echo $c_info->college_alias ?>" selected><?php echo $c_info->college_name ?></option>
					 			<?php else: ?>
					 			<option value="<?php echo $c_info->college_alias ?>"><?php echo $c_info->college_name ?></option>
					 			<?php endif ?>
					 		<?php endforeach ?> 
						</select>
					</div><br>
					
					<div class="clearfix"></div>
					<div class="col-md-12 col-sm-12 col-xs-12 text-right"><br>
					<input class="btn btn-success btn-block bg-primary" type="Submit" value="Submit" />
					</div>
				</div>
			</div>

		</form>
	</div>
</div>
</body>
</html>