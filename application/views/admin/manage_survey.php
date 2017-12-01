<title>Manage Surveys</title>

<?php if (!empty($message)): ?>
<div class="container">
	<div class="row">
		<div class="col-sm-12 alert alert-<?php echo $message['status']; ?>">
			<b><?php echo $message['message']; ?></b>
		</div>
	</div>
</div>	
<?php endif ?>


<?php if (!empty($approved_surveys)): ?>
<?php $x=1; ?>
<p style="padding: 5px;"></p>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h3 style="color: red;"><b>Approved Surveys</b></h3>
		</div>
		<div class="col-sm-12">
			<table class="table table-hover">
				<thead>
					<th>No.</th>
					<th>Surveyor</th>
					<th>Title</th>
					<th colspan="2">Action</th>
				</thead>
				<?php foreach ($approved_surveys as $a_surveys): ?>
					<tr>
						<td><?php echo $x; ?></td>
						<td><?php echo $a_surveys->surveyor ?></td>
						<td><?php echo $a_surveys->survey_title ?></td>
						<td><a class="btn btn-default btn-block bg-info" href="<?php echo base_url('survey/data_analysis_per_survey/'.$a_surveys->survey_id) ?>"><span class="glyphicon glyphicon-info-sign"></span> View</a></td>
						<td><a class="btn btn-default btn-block bg-info" href="<?php echo base_url('admin/delete_survey/'.$a_surveys->survey_id) ?>" onclick="if(!confirm('Are you sure?')) return false;"><span class="glyphicon glyphicon-remove-sign"></span> Delete</a></td>
					</tr>
					<?php $x++; ?>
				<?php endforeach ?>
			</table>
		</div>
	</div>
</div>
<?php endif ?>

<?php if (!empty($disapproved_surveys)): ?>
<?php $y=1; ?>
<p style="padding: 5px;"></p>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h3 style="color: red;"><b>Disapproved Surveys</b></h3>
		</div>
		<div class="col-sm-12">
			<table class="table table-hover">
				<thead>
					<th>No.</th>
					<th>Surveyor</th>
					<th>Title</th>
					<th colspan="2">Action</th>
				</thead>
				<?php foreach ($disapproved_surveys as $d_surveys): ?>
					<tr>
						<td><?php echo $y; ?></td>
						<td><?php echo $d_surveys->surveyor ?></td>
						<td><?php echo $d_surveys->survey_title ?></td>
						<td><a class="btn btn-default btn-block bg-info" href="<?php echo base_url('survey/data_analysis_per_survey/'.$d_surveys->survey_id) ?>"><span class="glyphicon glyphicon-info-sign"></span> View</a></td>
						<td><a class="btn btn-default btn-block bg-info" href="<?php echo base_url('admin/delete_survey/'.$d_surveys->survey_id) ?>" onclick="if(!confirm('Are you sure?')) return false;"><span class="glyphicon glyphicon-remove-sign"></span> Delete</a></td>
					</tr>
					<?php $y++; ?>
				<?php endforeach ?>
			</table>
		</div>
	</div>
</div>
<?php endif ?>

