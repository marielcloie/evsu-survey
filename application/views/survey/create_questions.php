<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/survey.css') ?>">

<title>Create Survey</title>
<br>

<div class="container">
	<div class="row">
		<div class="col-sm-12" align="center">
			<h2><b><?php echo $survey_info->survey_title ?></b></h2><br><br>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-sm-11">
		<form action="" method="POST">			
			<?php for ($i=1; $i <= $survey_info->num_questions ; $i++):?>
				<div class="col-sm-12"><br>
					<div class="col-sm-2">
						<b>Question <?php echo $i ?></b>
					</div>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="question[]" required><br>
						<div class="clearfix"></div>
							<div class="col-sm-2">
								<p><b>Choices</b></p>
							</div>
							<div class="col-sm-10" id="<?php echo 'addhere'.$i?>">
								<div align="right"><button class="button" onclick="<?php echo 'addTextBox'.$i.'()' ?>"><span>Add Choice </span></button><br></div>
								<input class="form-control" type="text" name="<?php echo $i.'choices[]' ?>"><br>
								<input class="form-control" type="text" name="<?php echo $i.'choices[]' ?>"><br>
								<input class="form-control" type="text" name="<?php echo $i.'choices[]' ?>"><br>
								<input class="form-control" type="text" name="<?php echo $i.'choices[]' ?>"><br>				
							</div>	
						</div>
					<div class="clearfix"></div>
				</div>

				<script>
					//var x=1
					function addTextBox<?php echo $i;?>()
					{
					   var d = document.getElementById('addhere<?php echo $i; ?>');
					   d.innerHTML += "<input class='form-control' type='text' name='<?php echo $i?>choices[]'><br>";
					}
				</script>

			<?php endfor; ?>	
			<div class="col-sm-12">				
			<br><br>
			<input class="btn btn-success btn-block bg-primary" type="Submit" value="Submit" />
			</div>
		</form>
		</div>
	</div>
</div>




