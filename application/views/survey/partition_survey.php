
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles.css') ?>">
<script src="<?php echo base_url('assets/bootstrap/js/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>

<script type="text/javascript">
var num1 = 1;

function add_qt()
	{
		num1++;
		var d = document.getElementById('tq_con');
		d.innerHTML += "<tr><td>Part " + num1 + " </td><td><select class='btn-block' name='question_type[]' ><option value=''>Choose question type</option> <option value='1'>Multiple Choice</option> <option value='2'>Open Question</option> <option value='3'>Scale</option> </select></td></tr>"
		d.innerHTML += "<td>Instruction</td> <td> <textarea class='form-control' type='text' rows='5' name='instruction" + num1 + "' size='50' placeholder='Tell them something about your survey'/></textarea></td>"
	}
</script>


<p style="padding:30px;"></p>
<title>Create Survey</title>

<div class="container">
	<div class="col-sm-12" >
		<div class="col-sm-2"></div>
			
		<div class="col-sm-8"></div>
		<div class="col-sm-2" align="left">
			<button class="btn" onclick="add_qt()">+</button>
		</div>
		<p style="padding:30px;"></p>
	</div>
</div>

<div class="container">
	<div class="col-sm-12" align="center">

		<form action="" method="POST">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<table class="table">
					<tr>
						<td>Part <?php echo $start; ?></td>
						<td>
							<select class="btn-block" name="question_type[]" required>							
								<option value="">Choose question type</option>	
								<option value="1">Multiple Choice</option>	
								<option value="2">Open Question</option>	
								<option value="3">Scale</option>	
							</select>
						</td>
					</tr>
					
					<tr>
						<td>Instruction</td>
						<td>
							<textarea class="form-control" type="text" rows="5" name="instruction1" size="50" 
						placeholder="Instruct them on how to answer the questionnaire"/></textarea>
						</td>
					</tr>
				</table>
				<table class="table" id="tq_con">
				</table>
				<input type="submit" class="btn btn-block btn-success" value="Next">
				
			</div>
			<div class="col-sm-2"></div>
		</form>	
	</div>
</div>



<div class="container">
	<div class="col-sm-12">
		<p style="padding: 30px;"></p>
	</div>
</div>
 

	

<!-- <div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
					<div class="col-sm-3">Part I</div>
					<div class="col-sm-9">
						<select class="btn-block" name="question_type[]" >							
							<option value="">Choose question type</option>	
							<option value="1">Multiple Choice</option>	
							<option value="2">Open Question</option>	
							<option value="3">Scale</option>	
						</select>
					</div>
			</div>
			<div class="col-sm-4"></div>


		</div>
	</div>
</div> -->