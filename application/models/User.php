<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

	public function login($id_no,$password)
	{
		$this->db->where('id_no',$id_no);
		$this->db->where('password',sha1($password));
		$query = $this->db->get('account_logs');

		$userData = $query->row();

		if (!empty($userData)) {
			$this->setLoginSessions($userData);
		}
		
		return !empty($userData);
	}

	private function setLoginSessions($data)
	{
		$newdata = array(
		        'id_no'  => $data->id_no,
		        'usertype'  => $data->usertype,
		        'logged_in' => TRUE
		);

		$this->session->set_userdata($newdata);
	}

	public function logout()
	{
		$this->session->unset_userdata('id_no');
		$this->session->unset_userdata('usertype');
		$this->session->unset_userdata('logged_in');
	}

	public function forLoggedInOnly()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect(base_url('users/login'));
		}
	}
	
	public function forNotLoggedInOnly()
	{
		if ($this->session->userdata('logged_in')) {
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
	}

	public function get_courses()
	{
		$this->db->order_by('course_name', 'ASC');
		$query = $this->db->get('course');
		return $query->result();
	}

		public function get_colleges()
	{
		$this->db->order_by('college_name', 'ASC');
		$query = $this->db->get('college');
		return $query->result();
	}

	public function get_user_info()
	{
		if ($_SESSION['usertype']=="Admin") {
			$query = $this->db->get_where('admin',['id_no'=>$_SESSION['id_no']]);
			return $query->row();
		} 
		if ($_SESSION['usertype']=="Instructor") {
			$query = $this->db->get_where('instructor',['id_no'=>$_SESSION['id_no']]);
			return $query->row();
		} 
		if ($_SESSION['usertype']=="Student") {
			$query = $this->db->get_where('student_profile',['id_no'=>$_SESSION['id_no']]);
			return $query->row();
		} 

	}

	public function get_notifs($id_no)
	{
		$query = $this->db->get_where('notifications',['id_no'=>$id_no]);
		return $query->result();
	}

	public function match_password($id_no, $password)
	{		
		$this->db->where('id_no', $id_no);
		$this->db->where('password', sha1($password));
		$query= $this->db->get('account_logs');

		return $query->row();
	}

	public function update_password($id_no, $password, $newpassword)
	{
		$data = array(
	        'password' => sha1($newpassword),
		);

		$oldpassword= sha1($password);

		$this->db->where('id_no', $id_no);
		$this->db->where('password', $oldpassword);
		return $this->db->update('account_logs', $data);
	}

}