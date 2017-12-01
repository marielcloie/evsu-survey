<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin_pads.css') ?>">

<title>Manage Accounts</title>

<body>

<?php if (!empty($message)): ?>
<div class="container">
	<div class="row">
		<div class="col-sm-12 alert alert-<?php echo $message['status']; ?>">
			<b><?php echo $message['message']; ?></b>
		</div>
	</div>
</div>	
<?php endif ?>

<div class="container">
	<div class="row">		
		<?php if(empty($admin_accounts)): ?>			
			<div class="col-md-12 col-sm-12 col-xs-12 text-center">
				<h3><b style="color: red;">No admin account is registered.<br>
				Add new <a href="<?php echo base_url('admin/add_admin'); ?>">account</a></b></h3>
				<br>
			</div>
		<?php else: ?>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="container">
					<h4><a href="<?php echo base_url('admin/add_admin'); ?>"><b>+ Add Admin</b></a><br></h4>
				</div>	
			</div>

			<table class="table table-hover">
				<thead>
					<th>ID Number</th>
					<th>Name</th>
					<th>User Type</th>
					<th colspan="3">Action</th>
				</thead>	
				<?php foreach ($admin_accounts as $admin) : ?>
					<tr>
						<td><b><?php echo $admin->id_no; ?></b></td>
						<td><?php echo $admin->firstname; ?> <?php echo $admin->middleinitial; ?> <?php echo $admin->lastname; ?></td>
						<td><?php echo $admin->usertype; ?></td>
						<td><a class="btn btn-default btn-block bg-info" href="<?php echo base_url('admin/viewadminprofile/'.$admin->id_no); ?>" >View</a></td>
						<td><a class="btn btn-default btn-block bg-warning" href="<?php echo base_url('admin/edit_admin/'.$admin->id_no); ?>">Update</a></td>
						<?php if ($_SESSION['id_no']==$admin->id_no): ?>
						<td><a class="btn btn-default btn-block bg-danger" disabled="disabled")>Remove</a></td>					
						<?php else: ?>		
						<td><a class="btn btn-default btn-block bg-danger" href="<?php echo base_url('admin/delete_admin/'.$admin->id_no); ?>" onclick="if(!confirm('Are you sure?')) return false;">Remove</a></td>					
						<?php endif ?>	
					</tr>
				<?php endforeach; ?>
			</table>
		<?php endif; ?>
	</div>
</div>


<br><br>

<div class="container">
	<div class="row">		
		<?php if(empty($instructor_accounts)): ?>			
			<div class="col-md-12 col-sm-12 col-xs-12 text-center">
				<h3><b style="color: red;">No instructor account is registered.<br>
				Add new <a href="<?php echo base_url('admin/add_instructor'); ?>">account</a></b></h3>
				<br>
			</div>
		<?php else: ?>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="container">
					<h4><a href="<?php echo base_url('admin/add_instructor'); ?>"><b>+ Add Instructor</b></a><br></h4>
				</div>	
			</div>

			<table class="table table-hover">
				<thead>
					<th>ID Number</th>
					<th>Name</th>
					<th>User Type</th>
					<th colspan="3">Action</th>
				</thead>	
				<?php foreach ($instructor_accounts as $instructor): ?>
					<tr>
						<td><b><?php echo $instructor->id_no; ?></b></td>
						<td><?php echo $instructor->firstname; ?> <?php echo $instructor->middleinitial; ?> <?php echo $instructor->lastname; ?></td>
						<td><?php echo $instructor->usertype; ?></td>
						<td><a class="btn btn-default btn-block bg-info" href="<?php echo base_url('admin/viewinstructorprofile/'.$instructor->id_no); ?>" >View</a></td>
						<td><a class="btn btn-default btn-block bg-warning" href="<?php echo base_url('admin/edit_instructor/'.$instructor->id_no); ?>">Update</a></td>	
						<td><a class="btn btn-default btn-block bg-danger" href="<?php echo base_url('admin/delete_instructor/'.$instructor->id_no); ?>" onclick="if(!confirm('Are you sure?')) return false;">Remove</a></td>					
					</tr>
				<?php endforeach; ?>
			</table>
		<?php endif; ?>
	</div>
</div>


<br><br>


<div class="container">
	<div class="row">		
		<?php if(empty($student_accounts)): ?>			
			<div class="col-md-12 col-sm-12 col-xs-12 text-center">
				<h3><b style="color: red;">No student account is registered.<br>
				Add new <a href="<?php echo base_url('admin/add_student'); ?>">account</a></b></h3>
				<br>
			</div>
		<?php else: ?>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="container">
					<h4><a href="<?php echo base_url('admin/add_student'); ?>"><b>+ Add student</b></a><br></h4>
				</div>	
			</div>

			<table class="table table-hover">
				<thead>
					<th>ID Number</th>
					<th>Name</th>
					<th>User Type</th>
					<th colspan="3">Action</th>
				</thead>	
				<?php foreach ($student_accounts as $student): ?>
					<tr>
						<td><b><?php echo $student->id_no; ?></b></td>
						<td><?php echo $student->firstname; ?> <?php echo $student->middleinitial; ?> <?php echo $student->lastname; ?></td>
						<td><?php echo $student->usertype; ?></td>
						<td><a class="btn btn-default btn-block bg-info" href="<?php echo base_url('admin/viewstudentprofile/'.$student->id_no); ?>" >View</a></td>
						<td><a class="btn btn-default btn-block bg-warning" href="<?php echo base_url('admin/edit_student/'.$student->id_no); ?>">Update</a></td>	
						<td><a class="btn btn-default btn-block bg-danger" href="<?php echo base_url('admin/delete_student/'.$student->id_no); ?>" onclick="if(!confirm('Are you sure?')) return false;">Remove</a></td>
					</tr>
				<?php endforeach; ?>
			</table>
		<?php endif; ?>
	</div>
</div>



</body>
