<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{	
		$this->User->forNotLoggedInOnly();
		$college_in="";
		$this->load->model('Esurvey');
		$open_survey=$this->Esurvey->get_open_survey();
		$off_survey=$this->Esurvey->get_close_survey($college_in);

		$this->load->view('templates/publicheader');
		$this->load->view('users/survey_home',[
			'open_survey'=>$open_survey,
			'off_survey'=>$off_survey
			]);
		$this->load->view('templates/footer');
	}
	
	public function login()
	{
		$this->User->forNotLoggedInOnly();
		
		$message="";

		$this->load->library('form_validation');

		$this->form_validation->set_rules('id_no', 'ID number', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
				
		if ($this->form_validation->run() == FALSE)
		{
				$this->load->view('templates/publicheader');
		       
		}
		else{
			$id_no = $this->input->post('id_no');
			$password = $this->input->post('password');

			if (!empty($this->User->login($id_no,$password))) {

			$this->load->helper('date');
			$datestring = '%F %j %Y - %h:%i %a';
			$time = date();
			$date_posted= mdate($datestring, $time);
			$activity="Logged in";

			$this->load->model('Admin_priv');

				$this->Admin_priv->add_activitylog(
					$_SESSION['id_no'],$date_posted,$activity,$_SESSION['usertype']);

				if ($_SESSION['usertype']=='Admin') {
					redirect(base_url('admin'));
				}
				if ($_SESSION['usertype']=='Instructor') {
					redirect(base_url('instructor'));
				}
				if ($_SESSION['usertype']=='Student') {
					redirect(base_url('student'));
				}
			}
			else
			{
					$message = [
						'status' => 'danger',
						'message' => 'Invalid username or password!'
					];
				$this->load->view('templates/publicheader');

			//redirect(base_url());
				
			}
		}
	}

	public function logout()
	{
			$this->load->helper('date');
			$datestring = '%F %j %Y - %h:%i %a';
			$time = time();
			$date_posted= mdate($datestring, $time);
			$activity="Logged out";

			$this->load->model('Admin_priv');

			$this->Admin_priv->add_activitylog(
			$_SESSION['id_no'],$date_posted,$activity,$_SESSION['usertype']);

		$this->User->logout();

		redirect(base_url());
	}

	public function changepassword()
	{
		$this->User->forLoggedInOnly();
		if ($_SESSION['usertype']=="Admin") {
			$this->load->view('templates/header');
		}
		else {
			$this->load->view('templates/user_header');
		}
	
		$message = $this->session->flashdata('message');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('oldpassword', 'Old Password', 'required');		
        $this->form_validation->set_rules('newpassword', 'New Password', 
        	'required|differs[oldpassword]|min_length[8]|max_length[15]');		
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[newpassword]');	

         if ($this->form_validation->run() == FALSE)
            {
				$this->load->view('users/change_password',['message'=>$message]);
			 }
        else
        {
			$password = $this->input->post('oldpassword');
			$newpassword = $this->input->post('newpassword');

			if (!empty($this->User->match_password($_SESSION['id_no'], $password))) {
				$this->User->update_password($_SESSION['id_no'], $password, $newpassword);

				$this->load->helper('date');
				$datestring = '%F %j %Y - %h:%i %a';
				$time = time();
				$date_posted= mdate($datestring, $time);
				$activity="Changed password";

				$this->load->model('Admin_priv');

				$this->Admin_priv->add_activitylog(
					$_SESSION['id_no'],$date_posted,$activity,$_SESSION['usertype']);
				$this->session->mark_as_flash('message');
				$this->session->set_flashdata('message', [
						'status' => 'success',
						'message' => 'Successfully changed password!'
					]);


				redirect(base_url('users/changepassword/'));

			}else{
				$this->session->mark_as_flash('message');

				$this->session->set_flashdata('message', [
						'status' => 'danger',
						'message' => 'Unable to change password!'
					]);
				redirect(base_url('users/changepassword/'));
					
			}    
		}

	}

	public function notification()
	{
		$this->User->forLoggedInOnly();
		$notifs = $this->User->get_notifs($_SESSION['id_no']);

		$this->load->view('templates/user_header');
		$this->load->view('users/notifs',
			[
				'notifs'=>$notifs
			]);
		$this->load->view('templates/footer');
	}

	public function closed_survey($survey_id,$survey_no,$code_link)
	{
		$this->User->forNotLoggedInOnly();
		$message = $this->session->flashdata('message');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('password', 'Password', 'required');		

         if ($this->form_validation->run() == FALSE)
            {
				$this->load->view('users/prompt_for_survey_closed',['message'=>$message]);
			 }
        else
        {
        	$this->load->model('Esurvey');
        	$password = $this->input->post('password');

			if (!empty($this->Esurvey->match_password_survey($survey_id, $survey_no, $password))
				and !empty($this->Esurvey->verify_codelink($survey_id, $code_link))) {
				$_SESSION['usertype'] = "Invited";
				redirect(base_url('survey/invited_to_survey/'.$survey_id ."/" .$survey_no));
			}else{
				$this->session->mark_as_flash('message');

				$this->session->set_flashdata('message', [
						'status' => 'danger',
						'message' => 'Incorrect password!'
					]);
				redirect(base_url('users/closed_survey/'.$survey_id ."/" .$survey_no ."/" .$code_link ));
					
			}    
		}
	}

	public function acknowledgement()
	{
		$this->load->view('users/thankyou');
		$this->session->unset_userdata('id_no');
		$this->session->unset_userdata('usertype');
		
	}

	public function about_us()
		{
			$this->load->view('templates/publicheader');
			$this->load->view('users/about');
		}	
}

?>