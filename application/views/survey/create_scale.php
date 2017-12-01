
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/header.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin_pads.css') ?>">
<script src="<?php echo base_url('assets/bootstrap/js/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/survey.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/button_survey.css') ?>">

<script>
function add_choice(newValue)
	{
		$(addchoice_con).empty();
		var d = document.getElementById('addchoice_con'); 
		
		d.innerHTML += "<theader><th colspan='2'>Choices<th></theader>";
		var less = newValue;
		for (i = 1; i <= newValue; i++) {
	    	d.innerHTML += "<tr> <td>" + less + "</td><td><input type='text' class='form-control' name='choice[]' required></td></tr> "; 
	    	less--
		};
		if (newValue>0) {
		d.innerHTML += "<tr><td colspan='2'> <br><br><input type='submit' class='btn btn-primary btn-block' value='Create Scale'> </td></tr>";
		}
	}
</script>


<title>Create Survey</title>

<div class="container">
	<div class="col-sm-12">
		<p style="padding: 30px;"></p>
	</div>
</div>
 

 <div class="container">
	<div class="col-sm-12" align="center"> 
		<h2><?php echo $survey_info->survey_title ?></h2><br>
		<label><?php echo $survey_info->survey_intro ?></label>
		<p style="padding: 10px;"></p>
		
	</div>
</div>

<form action="<?php echo base_url('survey/submit_scale/'.$survey_info->survey_id .'/' .$num .'/' .$specified ); ?>" method="POST">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="col-sm-6">					
				<table class="table">
					<tr>
						<td><b>Question Label</b></td>
						<td><input class="form-control" type="text" name="label" required></td>
					</tr>
					<tr>
						<td><b>Scale number</b></td>
						<td>
							<select class="btn btn-block" name="dd_num" onchange="add_choice(this.value)" required>
								<option value="" selected="selected">Select</option>
								<option value="5">5</option>
								<option value="7">7</option>
								<option value="10">10</option>
							</select>
						</td>
					</tr>
				</table>
				</div>
				<div class="col-sm-6">
					<table class="table" id="addchoice_con"></table>
				</div>
			</div>
		</div>	
	</div>
</form>