
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/header.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin_pads.css') ?>">
<script src="<?php echo base_url('assets/bootstrap/js/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/survey.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/button_survey.css') ?>">

<script>
function add_qt(count_choice)
	{
		var d = document.getElementById('q_con'); 
		
		d.innerHTML += "<tr><td><input type='text' class='form-control' name='question[]'></td>";

		for ($i=1; $i <= count_choice ; $i++){
			d.innerHTML += "<td><input type='radio' name='choices[]'></td>";
		}
		
		d.innerHTML += "</tr>";

	}



</script>

<title>Create Survey</title>

<div class="container">
	<div class="col-sm-12">
		<p style="padding: 20px;"></p>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="col-sm-12" align="center">
				<h2><?php echo $survey_info->survey_title ?></h2>
				<h4><?php echo $survey_info->survey_intro ?></h4><br><br>
			</div>

			<div class="col-sm-12">
			<div class="col-sm-1"></div>
			<div class="col-sm-11">
				<label>Part <?php echo $specific_parting->part ?>. <?php echo $specific_parting->instruction ?></label>
			</div>


			<div class="col-sm-12" align="right" >
					<button class="btn" onclick="add_qt(<?php echo $count_choice?>)">+</button>
					 <p style="padding: 10px;"></p>
			</div>

			<div class="col-sm-1"></div>
			<div class="col-sm-11">
			<form action="" method="POST">
				<table class="table">
					<thead>
						<th><?php echo $specific_parting->label ?></th>
						<?php foreach ($survey_choice_scale as $s_choice): ?>
							<th><?php echo $s_choice->choice; ?></th>
						<?php endforeach ?>
					</thead>
					<tr>
						<td><input type="text" name="question[]" class="form-control" required></td>
						<?php for ($i=1; $i <= $count_choice ; $i++) :?>
								<td><input type="radio" name="choices[]"></td>
						<?php endfor; ?>
						
					</tr>
					<tr>
						<td><input type="text" name="question[]" class="form-control"></td>
						<?php for ($i=1; $i <= $count_choice ; $i++) :?>
								<td><input type="radio" name="choices[]"></td>
						<?php endfor; ?>
						
					</tr>
					<tr>
						<td><input type="text" name="question[]" class="form-control"></td>
						<?php for ($i=1; $i <= $count_choice ; $i++) :?>
								<td><input type="radio" name="choices[]"></td>
						<?php endfor; ?>
						
					</tr>
					<tr>
						<td><input type="text" name="question[]" class="form-control"></td>
						<?php for ($i=1; $i <= $count_choice ; $i++) :?>
								<td><input type="radio" name="choices[]"></td>
						<?php endfor; ?>
						
					</tr>
					<tr>
						<td><input type="text" name="question[]" class="form-control"></td>
						<?php for ($i=1; $i <= $count_choice ; $i++) :?>
								<td><input type="radio" name="choices[]"></td>
						<?php endfor; ?>
						
					</tr>
					<tr>
						<td><input type="text" name="question[]" class="form-control"></td>
						<?php for ($i=1; $i <= $count_choice ; $i++) :?>
								<td><input type="radio" name="choices[]"></td>
						<?php endfor; ?>
						
					</tr>
					<tr>
						<td><input type="text" name="question[]" class="form-control"></td>
						<?php for ($i=1; $i <= $count_choice ; $i++) :?>
								<td><input type="radio" name="choices[]"></td>
						<?php endfor; ?>
						
					</tr>
					<tr>
						<td><input type="text" name="question[]" class="form-control"></td>
						<?php for ($i=1; $i <= $count_choice ; $i++) :?>
								<td><input type="radio" name="choices[]"></td>
						<?php endfor; ?>
						
					</tr>
					<tr>
						<td><input type="text" name="question[]" class="form-control"></td>
						<?php for ($i=1; $i <= $count_choice ; $i++) :?>
								<td><input type="radio" name="choices[]"></td>
						<?php endfor; ?>
						
					</tr>
					<tr>
						<td><input type="text" name="question[]" class="form-control"></td>
						<?php for ($i=1; $i <= $count_choice ; $i++) :?>
								<td><input type="radio" name="choices[]"></td>
						<?php endfor; ?>
						
					</tr>
					<tr>
						<td><input type="hidden" name="testing" value="Has"></td>
					</tr>
					
				</table>
				<table class="table" id="q_con"></table>
				<table class="table">
					<tr>
					<?php if ($specific_parting->part<count($survey_parting)): ?>
						<td><input class="btn btn-success btn-block bg-primary" type="Submit" value="Next Part"/></td>
					<?php else: ?>					
						<td><input class="btn btn-success btn-block bg-primary" type="Submit" value="Submit"/></td>
					<?php endif ?>


					</tr>
				</table>

			</form>
			</div>
			</div>


		</div>
	</div>
</div>