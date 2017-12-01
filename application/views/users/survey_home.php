<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin_pads.css') ?>">
<title>EVSU Online Survey and Data Analysis Portal</title>

<?php if (!empty($open_survey)): ?>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
					<?php $a=1; ?>
					<div class="col-sm-12" align="center">
						<h2><b>Survey Lists</b></h2><br>
						<table class="table table-hover">
							<thead>
								<th colspan="3">Open Surveys</th>
							</thead>
							<thead>
								<th>No.</th>
								<th>Title</th>
								<th>Category</th>
							</thead>
							<?php foreach ($open_survey as $o_survey): ?>
								<tr>
									<td><?php echo $a; ?></td>
									<td><a href="<?php echo base_url('survey/public_data_analysis/'.$o_survey->survey_id) ?>"><?php echo $o_survey->survey_title ?></a></td>
									<td><?php echo $o_survey->category ?></td>
								</tr>
								<?php $a++; ?>
							<?php endforeach ?>
							
						</table>
					</div>
			</div>
			<div class="col-sm-3"></div>
		</div>
	</div>
</div>
<?php endif ?>

<?php if (!empty($off_survey)): ?>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
					<?php $b=1; ?>
					<div class="col-sm-12" align="center">
						<table class="table table-hover">
							<thead>
								<th colspan="3">Surveys closed to specified respondents</th>
							</thead>
							<thead>
								<th>No.</th>
								<th>Title</th>
								<th>Category</th>
							</thead>
							<?php foreach ($off_survey as $of_survey): ?>
								<tr>
									<td><?php echo $b; ?></td>
									<td><a href="<?php echo base_url('survey/public_data_analysis/'.$of_survey->survey_id) ?>"><?php echo $of_survey->survey_title ?></a></td>
									<td><?php echo $of_survey->category ?></td>
								</tr>
								<?php $b++; ?>
							<?php endforeach ?>
							
						</table>
					</div>
			</div>
			<div class="col-sm-3"></div>
		</div>
	</div>
</div>
<?php endif ?>