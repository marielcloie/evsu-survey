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
						<th>Expiry</th>
					</thead>	
					<?php foreach ($off_survey as $a_survey): ?>
						<tr>
							<td> <?php echo $b; ?></td>
							<td><b><?php echo $a_survey->survey_title; ?></b></td>
							<td> <?php echo $a_survey->expiry_date ?></td>
						</tr>
						<?php $b++; ?>
					<?php endforeach?>
				</table>
			</div>
		</div>
	</div>
</div>

<?php endif ?>
