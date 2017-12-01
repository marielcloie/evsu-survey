<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/header.css') ?>">

<title>Create Survey</title>

<div class="container">
	<div class="row">
		<div class="col-sm-12">

		<?php if (!empty(validation_errors())): ?>
				<div class="col-md-12 col-sm-12 col-xs-12 alert alert-danger">
					<?php echo validation_errors(); ?>
				</div>
		<?php endif ?>
		
		<div class="col-sm-11">
			<h2><b>Create Survey</b></h2><br>
			<form action="" method="POST">
				<div class="col-sm-3">
					<label>Survey Title</label>	
				</div>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="survey_title" required> 
					<br>
				</div>
				<div class="clearfix"></div>

				<div class="col-sm-3">
					<label>Survey Introduction</label>	
				</div>
				<div class="col-sm-9">
					<textarea class="form-control" type="text" rows="5" name="survey_intro" size="50" 
					placeholder="Tell them something about your survey"/></textarea>
					<small class="help-block">(Optional) Maximum of 500 letters only</small>
					<br>
				</div>
				<div class="clearfix"></div>

				<div class="col-sm-3">
					<label>Category</label>	
				</div>
				<div class="col-sm-4">
					<select class="btn-block" name="category" >							
							<option value="Assessment">Assessment</option>
							<option value="Demographic">Demographic</option>
							<option value="Educational">Educational</option>
							<option value="Environmental">Environmental</option>
							<option value="Feedback">Feedback</option>
							<option value="Instructor">Instructor</option>
							<option value="Parental">Parental</option>
							<option value="Satisfaction">Satisfaction</option>
							<option value="Student">Student</option>
							<option value="Uncategorized" selected>Uncategorized</option>
							<option value="University">University</option>
						</select>
					<br>
				</div>
				<div class="clearfix"></div>

				<div class="col-sm-3">
					<label>Respondents</label>	
				</div>	
				<div class="col-sm-9">
					<div class="col-sm-3">
			 		<input type="radio" name="respondents" value="Open" checked="checked">Open to all	
					<br><br>
					<input type="radio" name="respondents" value="Invited">Invited guests	
					</div>	
					<div class="col-sm-9">
			 		<input type="radio" name="respondents" value="Specific" data-toggle="collapse" data-target="#closeto">Limit survey to <br>		
					<div class="col-sm-12">
					<div id="closeto" class="collapse">
				 		<input type="checkbox" name="closed_stud" value="Student" data-toggle="collapse" data-target="#stud_college">Students<br>		 
					<div class="col-sm-12">
						<div id="stud_college" class="collapse">
					 		<input type="checkbox" name="stud_college[]" value="CAAD" data-toggle="collapse" data-target="#open_caad">College of Allied and Discipline<br>
					 			<div id="open_caad" class="collapse">
					 			<div class="col-sm-12">				 				
					 			<?php foreach ($for_courses as $one_course): ?>
					 				<?php if ($one_course->dept_id=="1"): ?>
					 					<input type="checkbox" name="stud_course[]" value="<?php echo $one_course->course_name ?>" ><?php echo $one_course->course_name ?><br>
					 				<?php endif ?>		 	
					 			 <?php endforeach ?>		 
					 			</div>
					 			</div>
					 		<input type="checkbox" name="stud_college[]" value="CAS" data-toggle="collapse" data-target="#open_cas">College of Arts and Science<br>
					 			<div id="open_cas" class="collapse">	
					 			<div class="col-sm-12">				 				
					 			<?php foreach ($for_courses as $one_course): ?>
					 				<?php if ($one_course->dept_id=="2"): ?>
					 					<input type="checkbox" name="stud_course[]" value="<?php echo $one_course->course_name ?>"><?php echo $one_course->course_name ?><br>
					 				<?php endif ?>		 	
					 			 <?php endforeach ?>		 
					 			</div>		 
					 			</div>		 
					 			
					 		<input type="checkbox" name="stud_college[]" value="COBE" data-toggle="collapse" data-target="#open_cobe">College of Business and Entrepreneurship<br>
					 			<div id="open_cobe" class="collapse">
					 			<div class="col-sm-12">				 				
					 			<?php foreach ($for_courses as $one_course): ?>
					 				<?php if ($one_course->dept_id=="3"): ?>
					 					<input type="checkbox" name="stud_course[]" value="<?php echo $one_course->course_name ?>"><?php echo $one_course->course_name ?><br>
					 				<?php endif ?>		 	
					 			 <?php endforeach ?>		 
					 			</div>
					 			</div>
					 		<input type="checkbox" name="stud_college[]" value="COED" data-toggle="collapse" data-target="#open_coed">College of Education<br>
					 			<div id="open_coed" class="collapse">
					 			<div class="col-sm-12">				 				
					 			<?php foreach ($for_courses as $one_course): ?>
					 				<?php if ($one_course->dept_id=="4"): ?>
					 					<input type="checkbox" name="stud_course[]" value="<?php echo $one_course->course_name ?>"><?php echo $one_course->course_name ?><br>
					 				<?php endif ?>		 	
					 			 <?php endforeach ?>		 
					 			</div>		
					 			</div> 
					 		<input type="checkbox" name="stud_college[]" value="COE" data-toggle="collapse" data-target="#open_coe">College of Engineering<br>	
					 			<div id="open_coe" class="collapse">
					 			<div class="col-sm-12">				 				
					 			<?php foreach ($for_courses as $one_course): ?>
					 				<?php if ($one_course->dept_id=="5"): ?>
					 					<input type="checkbox" name="stud_course[]" value="<?php echo $one_course->course_name ?>"><?php echo $one_course->course_name ?><br>
					 				<?php endif ?>		 	
					 			 <?php endforeach ?>		 
					 			</div>	 
					 			</div>
					 		<input type="checkbox" name="stud_college[]" value="COT" data-toggle="collapse" data-target="#open_cot">College of Technology<br>
					 			<div id="open_cot" class="collapse">
					 			<div class="col-sm-12">				 				
					 			<?php foreach ($for_courses as $one_course): ?>
					 				<?php if ($one_course->dept_id=="6"): ?>
					 					<input type="checkbox" name="stud_course[]" value="<?php echo $one_course->course_name ?>"><?php echo $one_course->course_name ?><br>
					 				<?php endif ?>		 	
					 			 <?php endforeach ?>		 
					 			</div>	
					 			</div>	 
						</div>
					</div>
				 		<input type="checkbox" name="closed_inst" value="Instructor" data-toggle="collapse" data-target="#inst_college">Instructor<br>
				 		<div class="col-sm-12">
						<div id="inst_college" class="collapse">
					 		<input type="checkbox" name="inst_college[]" value="CAAD">College of Allied and Discipline<br>		 
					 		<input type="checkbox" name="inst_college[]" value="CAS">College of Arts and Science<br>		 
					 		<input type="checkbox" name="inst_college[]" value="COBE">College of Business and Entrepreneurship<br>
					 		<input type="checkbox" name="inst_college[]" value="COED">College of Education<br>		 
					 		<input type="checkbox" name="inst_college[]" value="COE">College of Engineering<br>		 
					 		<input type="checkbox" name="inst_college[]" value="COT">College of Technology<br>		 
						</div>
						</div>
					</div>
					</div>
				</div>	
				</div>	
				<div class="clearfix"></div>

				<div class="col-sm-3">
				<br>
					<label>Number of respondents</label>	
				</div>	
				<div class="col-sm-9">
					<div class="col-sm-2">
					<br>
						<input type="text" name="num_respondents" placeholder="0" required>					
					</div>
				</div>	
				<div class="clearfix"></div>
				<br>

				<div class="clearfix"></div>
					<div class="col-sm-7"></div>
					<div class="col-sm-5"><br><br><br>
					<input class="btn btn-success btn-block bg-primary" type="Submit" value="Create Survey" />
					</div>			
			</form>
		</div>
	</div>
</div>
			
		</div>
