<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="col-sm-12" align="center">
			<br><br><br>
				<h2><b>My Survey</b></h2><br>

				<table class="table">
					<thead>
						<th>No.</th>
						<th>Title</th>
						<th>Category</th>
						<th colspan="2">Action</th>
					</thead>
					<?php $num1=1; ?>
					<?php foreach ($own_surveys as $ownsurvey): ?>
					<tr>
						<td><?php echo $num1; ?></td>
						<td><b><?php echo $ownsurvey->survey_title ?></b></td>
						<td><?php echo $ownsurvey->category ?></td>
						<td><a class="btn btn-default btn-block bg-info" href="<?php echo base_url('survey/my_survey/'.$ownsurvey->survey_id) ?>"><span class="glyphicon glyphicon-info-sign"></span> View</a></td>
						<td><a class="btn btn-default btn-block bg-info" href="#" onclick="if(!confirm('Are you sure?')) return false;"><span class="glyphicon glyphicon-remove-sign"></span> Delete</a></td>
					</tr>
					<?php $num1++; ?>
					<?php endforeach ?>
				</table>
				
			</div>
		</div>
	</div>
	<br><br><br>
</div>