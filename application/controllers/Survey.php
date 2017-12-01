<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends CI_Controller {


	public function createsurvey()
	{
		$this->User->forLoggedInOnly();
		if ($_SESSION['usertype']=="Admin") {	
			$this->load->view('templates/header');
		} else {
			$this->load->view('templates/user_header');
	
		}

		$this->load->library('form_validation');
		$this->form_validation->set_rules('num_respondents', 'Number of respondents', 'greater_than[0]');

		$for_courses = $this->User->get_courses();

		if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('survey/create_survey',['for_courses'=>$for_courses]);
            }
        else
        {
			$this->load->model('Esurvey');

			$survey_title = $this->input->post('survey_title');
			$survey_intro = $this->input->post('survey_intro');
			$category = $this->input->post('category');
			$surveyor = $_SESSION['id_no'];
			$respondents = $this->input->post('respondents');						
			$num_respondents = $this->input->post('num_respondents');
			
			$this->load->helper('date');
			$datestring = '%F %j %Y - %h:%i %a';
			$time = time();
			$date_posted= mdate($datestring, $time);
 
			if ($this->Esurvey->add_survey($survey_title,$survey_intro,$category,$surveyor,$respondents,$num_respondents)) {

				$surveyid=$this->Esurvey->get_new_surveyID();

				if ($this->input->post('respondents') == "Invited") {
					$this->Esurvey->limit_survey_invited($surveyid->survey_id);
						
					$digits_needed=	mt_rand(0, 9);
					$random_number=''; // set up a blank string

					$count=0;

					while ( $count < $digits_needed ) {
					    $random_digit = mt_rand(0, 9);
							    
					    $random_number .= $random_digit;
					    $count++;
					}

					$direct_link= $random_number;
					$this->Esurvey->add_directlink($surveyid->survey_id,$direct_link);					
				}


				if ($this->input->post('respondents') == "Specific") {
					$limit_stud= count($this->input->post('stud_college[]'));
					$limit_inst= count($this->input->post('inst_college[]'));

					if (!empty($this->input->post('closed_stud'))) {
						foreach ($this->input->post('stud_course[]') as $selected) {
							$this->Esurvey->limit_survey_student($surveyid->survey_id,$selected);
						}
					}
					
					if (!empty($this->input->post('closed_inst'))) {
						foreach ($this->input->post('inst_college[]') as $selected) {
							$this->Esurvey->limit_survey_instructor($surveyid->survey_id,$selected);
						}
					}
				}

				$activity="Created new survey- ".$surveyor;

				$this->load->model('Admin_priv');

				$this->Admin_priv->add_activitylog(
					$_SESSION['id_no'],$date_posted,$activity,$_SESSION['usertype']);

				$this->session->mark_as_flash('message');
				$this->session->set_flashdata('message', [
						'status' => 'success',
						'message' => 'Successfully Created!'
					]);

				redirect(base_url('survey/create_partition/'.$surveyid->survey_id));

			}else{
				$this->session->mark_as_flash('message');
				$this->session->set_flashdata('message', [
						'status' => 'danger',
						'message' => 'Error!'
					]);

				redirect(base_url('survey/createsurvey'));
			}
        }
		$this->load->view('templates/footer');
	}

	public function create_partition($survey_id)
	{
		$this->User->forLoggedInOnly();

		$this->load->model('Esurvey');
		$survey_info=$this->Esurvey->get_survey_byId($survey_id);
		$start=1;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('question_type[]', 'Number of question', 'numeric');

		if ($this->form_validation->run() == FALSE)
            {
            	$this->load->view('survey/partition_survey',['survey_info'=>$survey_info, 'start'=>$start]);
            }
        else
        {
        	$q=1;

			foreach ($this->input->post('question_type[]') as $selected) {
				if (!empty($selected)) {
					$this->Esurvey->add_partition($survey_id,$q,$selected,$this->input->post('instruction'.$q));
				}
				$q++;
			}
			$num=1;
			$index=0;

			redirect(base_url('survey/create_parts/'.$survey_id .'/' .$num .'/' .$index));
		}
	}

	public function create_parts($survey_id, $num, $specified)
	{
		$this->User->forLoggedInOnly();

		$this->load->model('Esurvey');
		$survey_info=$this->Esurvey->get_survey_byId($survey_id);
		$survey_parting=$this->Esurvey->get_survey_parting($survey_id);

		if ($num<=count($survey_parting)) {
			$specific_parting= $this->Esurvey->get_specific_parting($survey_id,$specified);

			if ($specific_parting->question_type==1) {

				$this->load->library('form_validation');
				$this->form_validation->set_rules('question[]', 'Question', 'required');
			

				if ($this->form_validation->run() == FALSE)
		            {

					$this->load->view('survey/create_multiplechoice',
						['survey_info'=>$survey_info,
						'survey_parting'=>$survey_parting,
						'specific_parting'=>$specific_parting]);
					}
				else{

					$q=1;

					foreach ($this->input->post('question[]') as $selected) {
						$this->Esurvey->add_question($survey_id,$selected,$q,$num,$this->input->post('question_type'.$q) );
							foreach ($this->input->post('choices'.$q .'[]') as $selected) {
								if (!empty($selected)) {
									$this->Esurvey->add_choices($survey_id,$q,$selected,$num);
								} 
							}
						$q++;
					}

					$num++;
					$specified++;

					redirect(base_url('survey/create_parts/'.$survey_id .'/' .$num .'/' .$specified));

				}

			}

			if ($specific_parting->question_type==2) {
				$this->load->library('form_validation');
				$this->form_validation->set_rules('question[]', 'Question', 'required');
			

				if ($this->form_validation->run() == FALSE)
		            {

					$this->load->view('survey/create_openquestion',
					['survey_info'=>$survey_info,
					'survey_parting'=>$survey_parting,
					'specific_parting'=>$specific_parting]);
					}
				else{

					$q=1;
					$question_type="Open Question";
					foreach ($this->input->post('question[]') as $selected) {
						$this->Esurvey->add_question($survey_id,$selected,$q,$num,$question_type);
						$q++;
					}

					$num++;
					$specified++;

					redirect(base_url('survey/create_parts/'.$survey_id .'/' .$num .'/' .$specified));

				}
				
			}

			if ($specific_parting->question_type==3) {

					$this->load->view('survey/create_scale',
					['survey_info'=>$survey_info,
					'survey_parting'=>$survey_parting,
					'specific_parting'=>$specific_parting,
					'num'=>$num,
					'specified'=>$specified ]);
			}
			


		}
		else{
			redirect(base_url('survey/acknowledgement/'.$survey_id));
		}
	}

	public function submit_scale($survey_id,$num,$specified)
	{
		$q=1;
		$this->load->model('Esurvey');

		$label= $this->input->post('label');
		$this->Esurvey->add_label($survey_id,$label);
			
		foreach ($this->input->post('choice[]') as $selected) {
			$this->Esurvey->add_choices($survey_id,$q,$selected,$num);
			$q++;
		}

		redirect(base_url('survey/create_scale_question/'.$survey_id .'/' .$num .'/' .$specified));
	}

	public function create_scale_question($survey_id,$part,$specified)
	{
		$this->load->model('Esurvey');
		$survey_info=$this->Esurvey->get_survey_byId($survey_id);
		$specific_parting= $this->Esurvey->get_specific_parting($survey_id,$specified);
		$survey_choice_scale=$this->Esurvey->display_choices_scale($survey_id,$part);
		$count_choice= count($survey_choice_scale);	
		$survey_parting=$this->Esurvey->get_survey_parting($survey_id);


		$this->load->library('form_validation');
		$this->form_validation->set_rules('testing', 'Question', 'required');
			

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('survey/create_q_scale',
				['survey_info'=>$survey_info,
				'part'=>$part,
				'survey_choice_scale'=>$survey_choice_scale,
				'count_choice'=>$count_choice,
				'specific_parting'=>$specific_parting,
				'survey_parting'=>$survey_parting
				]);	
		}
		else{
				$q=1;
			
				$question_type="scale";
				foreach ($this->input->post('question[]') as $selected) {
					if (!empty($selected)) {
						$this->Esurvey->add_question($survey_id,$selected,$q,$part,$question_type);
					}
					$q++;
				}

				$part++;
				$specified++;

				redirect(base_url('survey/create_parts/'.$survey_id .'/' .$part .'/' .$specified));
		}	

	}


	public function acknowledgement($survey_id)
	{
		$this->User->forLoggedInOnly();

		$this->load->model('Esurvey');
		$survey_limit = "";
		$survey_info=$this->Esurvey->get_survey_byId($survey_id);
		$survey_parting=$this->Esurvey->get_survey_parting($survey_id);
		$survey_question=$this->Esurvey->display_questions($survey_id);
		$survey_choice=$this->Esurvey->display_choices($survey_id);
		$surveyor_info= $this->Esurvey->get_surveyor($survey_info->surveyor,$survey_info->usertype);
		$survey_closed = "";
		

		if ($survey_info->respondents=="Specific") {
			$survey_limit= $this->Esurvey->get_respondent_limit($survey_id);

			foreach ($survey_limit as $slimit) {
				if ($slimit->audience=="invited") {
					$survey_closed = $this->Esurvey->get_pass_closed($survey_id);
				}
			}
		}

		$this->load->view('survey/view_survey',[
			'survey_info'=>$survey_info,
			'survey_parting'=>$survey_parting,
			'survey_question'=>$survey_question,
			'survey_choice'=>$survey_choice,
			'surveyor_info'=>$surveyor_info,
			'survey_limit'=>$survey_limit,
			'survey_closed'=>$survey_closed
			]);
	}
	

	public function create_questions($survey_id)
	{	
		$this->User->forLoggedInOnly();

		$this->load->model('Esurvey');
		$survey_info=$this->Esurvey->get_survey_byId($survey_id);

		if ($_SESSION['usertype']=="Admin") {	
			$this->load->view('templates/header');
		} else {
			$this->load->view('templates/user_header');
	
		}


		$this->load->library('form_validation');
		$this->form_validation->set_rules('question[]', 'Question', 'required');
		

		if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('survey/create_questions',['survey_info'=>$survey_info]);
            }
        else
        {

			$this->load->model('Esurvey');

			$count = $survey_info->num_questions;
			$q=1;

			foreach ($this->input->post('question[]') as $selected) {
				$this->Esurvey->add_question($survey_id,$selected,$q);
				
				foreach ($this->input->post($q.'choices[]') as $selected) {
					if (!empty($selected)) {
						$this->Esurvey->add_choices($survey_id,$q,$selected);
					} 
				}
				$q++;
			}		
			
			if ($_SESSION['usertype']=="Instructor") {
				redirect(base_url('instructor'));
			} 

			if ($_SESSION['usertype']=="Student") {
				redirect(base_url('student'));
			} 
        }
		$this->load->view('templates/footer');
	}

	public function answer_survey($survey_id)
	{
		$this->load->model('Esurvey');

		$survey_limit = "";		
		$survey_info= $this->Esurvey->get_survey_byId($survey_id);
		$survey_parting=$this->Esurvey->get_survey_parting($survey_id);
		$survey_question=$this->Esurvey->display_questions($survey_id);
		$survey_choice=$this->Esurvey->display_choices($survey_id);
		$surveyor_info= $this->Esurvey->get_surveyor($survey_info->surveyor,$survey_info->usertype);

		if ($survey_info->respondents=="Specific") {
			$survey_limit= $this->Esurvey->get_respondent_limit($survey_id);
		}

		
		if ($_SESSION['usertype']=="Admin") {	
			$this->load->view('templates/header');
		} else {
			$this->load->view('templates/user_header');
	
		}

		$this->load->view('survey/answer_to_survey',
			['survey_info'=> $survey_info,
			'survey_limit'=> $survey_limit,
			'survey_parting'=>$survey_parting,
			'survey_question'=>$survey_question,
			'survey_choice'=>$survey_choice,
			'surveyor_info'=>$surveyor_info]);
		$this->load->view('templates/footer');		

	}

	public function submit_answer($survey_id)
	{
		$this->load->model('Esurvey');
		$survey_info= $this->Esurvey->get_survey_byId($survey_id);
		$survey_parting=$this->Esurvey->get_survey_parting($survey_id);
		$limiting = count($survey_parting);

		for ($x=1; $x <= $limiting ; $x++) { 
			$specific_part= $this->Esurvey->get_questions_part($survey_id,$x);
			for ($i=1; $i <= count($specific_part); $i++) 
			{ 
				foreach ($this->input->post($x. '_' .$i . '_answers[]') as $selected) 
				{
					$this->Esurvey->add_answer($survey_id,$i,$selected,$x);
				}
			}	
		}

		$this->load->model('Admin_priv');

		$this->load->helper('date');
		$datestring = '%F %j %Y - %h:%i %a';
		$time = time();
		$date_posted= mdate($datestring, $time);

		$activity="Answer survey- ".$survey_id;

		$this->Admin_priv->add_activitylog(
			$_SESSION['id_no'],$date_posted,$activity,$_SESSION['usertype']);

		$this->Esurvey->respondent_to_survey($survey_id,$date_posted);

		$survey_answered=$this->Esurvey->get_per_survey_answered($survey_id);
		$lim_ans = count($survey_answered);

		if ($lim_ans==$survey_info->num_respondents) {
			$this->Esurvey->update_availability($survey_id);
		}

		$this->session->mark_as_flash('message');
		$this->session->set_flashdata('message', [
			'status' => 'success',
			'message' => 'Thank you for your response!'
		]);

		
		if ($_SESSION['usertype']=='Instructor') {
			redirect(base_url('instructor'));
		}
		if ($_SESSION['usertype']=='Student') {
			redirect(base_url('student'));
		}
		if ($_SESSION['usertype']=='Invited') {
			redirect(base_url('users/acknowledgement'));
		}
	}

	public function invited_submit_answer($survey_id,$survey_no)
	{
		$_SESSION['id_no']= "Invited user";

		$this->load->model('Esurvey');
		$survey_info= $this->Esurvey->get_survey_byId($survey_id);
		$survey_parting=$this->Esurvey->get_survey_parting($survey_id);
		$limiting = count($survey_parting);


		for ($x=1; $x <= $limiting ; $x++) { 
			$specific_part= $this->Esurvey->get_questions_part($survey_id,$x);
			for ($i=1; $i <= count($specific_part); $i++) 
			{ 
				foreach ($this->input->post($x. '_' .$i . '_answers[]') as $selected) 
				{
					$this->Esurvey->add_answer($survey_id,$i,$selected,$x);
				}
			}	
		}

		$this->Esurvey->update_status_invited($this->input->post('survey_no_answered'));

		$this->load->model('Admin_priv');

		$this->load->helper('date');
		$datestring = '%F %j %Y - %h:%i %a';
		$time = time();
		$date_posted= mdate($datestring, $time);

		$activity="Answer survey- ".$survey_id;

		$this->Admin_priv->add_activitylog(
			$_SESSION['id_no'],$date_posted,$activity,$_SESSION['usertype']);

		$this->Esurvey->respondent_to_survey($survey_id,$date_posted);

		$this->session->mark_as_flash('message');
		$this->session->set_flashdata('message', [
			'status' => 'success',
			'message' => 'Thank you for your response!'
		]);

		
		if ($_SESSION['usertype']=='Invited') {
			redirect(base_url('users/acknowledgement'));
		}
	}


	public function data_analysis_per_survey($survey_id)
	{
		$this->User->forLoggedInOnly();
		if ($_SESSION['usertype']=="Admin") {	
			$this->load->view('templates/header');
		} else {
			$this->load->view('templates/user_header');
	
		}
		
		$this->load->model('Esurvey');

		$survey_limit = "";		
		$survey_info=$this->Esurvey->get_survey_byId($survey_id);
		$survey_parting=$this->Esurvey->get_survey_parting($survey_id);
		$survey_question=$this->Esurvey->display_questions($survey_id);
		$survey_choice=$this->Esurvey->display_choices($survey_id);
		$surveyor_info= $this->Esurvey->get_surveyor($survey_info->surveyor,$survey_info->usertype);
		$answers_info= $this->Esurvey->get_answer_from_survey($survey_id);
		$respondent_limit= $this->Esurvey->get_num_respondents($survey_id);
		$r_num = 0;

		foreach ($respondent_limit as $resp) {
			$r_num++;
		}

		if ($survey_info->respondents=="Specific") {
			$survey_limit= $this->Esurvey->get_respondent_limit($survey_id);
		}

		$this->load->view('survey/data_analysis',
			['survey_info'=> $survey_info,
			'survey_limit'=> $survey_limit,
			'survey_parting'=>$survey_parting,
			'survey_question'=>$survey_question,
			'survey_choice'=>$survey_choice,
			'answers_info'=> $answers_info,
			'r_num'=> $r_num,
			'surveyor_info'=>$surveyor_info]);

		$this->load->view('templates/footer');	

	}

	public function public_data_analysis($survey_id)
	{
		
		$this->load->view('templates/publicheader');
	
		$this->load->model('Esurvey');

		$survey_limit = "";		
		$survey_info=$this->Esurvey->get_survey_byId($survey_id);
		$survey_parting=$this->Esurvey->get_survey_parting($survey_id);
		$survey_question=$this->Esurvey->display_questions($survey_id);
		$survey_choice=$this->Esurvey->display_choices($survey_id);
		$surveyor_info= $this->Esurvey->get_surveyor($survey_info->surveyor,$survey_info->usertype);
		$answers_info= $this->Esurvey->get_answer_from_survey($survey_id);
		$respondent_limit= $this->Esurvey->get_num_respondents($survey_id);
		$r_num = 0;

		foreach ($respondent_limit as $resp) {
			$r_num++;
		}

		if ($survey_info->respondents=="Specific") {
			$survey_limit= $this->Esurvey->get_respondent_limit($survey_id);
		}

		$this->load->view('survey/data_analysis',
			['survey_info'=> $survey_info,
			'survey_limit'=> $survey_limit,
			'survey_parting'=>$survey_parting,
			'survey_question'=>$survey_question,
			'survey_choice'=>$survey_choice,
			'answers_info'=> $answers_info,
			'r_num'=> $r_num,
			'surveyor_info'=>$surveyor_info]);

		$this->load->view('templates/footer');	

	}

	public function invited_to_survey($survey_id, $survey_no)
	{
		$this->load->model('Esurvey');
		
		$survey_limit = "";		
		$survey_info= $this->Esurvey->get_survey_byId($survey_id);
		$survey_info_closed= $this->Esurvey->get_close_info($survey_no);
		$survey_parting=$this->Esurvey->get_survey_parting($survey_id);
		$survey_question=$this->Esurvey->display_questions($survey_id);
		$survey_choice=$this->Esurvey->display_choices($survey_id);
		$surveyor_info= $this->Esurvey->get_surveyor($survey_info->surveyor,$survey_info->usertype);
		
		if ($survey_info->respondents=="Specific") {
			$survey_limit= $this->Esurvey->get_respondent_limit($survey_id);
		}

		$this->load->view('survey/invited_to_answer',
			['survey_info'=> $survey_info,
			'survey_limit'=> $survey_limit,
			'survey_parting'=>$survey_parting,
			'survey_question'=>$survey_question,
			'survey_choice'=>$survey_choice,
			'survey_info_closed'=>$survey_info_closed,
			'surveyor_info'=>$surveyor_info]);
		$this->load->view('templates/footer');		


	}

	public function create_questionn($survey_id)
	{
		$this->User->forLoggedInOnly();

		$this->load->model('Esurvey');
		$survey_info=$this->Esurvey->get_survey_byId($survey_id);
		$this->load->view('survey/create_questionnaire',
			['survey_info'=> $survey_info]);
	}


	public function my_survey($survey_id)
	{
		$this->User->forLoggedInOnly();
		if ($_SESSION['usertype']=="Admin") {	
			$this->load->view('templates/header');
		} else {
			$this->load->view('templates/user_header');
	
		}
		
		$this->load->model('Esurvey');

		$survey_limit = "";		
		$survey_info=$this->Esurvey->get_survey_byId($survey_id);
		$survey_parting=$this->Esurvey->get_survey_parting($survey_id);
		$survey_question=$this->Esurvey->display_questions($survey_id);
		$survey_choice=$this->Esurvey->display_choices($survey_id);
		$surveyor_info= $this->Esurvey->get_surveyor($survey_info->surveyor,$survey_info->usertype);
		$answers_info= $this->Esurvey->get_answer_from_survey($survey_id);
		$respondent_limit= $this->Esurvey->get_num_respondents($survey_id);
		$r_num = 0;
		$closed_survey_info="";
		$survey_closed = "";
		

		if ($survey_info->respondents=="Specific") {
			$survey_limit= $this->Esurvey->get_respondent_limit($survey_id);
		}

		if(!empty($survey_info->code_link)){
			$closed_survey_info= $this->Esurvey->get_table_closed_survey($survey_id); 
		}

		foreach ($respondent_limit as $resp) {
			$r_num++;
		}

		$this->load->view('survey/my_survey',
			['survey_info'=> $survey_info,
			'survey_limit'=> $survey_limit,
			'survey_parting'=>$survey_parting,
			'survey_question'=>$survey_question,
			'survey_choice'=>$survey_choice,
			'answers_info'=> $answers_info,
			'r_num'=> $r_num,
			'closed_survey_info'=> $closed_survey_info,
			'surveyor_info'=>$surveyor_info]);

		$this->load->view('templates/footer');	



	}

}
?>