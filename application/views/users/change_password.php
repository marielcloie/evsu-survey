<title>Change password</title>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			 <div class="col-sm-6">
			 	<form action="" method="POST">
			 		
			 	
			 	<div class="col-md-4 col-sm-4 col-xs-12">
					<h5>Old Password</h5>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<input class="form-control" type="password" name="oldpassword" required/>
				</div>
		
				<div class="clearfix"></div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<h5>New Password</h5>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<input class="form-control" type="password" name="newpassword" required/>
					<small class="help-block"><b>Secure your password.</b> Password must be at least minimum of 8 characters and maximum of 20</small>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<h5>Confirm new password</h5>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<input class="form-control" type="password" name="passconf" required/><br>
				</div>

				<div class="col-md-12 col-sm-12 col-xs-12 text-right">
				<br>
					<input class="btn btn-success btn-block bg-primary" type="submit" value="Submit" />
			 </div>
			 </form>
		</div>

		<?php if (!empty(validation_errors())): ?>
				<div class="col-md-6 col-sm-6 col-xs-12 alert alert-danger">
					<?php echo validation_errors(); ?>
				</div>
			<?php endif ?>

			<?php if (!empty($message)): ?>
					<div class="col-sm-6 alert alert-<?php echo $message['status']; ?>">
						<b><?php echo $message['message']; ?></b>
					</div>
			<?php endif ?>
	</div>
</div>