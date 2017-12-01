<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_priv extends CI_Model {

	public function getadminaccounts()
	{
		$this->db->select('*');
		$this->db->from('account_logs');
		$this->db->join('Admin', 'account_logs.id_no=admin.id_no');
		$query = $this->db->get();
		return $query->result();
	}

	public function getinstructoraccounts()
	{
		$this->db->select('*');
		$this->db->from('account_logs');
		$this->db->join('instructor', 'account_logs.id_no=instructor.id_no');
		$query = $this->db->get();
		return $query->result();
	}

	public function getstudentaccounts()
	{
		$this->db->select('*');
		$this->db->from('account_logs');
		$this->db->join('student_profile', 'account_logs.id_no=student_profile.id_no');
		$query = $this->db->get();
		return $query->result();
	}
	

	public function register_admin($id_no,$lastname,$firstname,$middleinitial,$gender,$address,$contactnum,$email_add)
	{
		$data = array(
			'id_no' => $id_no,
			'lastname' => $lastname,
			'firstname' => $firstname,
			'middleinitial' => $middleinitial,
			'gender' => $gender,
			'address' => $address,
			'contactnum' => $contactnum,
			'email_add' => $email_add,
		);

		return $this->db->insert('admin', $data);

	}

	public function add_admin_account($id_no,$password,$date_posted)
	{
		$data = array(
	        'id_no' => $id_no,
	        'password' => sha1($password),
	        'userType' => 'Admin',
	        'date_created' => $date_posted	
		);

		return $this->db->insert('account_logs', $data);
	}

	public function register_instructor($id_no,$lastname,$firstname,$middleinitial,$gender,$address,$contactnum,$email_add,$college)
	{
		$data = array(
			'id_no' => $id_no,
			'lastname' => $lastname,
			'firstname' => $firstname,
			'middleinitial' => $middleinitial,
			'gender' => $gender,
			'address' => $address,
			'contactnum' => $contactnum,
			'email_add' => $email_add,
			'college' => $college
		);

		return $this->db->insert('instructor', $data);

	}

	public function add_instructor_account($id_no,$password,$date_posted)
	{
		$data = array(
	        'id_no' => $id_no,
	        'password' => sha1($password),
	        'userType' => 'Instructor',
	        'date_created' => $date_posted	
		);

		return $this->db->insert('account_logs', $data);
	}


	public function register_student($id_no,$lastname,$firstname,$middleinitial,$gender,$address,$contactnum,$email_add,$course)
	{
		$data = array(
			'id_no' => $id_no,
			'lastname' => $lastname,
			'firstname' => $firstname,
			'middleinitial' => $middleinitial,
			'gender' => $gender,
			'address' => $address,
			'contactnum' => $contactnum,
			'email_add' => $email_add,
			'course' => $course
		);

		return $this->db->insert('student_profile', $data);

	}

	public function add_student_account($id_no,$password,$date_posted)
	{
		$data = array(
	        'id_no' => $id_no,
	        'password' => sha1($password),
	        'userType' => 'Student',
	        'date_created' => $date_posted	
		);

		return $this->db->insert('account_logs', $data);
	}

	public function add_activitylog($id_no,$date_posted,$activity,$usertype)
	{
		$data = array(
	        'id_no' => $id_no,
	        'date_time' => $date_posted,
	        'activity' => $activity,
	        'usertype' => $usertype
		);

		return $this->db->insert('activity_logs', $data);
	}

	public function getAdmin($id_no)
	{
		$this->db->where('id_no', $id_no);
		$query = $this->db->get('admin');

		return $query->row();
	}

	public function getInstructor($id_no)
	{
		$this->db->where('id_no', $id_no);
		$query = $this->db->get('instructor');

		return $query->row();
	}

	public function getStudent($id_no)
	{
		$this->db->where('id_no', $id_no);
		$query = $this->db->get('student_profile');

		return $query->row();
	}

	public function update_admin($id_no,$lastname,$firstname,$middleinitial,$gender,$address,$contactnum,$email_add)
	{
		$data = array(
			'lastname' => $lastname,
			'firstname' => $firstname,
			'middleinitial' => $middleinitial,
			'gender' => $gender,
			'address' => $address,
			'contactnum' => $contactnum,
			'email_add' => $email_add
		);

		$this->db->where('id_no', $id_no);
		return $this->db->update('admin', $data);
	}
    

    public function update_instructor($id_no,$lastname,$firstname,$middleinitial,$gender,$address,$contactnum,$email_add,$college)
	{
		$data = array(
			'lastname' => $lastname,
			'firstname' => $firstname,
			'middleinitial' => $middleinitial,
			'gender' => $gender,
			'address' => $address,
			'contactnum' => $contactnum,
			'email_add' => $email_add,
			'college' => $college
		);

		$this->db->where('id_no', $id_no);
		return $this->db->update('instructor', $data);
	}

	public function update_student($id_no,$lastname,$firstname,$middleinitial,$gender,$address,$contactnum,$email_add,$course)
	{
		$data = array(
			'lastname' => $lastname,
			'firstname' => $firstname,
			'middleinitial' => $middleinitial,
			'gender' => $gender,
			'address' => $address,
			'contactnum' => $contactnum,
			'email_add' => $email_add,
			'course' => $course
		);

		$this->db->where('id_no', $id_no);
		return $this->db->update('student_profile', $data);
	}


	public function remove_admin($id_no)
	{
		$tables = array('account_logs', 'admin');
		$this->db->where('id_no', $id_no);
		return $this->db->delete($tables);
	}


	public function remove_instructor($id_no)
	{
		$tables = array('account_logs', 'instructor');
		$this->db->where('id_no', $id_no);
		return $this->db->delete($tables);
	}

	public function remove_student($id_no)
	{
		$tables = array('account_logs', 'student_profile');
		$this->db->where('id_no', $id_no);
		return $this->db->delete($tables);
	}

	public function allactivities()
	{
		$query = $this->db->get('activity_logs');
		return $query->result();
	}

	public function get_for_approval()
	{
		$this->db->where('status', "for approval");
		$query = $this->db->get('survey_info');

		return $query->result();
	}

	public function approvesurvey($survey_id)
	{
		$data = array(
			'status' => "approved"
		);

		$this->db->where('survey_id', $survey_id);
		return $this->db->update('survey_info', $data);
	}

	public function disapprovesurvey($survey_id)
	{
		$data = array(
			'status' => "disapproved"
		);

		$this->db->where('survey_id', $survey_id);
		return $this->db->update('survey_info', $data);
	}

	public function deleteActivity($selected)
	{
		$this->db->where('activity_id', $selected);
		return $this->db->delete('activity_logs');
	}

	public function notif_approvesurvey($surveyor,$survey_title,$date_posted)
	{
		$data = array(
	        'id_no' => $surveyor,
	        'message' => 'Your survey request for ' .$survey_title.' has been approved',
	        'date' => $date_posted
		);

		return $this->db->insert('notifications', $data);
	}

	public function notif_disapprovesurvey($surveyor,$survey_title,$date_posted)
	{
		$data = array(
	        'id_no' => $surveyor,
	        'message' => 'Your survey request for ' .$survey_title.' has been disapproved',
	        'date' => $date_posted
		);

		return $this->db->insert('notifications', $data);
	}












}
?>