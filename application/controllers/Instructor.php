<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instructor extends CI_Controller {

	public function index()
	{	
		$this->User->forLoggedInOnly();
		$this->load->view('templates/user_header');
		$message = $this->session->flashdata('message');

		$user_info = $this->User->get_user_info();

		$college_in = $user_info->college;


		$this->load->model('Esurvey');
		$answerable_survey=$this->Esurvey->get_all_answerable_surveys($college_in);
		$survey_limit=$this->Esurvey->get_surveys_limit();
		$open_survey=$this->Esurvey->get_open_survey();
		$answered_survey=$this->Esurvey->get_answered_survey($_SESSION['id_no']);
		$off_survey=$this->Esurvey->get_close_survey($college_in);
		$closed_survey=$this->Esurvey->get_full_survey();

		$this->load->view('instructor/index');
		$this->load->view('survey/surveys',[
			'message'=>$message,
			'open_survey'=>$open_survey,
			'answerable_survey'=>$answerable_survey,
			'off_survey'=>$off_survey,
			'answered_survey'=>$answered_survey,
			'closed_survey'=>$closed_survey,
			'survey_limit'=>$survey_limit]);

		$this->load->view('templates/footer');
	}

	public function viewprofile()
	{	
		$this->User->forLoggedInOnly();
		$this->load->model('Admin_priv');
		$this->load->model('Esurvey');
		$result = $this->Admin_priv->getInstructor($_SESSION['id_no']);
		$own_surveys = $this->Esurvey->get_own_survey($_SESSION['id_no']);


		$this->load->view('templates/user_header');
		$this->load->view('instructor/viewprofile',
			[
				'id_no'=>$_SESSION['id_no'],
				'result'=>$result
			]);

		if (!empty($own_surveys)) {
			$this->load->view('users/ownsurvey',[
				'own_surveys'=>$own_surveys
				]);
		}

		$this->load->view('templates/footer');
	}



}
?>

