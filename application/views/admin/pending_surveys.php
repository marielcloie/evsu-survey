<title>Notification</title>	

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
		<div class="col-sm-12">
		<?php if(empty($pending_survey)): ?>
			<br><br>
			<h3 align="center"><b>No survey requests</b></h3>
		<?php else: ?>
			<h3><b style="color: red; ">Survey Requests</b></h3>
			<table class="table table-hover">
						<thead>
							<th>Surveyor</th>
							<th>User type</th>
							<th>Survey Title</th>
							<th colspan="3">Action</th>
						</thead>	
						<?php foreach ($pending_survey as $survey) : ?>
							<tr>
								<td><b><?php echo $survey->surveyor; ?></b></td>
								<td><?php echo $survey->usertype; ?></td>
								<td><b><?php echo $survey->survey_title;?></b></td>
								<td><a class="btn btn-default btn-block bg-info" href="<?php echo base_url('admin/get_survey_info/'.$survey->survey_id) ?>"><span class="glyphicon glyphicon-info-sign"></span> View</a></td>
								<td><a class="btn btn-default btn-block bg-success" href="<?php echo base_url('admin/approve_survey/'.$survey->survey_id) ?>"><span class="glyphicon glyphicon-ok"></span> Approve</a></td>
								<td><a class="btn btn-default btn-block bg-warning" href="<?php echo base_url('admin/disapprove_survey/'.$survey->survey_id) ?>" onclick="if(!confirm('Are you sure?')) return false;"><span class="glyphicon glyphicon-remove"></span> Disapprove</a></td>						
							</tr>
						<?php endforeach; ?>
				</table>
		<?php endif; ?>	
		</div>
	</div>
</div>

<div class="container">
	<div class="col-sm-12">
		<p style="padding: 50px;"></p>
	</div>
</div>
 