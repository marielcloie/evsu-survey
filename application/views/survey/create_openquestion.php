<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/header.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin_pads.css') ?>">
<script src="<?php echo base_url('assets/bootstrap/js/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/survey.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/button_survey.css') ?>">


<script>
var num1 = 1;

function open_question()
	{
		num1++;
		var d = document.getElementById('q_con');
		d.innerHTML += "<div class='col-sm-12'><p style='padding:10px;'></div>"
		d.innerHTML += "<div class='col-sm-1'>" + num1 + "</div> <div class='col-sm-11'><input class='form-control' type='text' name='question[]' placeholder='Type question here'> <br></div>";
		d.innerHTML += "<div class='col-sm-1'></div> <div class='col-sm-11'><textarea class='form-control' type='text' rows='5' placeholder='Your respondent answers here'/>";
	}

</script>


<title>Create Survey</title>

<div class="container">
	<div class="col-sm-12">
		<p style="padding: 10px;"></p>
	</div>
</div>

<div class="container">
		<div class="col-sm-3">
			<div class="col-sm-12" align="center">
				<p style="padding: 40px;"></p>
				<button class="button button3" onclick="open_question()">Open Question</button>
			</div>				 
		</div>
		
		<div class="col-sm-9" >
			<div class="col-sm-11">
				<h2 align="center"><b><?php echo $survey_info->survey_title?></b></h2>
				<p align="center"><?php echo $survey_info->survey_intro?></p><br><br>

				<p><b>Part <?php echo $specific_parting->part ?> .</b> <?php echo $specific_parting->instruction ?></p>
			</div>

			<div class="col-sm-12">
			<form action="" method="POST"> 

				<div class="col-sm-12">
					<div class="col-sm-12"><p style="padding:10px;"></div>
					<div class="col-sm-1"> 1 </div> <div class="col-sm-11"><input class="form-control" type="text" name="question[]" placeholder="Type question here" required> <br></div>
					<div class="col-sm-1"></div> <div class="col-sm-11"><textarea class="form-control" type="text" rows="5" placeholder="Your respondent answers here"/></textarea></div>
				</div>

				<div class="col-sm-12" id="q_con">
						
				</div>
				<div class="col-sm-12">				
					<br><br>
					<?php if ($specific_parting->part<count($survey_parting)): ?>
						<input class="btn btn-success btn-block bg-primary" type="Submit" value="Next Part" />
					<?php else: ?>					
						<input class="btn btn-success btn-block bg-primary" type="Submit" value="Submit" />
					<?php endif ?>
				</div>
			</form>
				
			</div>

		</div>
		
	</div>


<div class="container">
	<div class="col-sm-12">
		<p style="padding: 30px;"></p>
	</div>
</div>