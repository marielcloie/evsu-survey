<title><?php echo $survey_info->survey_title ?></title>

<?php $y=0; ?>
<div class="container">
	<div class="row">
		<div class="col-sm-12" align="center">
			<h2><?php echo $survey_info->survey_title ?></h2><br>
			<p><?php echo $survey_info->survey_intro ?></p>
			<p style="padding:20px;"></p>
		</div>
	</div>
</div>


<form action="<?php echo base_url('survey/submit_answer/'.$survey_info->survey_id);?>" method="POST">
<?php foreach ($survey_parting as $s_part): ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-1"></div>
			<div class="col-sm-11" align="left">
				<p><b>Part <?php echo $s_part->part?>. </b><?php echo $s_part->instruction?>.</p><br>
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
											<p><input type="radio" name="<?php echo $s_part->part. '_' .$s_question->number . '_answers[]'?>" value="<?php echo $s_choice->choice ?>" checked="checked"><?php echo $s_choice->choice ?> </p>
											<?php $r++; ?>
											<?php else: ?>
											<p><input type="radio" name="<?php echo $s_part->part. '_' .$s_question->number . '_answers[]'?>" value="<?php echo $s_choice->choice ?>"><?php echo $s_choice->choice ?> </p>
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
											<p><input type="checkbox" name="<?php echo $s_part->part. '_' .$s_question->number . '_answers[]'?>" value="<?php echo $s_choice->choice ?>"><?php echo $s_choice->choice ?>
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
								<p><textarea class="form-control" type="text" rows="5" size="50" placeholder="Type your answer here" name="<?php echo $s_part->part. '_' .$s_question->number . '_answers[]'?>" required/></textarea></p>
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
							<td><input type="radio" name="<?php echo $s_part->part. '_' .$num1 . '_answers[]'?>" checked="checked" value="<?php echo $s_choice->choice ?>"></td>
							<?php $r++; ?>
						<?php else: ?>
							<td><input type="radio" name="<?php echo $s_part->part. '_' .$num1 . '_answers[]'?>" value="<?php echo $s_choice->choice ?>"></td>
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

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<p style="padding:30px;"></p>
			<input class="btn btn-success btn-block" type="submit" value="Submit">
		</div>
	</div>
</div>
</form>



<!-- <?php $x=1; ?>
<p style="padding: 20px;"></p>
<div class="container">
	<div class="row">
		<div class="col-sm-12"> 
			<h3>Survey Questionnaire</h3>
		</div>
		<div class="col-sm-1"></div>
		<div class="col-sm-11">
			<form action="<?php echo base_url('survey/submit_answer/'.$survey_info->survey_id);?>" method="POST">
			<?php $i=1; ?>
			<?php foreach ($question_info as $q_info): ?>
				<div class="col-sm-12">
					<br><p><?php echo $x; ?>.<?php echo $q_info->question ?></p>
				</div>
				<div class="col-sm-1"></div>
				<div class="col-sm-11">
					<?php $r=0; ?>
					<?php foreach ($choices_info as $c_info): ?>
						<?php if ($c_info->number==$q_info->number): ?>
							<?php if ($r==0): ?>
							<input type="radio" name="<?php echo $i.'answer[]' ?>"
							value="<?php echo $c_info->choice ?>" checked="checked"><?php echo $c_info->choice ?><br>
							<?php $r++; ?>
							<?php else: ?>	
							<input type="radio" name="<?php echo $i.'answer[]' ?>"
							value="<?php echo $c_info->choice ?>"><?php echo $c_info->choice ?><br>
							<?php endif ?>
						<?php endif ?>
					<?php endforeach ?>
				<?php $i++; ?>
				</div>
				<?php $x++; ?>
			<?php endforeach ?>
			<div class="col-sm-12">
			<br><br>
				<input class="btn btn-success btn-block bg-primary" type="submit" value="Submit">
			</div>
			</form>
		</div>
	</div>
</div> -->