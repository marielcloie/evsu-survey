<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin_pads.css') ?>">
<script src="<?php echo base_url('assets/jquery-1.12.4.js') ?>"></script>
<script src="<?php echo base_url('assets/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/dataTables.bootstrap.min.js') ?>"></script>

<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable();
} );
</script>

<title>Activity logs</title>


<?php if (!empty($message)): ?>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 alert alert-<?php echo $message['status']; ?>">		
				<?php echo $message['message']; ?>
			</div>
		</div>
	</div>
<?php endif ?>

	
<?php if (!empty($result)): ?>
<form action="<?php echo base_url('admin/delete_activitylog') ?>" method="POST">
<br>
<div class="container">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12"> 
			 <table class="table table-hover" id="example">
			 	<thead>
			 		<th>
			 		<input type="checkbox" name="" value="">
			 		</th>
			 		<th>ID Number</th>
			 		<th>Activity</th>
			 		<th>Date/Time</th>
			 		<th>User Type</th>
			 	</thead>
			 	<?php foreach ($result as $key => $activitylog): ?>
				 	<tr>
				 		<td>
				 		<input type="checkbox" name="activity_delete[]" value="<?php echo $activitylog->activity_id ?>">		
				 		</td>
				 		<td><?php echo $activitylog->id_no ?></td>
				 		<td><?php echo $activitylog->activity ?></td>
				 		<td><?php echo $activitylog->date_time ?></td>
				 		<td><?php echo $activitylog->usertype ?></td>
				 	</tr>
			 	<?php endforeach ?>
			 </table>
			 		<input type="submit" value="Delete" class="btn btn-warning" onclick="if(!confirm('Are you sure?')) return false;" > <br>		 	
		</div>
	</div>
</div>
</form>

<?php else: ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-12" align="center">
				<br><br><br><br>
				<h1>No activity yet</h1>
				<br><br><br><br><br>
			</div>
		</div>
	</div>
<?php endif ?>
