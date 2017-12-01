<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/header.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin_pads.css') ?>">
<script src="<?php echo base_url('assets/bootstrap/js/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/survey.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/button_survey.css') ?>">

<script>
var num1 = 0;

function add_rb()
	{
		num1++;
		var d = document.getElementById('q_con');
		d.innerHTML += "<div class='col-sm-12'><p style='padding:10px;'></div>";
		d.innerHTML += "<div class='col-sm-12' align='right'><button class='btn'><span class='glyphicon glyphicon-remove-sign'></button><p style='padding:5px;'></div>";
		d.innerHTML += "<div class='col-sm-1'>" + num1 + "</div> <div class='col-sm-11'> <input class='form-control' type='text' name='question[]' placeholder='Type question here'> <br> </div>";
		d.innerHTML += "<div class='col-sm-2' align='right' ><input type='radio' checked='checked' name='radio" + num1 + "[]'></div><div class='col-sm-10'> <input class='form-control' type='text' name='choices" + num1 + "[]' placeholder='Type your choice here'> </div> ";
		d.innerHTML += "<br> <div class='col-sm-2' align='right'  align='right'><input type='radio'  name='radio" + num1 + "[]'></div><div class='col-sm-10'> <input class='form-control' type='text' name='choices" + num1 + "[]' placeholder='Type your choice here' > </div> ";
		d.innerHTML += "<br> <div class='col-sm-2' align='right' ><input type='radio'  name='radio" + num1 + "[]'></div><div class='col-sm-10'> <input class='form-control' type='text' name='choices" + num1 + "[]' placeholder='Type your choice here'> </div> ";
		d.innerHTML += "<br> <div class='col-sm-2' align='right' ><input type='radio'  name='radio" + num1 + "[]'></div><div class='col-sm-10'> <input class='form-control' type='text' name='choices" + num1 + "[]' placeholder='Type your choice here'> </div> ";
		d.innerHTML += "<br> <div class='col-sm-2' align='right' ><input type='radio'  name='radio" + num1 + "[]'></div><div class='col-sm-10'> <input class='form-control' type='text' name='choices" + num1 + "[]' placeholder='Type your choice here'> </div> ";
		d.innerHTML += "<input type='hidden' value='radio' name='question_type" + num1 + "'>";

	}

function add_cb()
	{
		num1++;
		var d = document.getElementById('q_con');
		d.innerHTML += "<div class='col-sm-12'><p style='padding:10px;'></div>";
		d.innerHTML += "<div class='col-sm-1'>" + num1 + "</div> <div class='col-sm-11'> <input class='form-control' type='text' name='question[]' placeholder='Type question here'> <br> </div>";
		d.innerHTML += "<div class='col-sm-2' align='right' ><input type='checkbox' checked='checked'></div><div class='col-sm-10'> <input class='form-control' type='text' name='choices" + num1 + "[]' placeholder='Type your choice here'> </div> ";
		d.innerHTML += "<br> <div class='col-sm-2' align='right' ><input type='checkbox'></div><div class='col-sm-10'> <input class='form-control' type='text' name='choices" + num1 + "[]' placeholder='Type your choice here' > </div> ";
		d.innerHTML += "<br> <div class='col-sm-2' align='right' ><input type='checkbox'></div><div class='col-sm-10'> <input class='form-control' type='text' name='choices" + num1 + "[]' placeholder='Type your choice here'> </div> ";
		d.innerHTML += "<br> <div class='col-sm-2' align='right' ><input type='checkbox'></div><div class='col-sm-10'> <input class='form-control' type='text' name='choices" + num1 + "[]' placeholder='Type your choice here'> </div> ";
		d.innerHTML += "<br> <div class='col-sm-2' align='right' ><input type='checkbox'></div><div class='col-sm-10'> <input class='form-control' type='text' name='choices" + num1 + "[]' placeholder='Type your choice here'> </div> ";
		d.innerHTML += "<input type='hidden' value='checkbox' name='question_type" + num1 + "'>";
	}

function add_dq($start)
	{
		num1++;
		var d = document.getElementById('q_con');
		d.innerHTML += "<div class='col-sm-12'><p style='padding:10px;'></div>";
		d.innerHTML += "<div class='col-sm-1'>" + num1 + "</div> <div class='col-sm-11'> <input class='form-control' type='text' name='question[]' placeholder='Type question here'> <br> </div>";
		d.innerHTML += "<div class='col-sm-2'></div><div class='col-sm-3' align='left'><input type='radio' checked='checked' value='Yes' name='choices" + num1 + "[]'>Yes</div> ";
		d.innerHTML += "<div class='col-sm-3' align='left'><input type='radio' value='No' name='choices" + num1 + "[]'>No</div> ";
		d.innerHTML += "<input type='hidden' value='radio' name='question_type" + num1 + "'>";
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
				<button class="button button3" onclick="add_rb()">Radio Buttons</button>
				<button class="button button3" onclick="add_cb()">Checkboxes</button>
				<button class="button button3" onclick="add_dq()">Dichotomous Question</button>	 
			</div>				 
		</div>
		
		<div class="col-sm-9" >
			<div class="col-sm-11">
				<h2 align="center"><b><?php echo $survey_info->survey_title?></b></h2>
				<p align="center"><?php echo $survey_info->survey_intro?></p><br><br>

				<p><b>Part <?php echo $specific_parting->part ?> .</b> <?php echo $specific_parting->instruction ?></p>
			</div>

			<form action="" method="POST"> 
			<div class="col-sm-12">
				<div class="col-sm-12" id="q_con"></div>
				<div class="col-sm-12">				
					<br><br>
					<?php if ($specific_parting->part<count($survey_parting)): ?>
						<input class="btn btn-success btn-block bg-primary" type="Submit" value="Next Part" />
					<?php else: ?>					
						<input class="btn btn-success btn-block bg-primary" type="Submit" value="Submit" />
					<?php endif ?>
				</div>
			</div>
			</form>

		</div>
		
	</div>



<div class="container">
	<div class="col-sm-12">
		<p style="padding: 30px;"></p>
	</div>
</div>
 