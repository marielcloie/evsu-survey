<title>Home</title>

<?php $x=1; ?>
<br>
<?php if (!empty($message)): ?>
<div class="container">
	<div class="row">
		<div class="col-sm-12 alert alert-<?php echo $message['status']; ?>">
			<b><?php echo $message['message']; ?></b>
		</div>
	</div>
</div>	
<?php endif ?>

<?php if (!empty($open_survey)): ?>
	
<div class="container">
	<div class="row">
		<div class="col-sm-11" align="center">
			<div class="col-sm-12" align="center">
				<h2><b>Survey Lists</b></h2><br>
				<table class="table table-hover">
					<thead>
						<th colspan="5">Open Surveys</th>
					</thead>
					<thead>
						<th>No.</th>
						<th>Survey Title</th>
						<th>Category</th>
						<th></th>
					</thead>	
					<?php foreach ($open_survey as $survey): ?>
						<tr>
							<td> <?php echo $x; ?></td>
							<td><a href="<?php echo base_url('survey/data_analysis_per_survey/'.$survey->survey_id) ?>">
							<b><?php echo $survey->survey_title; ?></b></a></td>
							<td> <?php echo $survey->category ?></td>
							<?php $y=0; ?>
							<?php if (!empty($answered_survey)): ?>
								
							<?php foreach ($answered_survey as $ans_surv):?>
								<?php if ($ans_surv->survey_id==$survey->survey_id): ?>							
									<td><a class="btn btn-default btn-block bg-info" disabled="disabled"> Answered</a></td>
									<?php $y++; ?>
								<?php endif ?>
							<?php endforeach ?>
							<?php endif ?>

							<?php if ($y==0): ?>
									<td><a class="btn btn-default btn-block bg-info" href="<?php echo base_url('survey/answer_survey/'.$survey->survey_id); ?>"> Answer Survey</a></td>	
							<?php endif ?>
						</tr>
						<?php $x++; ?>
					<?php endforeach?>
				</table>
			</div>
		</div>
	</div>
</div>
<?php endif ?>

<?php if (!empty($answerable_survey)): ?>
<br><br>
<?php $b=1; ?>
<div class="container">
	<div class="row">
		<div class="col-sm-11" align="center">
			<div class="col-sm-12" align="center">
				<table class="table table-hover">
					<thead>
						<th colspan="5">Surveys you may also answer</th>
					</thead>
					<thead>
						<th>No.</th>
						<th>Survey Title</th>
						<th>Category</th>
						<th></th>
					</thead>	
					<?php foreach ($answerable_survey as $a_survey): ?>
						<tr>
							<td> <?php echo $b; ?></td>
							<td><a href="<?php echo base_url('survey/data_analysis_per_survey/'.$a_survey->survey_id) ?>">
							<b><?php echo $a_survey->survey_title; ?></b></a></td>
							<td> <?php echo $a_survey->category ?></td>
							<?php $y=0; ?>
							<?php if (!empty($answered_survey)): ?>
								
							<?php foreach ($answered_survey as $ans_surv):?>
								<?php if ($ans_surv->survey_id==$a_survey->survey_id): ?>									
									<td><a class="btn btn-default btn-block bg-info" disabled="disabled"> Answered</a></td>
									<?php $y++; ?>
								<?php endif ?>
							<?php endforeach ?>
							<?php endif ?>

							<?php if ($y==0): ?>
									<td><a class="btn btn-default btn-block bg-info" href="<?php echo base_url('survey/answer_survey/'.$a_survey->survey_id); ?>"> Answer Survey</a></td>	
							<?php endif ?>
						</tr>
						<?php $b++; ?>
					<?php endforeach?>
				</table>
			</div>
		</div>
	</div>
</div>

<?php endif ?>

<?php if (!empty($off_survey)): ?>
<br><br>
<?php $b=1; ?>
<div class="container">
	<div class="row">
		<div class="col-sm-11" align="center">
			<div class="col-sm-12" align="center">
				<table class="table table-hover">
					<thead>
						<th colspan="5">Surveys closed to specified respondents</th>
					</thead>
					<thead>
						<th>No.</th>
						<th>Survey Title</th>
						<th>Category</th>
					</thead>	
					<?php foreach ($off_survey as $a_survey): ?>
						<tr>
							<td> <?php echo $b; ?></td>
							<td><a href="<?php echo base_url('survey/data_analysis_per_survey/'.$a_survey->survey_id) ?>">
							<b><?php echo $a_survey->survey_title; ?></b></a></td>
							<td> <?php echo $a_survey->category ?></td>
						</tr>
						<?php $b++; ?>
					<?php endforeach?>
				</table>
			</div>
		</div>
	</div>
</div>
<?php endif ?>


<?php if (!empty($closed_survey)): ?>
	
<div class="container">
	<div class="row">
		<div class="col-sm-11" align="center">
			<div class="col-sm-12" align="center">
				<h2><b>Survey Lists</b></h2><br>
				<table class="table table-hover">
					<thead>
						<th colspan="5">Closed Surveys</th>
					</thead>
					<thead>
						<th>No.</th>
						<th>Survey Title</th>
						<th>Category</th>
					</thead>	
					<?php foreach ($closed_survey as $csurvey): ?>
						<tr>
							<td> <?php echo $x; ?></td>
							<td><a href="<?php echo base_url('survey/data_analysis_per_survey/'.$csurvey->survey_id) ?>">
							<b><?php echo $csurvey->survey_title; ?></b></a></td>
							<td> <?php echo $csurvey->category ?></td>
						</tr>
						<?php $x++; ?>
					<?php endforeach?>
				</table>
			</div>
		</div>
	</div>
</div>
<?php endif ?>
