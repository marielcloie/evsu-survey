<title><?php echo $survey_info->survey_title ?></title>

<?php $y=0; ?>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="col-sm-12" align="center">
				<h2><b><?php echo $survey_info->survey_title ?></b></h2><br>
				<label><?php echo $survey_info->survey_intro ?></label><br>
			</div>

			<div class="col-sm-12">
				<h3><b>Survey Information</b></h3>
			</div>

			<div class="col-sm-12">
			<div class="col-sm-3">
				<p>Surveyor</p>
			</div>

			<div class="col-sm-7">	
				<b><?php echo $surveyor_info->firstname?> <?php echo $surveyor_info->lastname?></b><br>			
				<?php echo $survey_info->usertype ?></p>				
			</div>
			<div class="clearfix"></div>

			<div class="col-sm-3">
				<p>Respondents</p>
			</div>

			<div class="col-sm-7">
				<p><?php echo $survey_info->respondents ?></p>				
			</div>
			<div class="clearfix"></div>

			<?php if ($survey_info->respondents=="Specific"): ?>
				<div class="col-sm-3">
					<p>Specific Respondents</p>
				</div>

				<div class="col-sm-7">
					<?php foreach ($survey_limit as $i_limit): ?>					
						<?php if ($i_limit->usertype=="instructor"): ?>
							<?php echo $i_limit->audience ?> <br>
							<?php $y=3; ?>
						<?php endif ?>
					<?php endforeach ?>
					<?php if ($y==3): ?>
						<p><i>Instructor</i></p>
					<?php endif ?>

					<?php foreach ($survey_limit as $s_limit): ?>					
						<?php if ($s_limit->usertype=="student"): ?>
							<?php echo $s_limit->audience ?> <br>
							<?php $y=4; ?>
						<?php endif ?>
					<?php endforeach ?>
					<?php if ($y==4): ?>
						<p><i>Student</i></p>
					<?php endif ?>

					<?php foreach ($survey_limit as $in_limit): ?>					
						<?php if ($in_limit->usertype=="invited"): ?>		
							<p>Invited</p>				
						<?php endif ?>		
					<?php endforeach ?>

				</div>
				<div class="clearfix"></div>
				<?php endif ?>

			<div class="col-sm-3">
				<p>Respondents scope</p>
			</div>

			<div class="col-sm-7">
					<p>Limited to <?php echo $survey_info->num_respondents ?> respondents</p>
			</div>
			<div class="clearfix"></div>

			<div class="col-sm-3">
				<p>Number of Respondent</p>
			</div>

			<div class="col-sm-7">
				<p><?php echo $r_num ?></p>				
			</div>
			<div class="clearfix"></div>

			</div>

		</div>
	</div>
</div>

<div class="container">
	<div class="col-sm-12">
		<p style="padding: 10px;"></p>
	</div>
	<div class="col-sm-12" align="left">
		<h3><b>Survey Questions</b></h3>
	</div>
	<div class="col-sm-12">
		<p style="padding: 10px;"></p>
	</div>
</div>

<?php foreach ($survey_parting as $s_part): ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-1"></div>
			<div class="col-sm-11" align="left">
				<p><b>Part <?php echo $s_part->part?>. </b><?php echo $s_part->instruction?></p><br>
				<div class="col-sm-11">
					<?php foreach ($survey_question as $s_question): ?>

						<?php if ($s_question->question_type=="radio"): ?>
							<?php if ($s_part->part==$s_question->part): ?>
								<div class="col-sm-12">
								<p><?php echo $s_question->number; ?>. <?php echo $s_question->question ?></p>
								</div>
								<?php $r=0; ?>
								<?php foreach ($survey_choice as $s_choice): ?>
									<?php if ($s_question->number==$s_choice->number and $s_part->part==$s_choice->part ): ?>
											<div class="col-sm-1"></div>
											<div class="col-sm-11">
											<?php if ($r==0): ?>	
											<p><input type="radio" name="choices <?php echo $s_choice->number?> <?php echo $s_part->part?>" checked="checked"><?php echo $s_choice->choice ?></p>
											<?php $r++; ?>
											<?php else: ?>
											<p><input type="radio" name="choices <?php echo $s_choice->number?> <?php echo $s_part->part?>"><?php echo $s_choice->choice ?></p>
											<?php endif ?>
											</div>
									<?php endif ?>
								<?php endforeach ?>	
							<?php endif ?>
						<?php endif ?>

						<?php if ($s_question->question_type=="checkbox"): ?>
							<?php if ($s_part->part==$s_question->part): ?>
								<div class="col-sm-12">
								<p><?php echo $s_question->number; ?>. <?php echo $s_question->question ?></p>
								</div>
								<?php foreach ($survey_choice as $s_choice): ?>
									<?php if ($s_question->number==$s_choice->number and $s_part->part==$s_choice->part ): ?>
											<div class="col-sm-1"></div>
											<div class="col-sm-11">
											<p><input type="checkbox" name="choices <?php echo $s_choice->number?>"><?php echo $s_choice->choice ?></p>
											</div>
									<?php endif ?>
								<?php endforeach ?>	
							<?php endif ?>
						<?php endif ?>


						<?php if ($s_question->question_type=="Open Question"): ?>
							<?php if ($s_part->part==$s_question->part): ?>
								<div class="col-sm-12">
								<p><?php echo $s_question->number; ?>. <?php echo $s_question->question ?></p>
								</div>
								<div class="col-sm-1"></div>
								<div class="col-sm-11">
								<p><textarea class="form-control" type="text" rows="5" size="50" placeholder="Type your answer here"/></textarea></p>
								</div>
								
							<?php endif ?><br><br>
						<?php endif ?>

						
					<?php endforeach ?>
				</div>			
			</div>
		</div><br>
	</div>

<?php if ($s_part->question_type==3): ?>
<div class="container">
	<div></div>
	<div class="col-sm-1"></div>
	<div class="col-sm-11">
		<table class="table">
		<thead>
			<th colspan="2"><?php echo $s_part->label; ?></th>
			<?php foreach ($survey_choice as $s_choice): ?>
				<?php if ($s_part->part==$s_choice->part ): ?>
				<th><?php echo $s_choice->choice ?></th>
				<?php endif; ?>
		<?php endforeach; ?>
		</thead>

			
			<?php $num1=1 ; ?>
		<?php foreach ($survey_question as $s_question): ?>
			<?php if ($s_part->part==$s_question->part): ?>
			<tr>
				<td><?php echo $s_question->number ?></td>
				<td><?php echo $s_question->question ?></td>
	
			<?php $r=0; ?>
			<?php foreach ($survey_choice as $s_choice): ?>
					<?php if ($s_part->part==$s_choice->part): ?>
						<?php if ($r==0): ?>	
							<td><input type="radio" name="<?php echo $num1 ?>_choices[]" checked="checked"></td>
							<?php $r++; ?>
						<?php else: ?>
							<td><input type="radio" name="<?php echo $num1 ?>_choices[]"></td>
						<?php endif ?>
					<?php endif; ?>
			<?php endforeach; ?>
			</tr>

			<?php endif; ?>
			<?php $num1++; ?>
		<?php endforeach; ?>
		</table>
</div></div>
	<?php endif ?>

<?php endforeach ?>













