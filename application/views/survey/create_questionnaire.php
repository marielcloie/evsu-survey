<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/header.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin_pads.css') ?>">
<script src="<?php echo base_url('assets/bootstrap/js/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/survey.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/button_survey.css') ?>">

<?php $start=1; ?>

<script>
function add_rb($start)
	{
		var d = document.getElementById('q_con');
		d.innerHTML += "<div class='col-sm-12'><p style='padding:10px;'></div>"
		d.innerHTML += "<input class='form-control' type='text' name='question[]' placeholder='Type question here'> <br>";
		d.innerHTML += "<div class='col-sm-1'><input type='radio' checked='checked'></div><div class='col-sm-11'> <input class='form-control' type='text' name='choices[]' placeholder='Type your choice here'> </div> ";
		d.innerHTML += "<br> <div class='col-sm-1'><input type='radio'></div><div class='col-sm-11'> <input class='form-control' type='text' name='choices[]' placeholder='Type your choice here' > </div> ";
		d.innerHTML += "<br> <div class='col-sm-1'><input type='radio'></div><div class='col-sm-11'> <input class='form-control' type='text' name='choices[]' placeholder='Type your choice here'> </div> ";
		d.innerHTML += "<br> <div class='col-sm-1'><input type='radio'></div><div class='col-sm-11'> <input class='form-control' type='text' name='choices[]' placeholder='Type your choice here'> </div> ";
		<?php $start++; ?>

	}

function add_cb($start)
	{
		var d = document.getElementById('q_con');
		d.innerHTML += "<div class='col-sm-12'><p style='padding:10px;'></div>"
		d.innerHTML += "<input class='form-control' type='text' name='question[]' placeholder='Type question here'> <br>";
		d.innerHTML += "<div class='col-sm-1'><input type='checkbox' checked='checked'></div><div class='col-sm-11'> <input class='form-control' type='text' name='choices[]' placeholder='Type your choice here'> </div> ";
		d.innerHTML += "<br> <div class='col-sm-1'><input type='checkbox'></div><div class='col-sm-11'> <input class='form-control' type='text' name='choices[]' placeholder='Type your choice here' > </div> ";
		d.innerHTML += "<br> <div class='col-sm-1'><input type='checkbox'></div><div class='col-sm-11'> <input class='form-control' type='text' name='choices[]' placeholder='Type your choice here'> </div> ";
		d.innerHTML += "<br> <div class='col-sm-1'><input type='checkbox'></div><div class='col-sm-11'> <input class='form-control' type='text' name='choices[]' placeholder='Type your choice here'> </div> ";
	}

function add_dq($start)
	{
		var d = document.getElementById('q_con');
		d.innerHTML += "<div class='col-sm-12'><p style='padding:10px;'></div>"
		d.innerHTML += "<input class='form-control' type='text' name='question[]' placeholder='Type question here'> <br>";
		d.innerHTML += "<div class='col-sm-1'></div><div class='col-sm-3' align='left'><input type='radio' checked='checked'>Yes</div> ";
		d.innerHTML += "<div class='col-sm-3' align='left'><input type='radio'>No</div> ";
		}

function open_question()
	{
		var d = document.getElementById('q_con');
		d.innerHTML += "<div class='col-sm-12'><p style='padding:10px;'></div>"
		d.innerHTML += "<input class='form-control' type='text' name='question[]' placeholder='Type question here'> <br>";
		d.innerHTML += "<div class='col-sm-1'></div> <div class='col-sm-11'><textarea class='form-control' type='text' rows='5' placeholder='Your respondent answers here'/>";
	}

</script>


<title>Create Survey</title>




<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3">
			<div class="col-sm-12" style="background-color: maroon;padding: 15px;" align="center">
				<h2 style="color: white;">Controls</h2>
			</div>	
			<div class="col-sm-12" align="center">
				<button class="button button3" data-toggle="collapse" data-target="#multiple_choice">Multiple Choice</button>
					<div class="col-sm-12">
						<div id="multiple_choice" class="collapse">
						 	<button class="button button3"
						 	onclick="add_rb(<?php echo $start?>)">Radio Buttons</button>
							<button class="button button3" 
							onclick="add_cb()">Checkboxes</button>
							<button class="button button3" 
							onclick="add_dq()">Dichotomous Question</button>	 
						</div>
					</div>
				<button class="button button3"
				onclick="open_question()">Open Question</button>
				<button class="button button3">Scale</button>
				 
			</div>
		</div>


		<div class="col-sm-9" align="center">
			<h2><b><?php echo $survey_info->survey_title?></b></h2>
			<p style="white-space: pre;"><?php echo $survey_info->survey_intro?></p><br><br>

			<div class="col-sm-12">
			<form action="" method="POST"> 
				<div class="col-sm-12" id="q_con">
						
				</div>
				<div class="col-sm-12">				
					<br><br>
					<input class="btn btn-success btn-block bg-primary" type="Submit" value="Submit" />
				</div>
			</form>
				
			</div>

		</div>
	</div>
</div>




 