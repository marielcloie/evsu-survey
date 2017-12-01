<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{	
	
		$this->User->forLoggedInOnly();
		$this->load->view('templates/header');
		$message = $this->session->flashdata('message');

		$college_in = "";
		
		$this->load->model('Esurvey');
		$answerable_survey="";
		$survey_limit=$this->Esurvey->get_surveys_limit();
		$open_survey=$this->Esurvey->get_open_survey();
		$answered_survey=$this->Esurvey->get_answered_survey($_SESSION['id_no']);
		$off_survey=$this->Esurvey->get_close_survey($college_in);

		$this->load->view('survey/admin_view_surveys',[
			'message'=>$message,
			'open_survey'=>$open_survey,
			'answerable_survey'=>$answerable_survey,
			'off_survey'=>$off_survey,
			'answered_survey'=>$answered_survey,
			'survey_limit'=>$survey_limit]);

		$this->load->view('templates/footer');
	}

	public function manageaccounts()
	{	
		$this->User->forLoggedInOnly();
		$message = $this->session->flashdata('message');


		$this->load->model('Admin_priv');
		$admin_accounts=$this->Admin_priv->getadminaccounts();
		$instructor_accounts=$this->Admin_priv->getinstructoraccounts();
		$student_accounts=$this->Admin_priv->getstudentaccounts();		

		$this->load->view('templates/header');

		$this->load->view('admin/all_accounts',[
			'admin_accounts'=>$admin_accounts,
			'instructor_accounts'=>$instructor_accounts,
			'student_accounts'=>$student_accounts,
			'message'=>$message]
			);
		$this->load->view('templates/footer');
		
	}
	
	public function add_admin()
	{	
		$this->User->forLoggedInOnly();

		$this->load->view('templates/header');

		$this->load->library('form_validation');
		$this->form_validation->set_rules('email_add', 'E-mail address', 'required|valid_email');
        $this->form_validation->set_rules('id_no', 'ID Number', 'is_unique[account_logs.id_no]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[15]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'matches[password]');


		if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('admin/add_admin');
            }
        else
        {
			$this->load->model('Admin_priv');

			$lastname = $this->input->post('lastname');
			$firstname = $this->input->post('firstname');
			$middleinitial = $this->input->post('middleinitial');
			$gender = $this->input->post('gender');
			$address = $this->input->post('address');
			$contactnum = $this->input->post('contactnum');
			$email_add = $this->input->post('email_add');
			$id_no = $this->input->post('id_no');
			$password = $this->input->post('password');

			$this->load->helper('date');
			$datestring = '%F %j %Y - %h:%i %a';
			$time = time();
			$date_posted= mdate($datestring, $time);
 
			if ($this->Admin_priv->register_admin(
				$id_no,$lastname,$firstname,$middleinitial,$gender,$address,$contactnum,$email_add) 
				and 
				$this->Admin_priv->add_admin_account($id_no,$password,$date_posted)) {

				$activity="Added new admin account- ".$id_no;

				$this->Admin_priv->add_activitylog(
					$_SESSION['id_no'],$date_posted,$activity,$_SESSION['usertype']);

				$this->session->mark_as_flash('message');
				$this->session->set_flashdata('message', [
						'status' => 'success',
						'message' => 'Successfully Added!'
					]);

				redirect(base_url('admin/manageaccounts'));

			}else{
				$this->session->mark_as_flash('message');
				$this->session->set_flashdata('message', [
						'status' => 'error',
						'message' => 'Error!'
					]);

				redirect(base_url('admin/add_admin'));
			}
        }

		$this->load->view('templates/footer');
    }

	public function edit_admin($id_no)
	{	
		$this->User->forLoggedInOnly();

		$this->load->view('templates/header');

		$this->load->model('Admin_priv');
		$result = $this->Admin_priv->getAdmin($id_no);
		$message = $this->session->flashdata('message');

		$this->load->library('form_validation');
		$this->form_validation->set_rules('email_add', 'E-mail address', 'valid_email');


		if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('admin/edit_admin',[
                	'id_no'=>$id_no,
					'result'=>$result, 
					'message'=>$message]);
            }
        else
        {
			$lastname = $this->input->post('lastname');
			$firstname = $this->input->post('firstname');
			$middleinitial = $this->input->post('middleinitial');
			$gender = $this->input->post('gender');
			$address = $this->input->post('address');
			$contactnum = $this->input->post('contactnum');
			$email_add = $this->input->post('email_add');


			$this->load->helper('date');
			$datestring = '%F %j %Y - %h:%i %a';
			$time = time();
			$date_posted= mdate($datestring, $time);
 
			if ($this->Admin_priv->update_admin(
				$id_no,$lastname,$firstname,$middleinitial,$gender,$address,$contactnum,$email_add)){

				$activity="Edited admin account- ".$id_no;

				$this->Admin_priv->add_activitylog(
					$_SESSION['id_no'],$date_posted,$activity,$_SESSION['usertype']);

				$this->session->mark_as_flash('message');
				$this->session->set_flashdata('message', [
						'status' => 'success',
						'message' => 'Successfully Edited!'
					]);

				redirect(base_url('admin/viewadminprofile/'.$id_no));

			}else{
				$this->session->mark_as_flash('message');
				$this->session->set_flashdata('message', [
						'status' => 'error',
						'message' => 'Error!'
					]);

				redirect(base_url('admin/edit_admin/'.$id_no));
			}
        }
		$this->load->view('templates/footer');
    }

	public function add_instructor()
	{	
		$this->User->forLoggedInOnly();

		$this->load->view('templates/header');

		$colleges = $this->User->get_colleges();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email_add', 'E-mail address', 'required|valid_email');
        $this->form_validation->set_rules('id_no', 'ID Number', 'is_unique[account_logs.id_no]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[15]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'matches[password]');


		if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('admin/add_instructor',['colleges'=>$colleges]);
            }
        else
        {
			$this->load->model('Admin_priv');

			$lastname = $this->input->post('lastname');
			$firstname = $this->input->post('firstname');
			$middleinitial = $this->input->post('middleinitial');
			$gender = $this->input->post('gender');
			$address = $this->input->post('address');
			$contactnum = $this->input->post('contactnum');
			$email_add = $this->input->post('email_add');
			$college = $this->input->post('college');

			$id_no = $this->input->post('id_no');
			$password = $this->input->post('password');

			$this->load->helper('date');
			$datestring = '%F %j %Y - %h:%i %a';
			$time = time();
			$date_posted= mdate($datestring, $time);
 
			if ($this->Admin_priv->register_instructor(
				$id_no,$lastname,$firstname,$middleinitial,$gender,$address,$contactnum,$email_add,$college) 
				and 
				$this->Admin_priv->add_instructor_account($id_no,$password,$date_posted)) {

				$activity="Added new instructor account- ".$id_no;

				$this->Admin_priv->add_activitylog(
					$_SESSION['id_no'],$date_posted,$activity,$_SESSION['usertype']);

				$this->session->mark_as_flash('message');
				$this->session->set_flashdata('message', [
						'status' => 'success',
						'message' => 'Successfully Added!'
					]);

				redirect(base_url('admin/manageaccounts'));

			}else{
				$this->session->mark_as_flash('message');
				$this->session->set_flashdata('message', [
						'status' => 'error',
						'message' => 'Error!'
					]);

				redirect(base_url('admin/add_instructor'));
			}
        }

		$this->load->view('templates/footer');
    }


    public function edit_instructor($id_no)
	{	
		$this->User->forLoggedInOnly();

		$this->load->view('templates/header');
		$colleges = $this->User->get_colleges();

		$this->load->model('Admin_priv');
		$result = $this->Admin_priv->getInstructor($id_no);
		$message = $this->session->flashdata('message');

		$this->load->library('form_validation');
		$this->form_validation->set_rules('email_add', 'E-mail address', 'valid_email');


		if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('admin/edit_instructor',[
                	'id_no'=>$id_no,
					'result'=>$result, 
					'colleges'=>$colleges, 
					'message'=>$message]);
            }
        else
        {
			$lastname = $this->input->post('lastname');
			$firstname = $this->input->post('firstname');
			$middleinitial = $this->input->post('middleinitial');
			$gender = $this->input->post('gender');
			$address = $this->input->post('address');
			$contactnum = $this->input->post('contactnum');
			$email_add = $this->input->post('email_add');
			$college = $this->input->post('college');


			$this->load->helper('date');
			$datestring = '%F %j %Y - %h:%i %a';
			$time = time();
			$date_posted= mdate($datestring, $time);
 
			if ($this->Admin_priv->update_instructor(
				$id_no,$lastname,$firstname,$middleinitial,$gender,$address,$contactnum,$email_add,$college)){

				$activity="Edited instructor account- ".$id_no;

				$this->Admin_priv->add_activitylog(
					$_SESSION['id_no'],$date_posted,$activity,$_SESSION['usertype']);

				$this->session->mark_as_flash('message');
				$this->session->set_flashdata('message', [
						'status' => 'success',
						'message' => 'Successfully Edited!'
					]);

				redirect(base_url('admin/viewinstructorprofile/'.$id_no));

			}else{
				$this->session->mark_as_flash('message');
				$this->session->set_flashdata('message', [
						'status' => 'error',
						'message' => 'Error!'
					]);

				redirect(base_url('admin/edit_insructor/'.$id_no));
			}
        }
		$this->load->view('templates/footer');
    }


	public function add_student()
	{	
		$this->User->forLoggedInOnly();

		$this->load->view('templates/header');
	
		$courses= $this->User->get_courses();

		$this->load->library('form_validation');
		$this->form_validation->set_rules('email_add', 'E-mail address', 'required|valid_email');
        $this->form_validation->set_rules('id_no', 'ID Number', 'is_unique[account_logs.id_no]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[15]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'matches[password]');

		if ($this->form_validation->run() == FALSE)
            {
    		    $this->load->view('admin/add_student',['courses'=>$courses]);
	    	}
        else
        {
			$this->load->model('Admin_priv');

			$lastname = $this->input->post('lastname');
			$firstname = $this->input->post('firstname');
			$middleinitial = $this->input->post('middleinitial');
			$gender = $this->input->post('gender');
			$address = $this->input->post('address');
			$contactnum = $this->input->post('contactnum');
			$email_add = $this->input->post('email_add');
			$course = $this->input->post('course');

			$id_no = $this->input->post('id_no');
			$password = $this->input->post('password');

			$this->load->helper('date');
			$datestring = '%F %j %Y - %h:%i %a';
			$time = time();
			$date_posted= mdate($datestring, $time);

			if ($this->Admin_priv->register_student(
				$id_no,$lastname,$firstname,$middleinitial,$gender,$address,$contactnum,$email_add,$course) 
				and 
				$this->Admin_priv->add_student_account($id_no,$password,$date_posted)) {

				$activity="Added new student account- ".$id_no;

				$this->Admin_priv->add_activitylog(
					$_SESSION['id_no'],$date_posted,$activity,$_SESSION['usertype']);

				$this->session->mark_as_flash('message');
				$this->session->set_flashdata('message', [
						'status' => 'success',
						'message' => 'Successfully Added!'
					]);

				redirect(base_url('admin/manageaccounts'));

			}else{
				$this->session->mark_as_flash('message');
				$this->session->set_flashdata('message', [
						'status' => 'error',
						'message' => 'Error!'
					]);

				redirect(base_url('admin/add_student'));
			}
        }
		$this->load->view('templates/footer');


	}

	 public function edit_student($id_no)
	{	
		$this->User->forLoggedInOnly();
		$coursess= $this->User->get_courses();

		$this->load->view('templates/header');

		$this->load->model('Admin_priv');
		$result = $this->Admin_priv->getStudent($id_no);
		$message = $this->session->flashdata('message');

		$this->load->library('form_validation');
		$this->form_validation->set_rules('email_add', 'E-mail address', 'valid_email');


		if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('admin/edit_student',[
                	'id_no'=>$id_no,
					'result'=>$result, 
					'coursess'=>$coursess, 
					'message'=>$message]);
            }
        else
        {
			$lastname = $this->input->post('lastname');
			$firstname = $this->input->post('firstname');
			$middleinitial = $this->input->post('middleinitial');
			$gender = $this->input->post('gender');
			$address = $this->input->post('address');
			$contactnum = $this->input->post('contactnum');
			$email_add = $this->input->post('email_add');
			$course = $this->input->post('course');


			$this->load->helper('date');
			$datestring = '%F %j %Y - %h:%i %a';
			$time = time();
			$date_posted= mdate($datestring, $time);
 
			if ($this->Admin_priv->update_student(
				$id_no,$lastname,$firstname,$middleinitial,$gender,$address,$contactnum,$email_add,$course)){

				$activity="Edited student account- ".$id_no;

				$this->Admin_priv->add_activitylog(
					$_SESSION['id_no'],$date_posted,$activity,$_SESSION['usertype']);

				$this->session->mark_as_flash('message');
				$this->session->set_flashdata('message', [
						'status' => 'success',
						'message' => 'Successfully Edited!'
					]);

				redirect(base_url('admin/viewstudentprofile/'.$id_no));

			}else{
				$this->session->mark_as_flash('message');
				$this->session->set_flashdata('message', [
						'status' => 'error',
						'message' => 'Error!'
					]);

				redirect(base_url('admin/edit_student/'.$id_no));
			}
        }
		$this->load->view('templates/footer');
    }

	public function viewadminprofile($id_no)
	{	
		$this->load->model('Admin_priv');
		$message = $this->session->flashdata('message');
		
		$result = $this->Admin_priv->getAdmin($id_no);

		$this->load->view('templates/header');
		$this->load->view('admin/viewadminprofile',
			[
				'id_no'=>$id_no,
				'message'=>$message,
				'result'=>$result
			]);
		$this->load->view('templates/footer');
	}

	public function viewinstructorprofile($id_no)
	{	
		$this->load->model('Admin_priv');
		$message = $this->session->flashdata('message');
		

		$result = $this->Admin_priv->getInstructor($id_no);

		$this->load->view('templates/header');
		$this->load->view('admin/viewinstructorprofile',
			[
				'id_no'=>$id_no,
				'message'=>$message,
				'result'=>$result
			]);
		$this->load->view('templates/footer');
	}


	public function viewstudentprofile($id_no)
	{	
		$this->load->model('Admin_priv');
		$message = $this->session->flashdata('message');

		$result = $this->Admin_priv->getStudent($id_no);

		$this->load->view('templates/header');
		$this->load->view('admin/viewstudentprofile',
			[
				'id_no'=>$id_no,
				'message'=>$message,
				'result'=>$result
			]);
		$this->load->view('templates/footer');
	}

	public function delete_admin($id_no)
	{

		$this->load->model('Admin_priv');

		if($this->Admin_priv->remove_admin($id_no))
		{

			$this->session->mark_as_flash('message');
			$this->session->set_flashdata('message', [
						'status' => 'error',
						'message' => 'Error!'
					]);

				redirect(base_url('admin/manageaccounts/'));
		}

		else {
			$this->load->helper('date');
			$datestring = '%F %j %Y - %h:%i %a';
			$time = time();
			$date_posted= mdate($datestring, $time);
 

			$activity="Deleted admin account- ".$id_no;

				$this->Admin_priv->add_activitylog(
					$_SESSION['id_no'],$date_posted,$activity,$_SESSION['usertype']);

				$this->session->mark_as_flash('message');
				$this->session->set_flashdata('message', [
						'status' => 'success',
						'message' => 'Successfully Deleted!'
					]);


			redirect(base_url('admin/manageaccounts/'));
			}
		
	}

	public function delete_instructor($id_no)
	{

		$this->load->model('Admin_priv');

		if($this->Admin_priv->remove_instructor($id_no))
		{

			$this->session->mark_as_flash('message');
				$this->session->set_flashdata('message', [
						'status' => 'error',
						'message' => 'Error!'
					]);

				redirect(base_url('admin/manageaccounts/'));
		}
		
		else {
			$this->load->helper('date');
			$datestring = '%F %j %Y - %h:%i %a';
			$time = time();
			$date_posted= mdate($datestring, $time);
 

			$activity="Deleted instructor account- ".$id_no;

				$this->Admin_priv->add_activitylog(
					$_SESSION['id_no'],$date_posted,$activity,$_SESSION['usertype']);

				$this->session->mark_as_flash('message');
				$this->session->set_flashdata('message', [
						'status' => 'success',
						'message' => 'Successfully Deleted!'
					]);


			redirect(base_url('admin/manageaccounts/'));
		}
	}


	public function delete_student($id_no)
	{

		$this->load->model('Admin_priv');

		if($this->Admin_priv->remove_student($id_no))
		{
			$this->session->mark_as_flash('message');
			$this->session->set_flashdata('message', [
					'status' => 'error',
					'message' => 'Error!'
				]);
			redirect(base_url('admin/manageaccounts/'));
		}
		else
		{
			$this->load->helper('date');
			$datestring = '%F %j %Y - %h:%i %a';
			$time = time();
			$date_posted= mdate($datestring, $time);
 
			$activity="Deleted student account- ".$id_no;

			$this->Admin_priv->add_activitylog(
				$_SESSION['id_no'],$date_posted,$activity,$_SESSION['usertype']);

			$this->session->mark_as_flash('message');
			$this->session->set_flashdata('message', [
					'status' => 'success',
					'message' => 'Successfully Deleted!'
				]);
			redirect(base_url('admin/manageaccounts/'));

		}		
	}

	public function activitylogs()
	{
		$this->load->model('Admin_priv');
		$message = $this->session->flashdata('postmessage');
		$result= $this->Admin_priv->allactivities();

		$this->load->view('templates/header');		
		$this->load->view('admin/activity_logs',
			['result'=> $result,
			 'message'=> $message]);		
		$this->load->view('templates/footer');		
	}

	public function delete_activitylog()
	{
		$checked_count = count($_POST['activity_delete']);
		$this->load->model('Admin_priv');

		foreach ($_POST['activity_delete'] as $selected) {
			$this->Admin_priv->deleteActivity($selected);
		}

		$this->session->mark_as_flash('postmessage');
		$this->session->set_flashdata('postmessage', [
				'status' => 'success',
				'message' => 'Successfully deleted activity!'
			]);
			
		 redirect(base_url('admin/activitylogs'));

	}


	public function notification()
	{
		$this->load->model('Admin_priv');
		$message = $this->session->flashdata('message');
		$pending_survey= $this->Admin_priv->get_for_approval();


		$this->load->view('templates/header');
		$this->load->view('admin/pending_surveys',
			['pending_survey'=> $pending_survey,
			 'message'=> $message]);	
		$this->load->view('templates/footer');

	}

	public function approve_survey($survey_id)
	{
		$this->load->model('Esurvey');

		$survey_info= $this->Esurvey->get_survey_byId($survey_id);

			$this->load->helper('date');
			$datestring = '%F %j %Y - %h:%i %a';
			$time = time();
			$date_posted= mdate($datestring, $time);

		$this->load->model('Admin_priv');

		if ($this->Admin_priv->approvesurvey($survey_id)) {
 			
 			//converting password
			if (!empty($survey_info->code_link)) {
				$limit=$survey_info->num_respondents;
				
				for ($i=0; $i < $limit ; $i++) { 

					$digits_needed=8;
					$random_number=''; // set up a blank string

					$count=0;

					while ( $count < $digits_needed ) {
					    $random_digit = mt_rand(0, 9);
					    
					    $random_number .= $random_digit;
					    $count++;
					}
					$this->Esurvey->add_invitedpassword($survey_id,$random_number);
				}
			}

			$this->Admin_priv->notif_approvesurvey($survey_info->surveyor,$survey_info->survey_title,$date_posted);
			$activity="Approved Survey- ".$survey_id ." " .$survey_info->survey_title;

			$this->Admin_priv->add_activitylog(
				$_SESSION['id_no'],$date_posted,$activity,$_SESSION['usertype']);


			$this->session->mark_as_flash('message');
			$this->session->set_flashdata('message', [
				'status' => 'success',
				'message' => 'Approved Survey!'
			]);

			redirect(base_url('admin/notification/'));		
		} else {

		$this->session->mark_as_flash('message');
		$this->session->set_flashdata('message', [
			'status' => 'error',
			'message' => 'Something went wrong!'
		]);

			redirect(base_url('admin/notification/'));
		}
	}

	public function disapprove_survey($survey_id)
	{
		$this->load->model('Esurvey');

		$survey_info= $this->Esurvey->get_survey_byId($survey_id);

		$this->load->model('Admin_priv');

			$this->load->helper('date');
			$datestring = '%F %j %Y - %h:%i %a';
			$time = time();
			$date_posted= mdate($datestring, $time);

		if ($this->Admin_priv->disapprovesurvey($survey_id)) {
			$this->Admin_priv->notif_disapprovesurvey($survey_info->surveyor,$survey_info->survey_title,$date_posted);

 
			$activity="Disapproved Survey- ".$survey_id ." " .$survey_info->survey_title;

			$this->Admin_priv->add_activitylog(
				$_SESSION['id_no'],$date_posted,$activity,$_SESSION['usertype']);


			$this->session->mark_as_flash('message');
			$this->session->set_flashdata('message', [
				'status' => 'success',
				'message' => 'Disapproved Survey!'
			]);

			redirect(base_url('admin/notification/'));		
		} else {
			$this->session->mark_as_flash('message');
			$this->session->set_flashdata('message', [
				'status' => 'error',
				'message' => 'Something went wrong!'
			]);
		
			redirect(base_url('admin/notification/'));
		}
	}

	public function get_survey_info($survey_id)
	{
		$this->load->model('Esurvey');

		$survey_limit = "";		
		$survey_info=$this->Esurvey->get_survey_byId($survey_id);
		$survey_parting=$this->Esurvey->get_survey_parting($survey_id);
		$survey_question=$this->Esurvey->display_questions($survey_id);
		$survey_choice=$this->Esurvey->display_choices($survey_id);
		$surveyor_info= $this->Esurvey->get_surveyor($survey_info->surveyor,$survey_info->usertype);

		if ($survey_info->respondents=="Specific") {
			$survey_limit= $this->Esurvey->get_respondent_limit($survey_id);
		}

		$this->load->view('templates/header');
		$this->load->view('survey/forapproval',
			['survey_info'=> $survey_info,
			'survey_limit'=> $survey_limit,
			'survey_parting'=>$survey_parting,
			'survey_question'=>$survey_question,
			'survey_choice'=>$survey_choice,
			'surveyor_info'=>$surveyor_info]);

		$this->load->view('templates/footer');	
	}

	
	public function manage_surveys()
	{
		$this->load->view('templates/header');
		$message = $this->session->flashdata('message');

		$this->load->model('Esurvey');
		$approved_surveys = $this->Esurvey->get_approved();
		$disapproved_surveys = $this->Esurvey->get_disapproved();

		$this->load->view('admin/manage_survey',
			['message'=> $message,
			 'approved_surveys'=> $approved_surveys,
			 'disapproved_surveys'=> $disapproved_surveys
			]);


		$this->load->view('templates/footer');	
	}

	public function delete_survey($survey_id)
	{
		$this->load->model('Esurvey');

		if($this->Esurvey->remove_survey($survey_id))
		{

			$this->session->mark_as_flash('message');
			$this->session->set_flashdata('message', [
						'status' => 'error',
						'message' => 'Error!'
					]);

				redirect(base_url('admin/manage_surveys/'));
		}

		else {
			$this->load->helper('date');
			$datestring = '%F %j %Y - %h:%i %a';
			$time = time();
			$date_posted= mdate($datestring, $time);
 

			$activity="Deleted Survey- ".$survey_id;
				$this->load->model('Admin_priv');

				$this->Admin_priv->add_activitylog(
					$_SESSION['id_no'],$date_posted,$activity,$_SESSION['usertype']);

				$this->session->mark_as_flash('message');
				$this->session->set_flashdata('message', [
						'status' => 'success',
						'message' => 'Successfully Deleted!'
					]);


			redirect(base_url('admin/manage_surveys/'));
			}
	}




}
?>

