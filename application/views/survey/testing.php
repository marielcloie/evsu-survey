<title>Home</title>

<?php $x=1; ?>

<div class="container">
	<div class="row">
		<div class="col-sm-11" align="center">
			<div class="col-sm-12" align="center">
				<h2><b>Survey Lists</b></h2><br>
				<table class="table table-hover">
					<thead>
						<th>No.</th>
						<th>Survey Title</th>
						<th>Respondents</th>
						<th>Expiry</th>
						<th colspan="2"></th>
					</thead>	
					<?php foreach ($survey_info as $survey): ?>

						<tr>Open Survey</tr>

						<tr>
							<td> <?php echo $x; ?></td>
							<td><b><?php echo $survey->survey_title; ?></b></td>
							<?php if ($survey->respondents=="specific"): ?>
								<td>	
								<?php foreach ($survey_limit as $limit): ?>
									<?php if ($survey->survey_id == $limit->survey_id): ?>
										<?php echo $limit->audience ?><br>
									<?php endif ?>
								<?php endforeach ?>
								</td>		
								
							<?php else: ?>
								<td><?php echo $survey->respondents; ?></td>
							<?php endif ?>
							<td> <?php echo $survey->expiry_date ?></td>
							<td><a class="btn btn-default btn-block bg-info" href="<?php echo base_url('survey/answer_survey/'.$survey->survey_id); ?>"> Answer</a></td>
							<td><a class="btn btn-default btn-block bg-info" href="">View Survey</a></td>
						</tr>
						<?php $x++; ?>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>
</div>