<?php 

class Esurvey extends CI_Model
{

	public function add_survey($survey_title,$survey_intro,$category,$surveyor,$respondents,$num_respondents)
	{
		$data = array(
			'survey_title' => $survey_title,
			'survey_intro' => $survey_intro,
			'category' => $category,
			'surveyor' => $surveyor,
			'respondents' => $respondents,
			'num_respondents' => $num_respondents,
			'status' => "for approval",
			'availability' => "open",
			'usertype' => $_SESSION['usertype']
		);

		return $this->db->insert('survey_info', $data);
	}

	public function add_partition($survey_id,$part,$question_type,$instruction)
	{
	
		$data = array(
			'survey_id' => $survey_id,
			'part' => $part,
			'question_type' => $question_type,
			'instruction' => $instruction
		);

		return $this->db->insert('survey_part', $data);
	}


	public function get_all_surveys()
	{
		$this->db->where('status', 'approved');
		$this->db->order_by('survey_id', 'ASC');
		$query = $this->db->get('survey_info');

		return $query->result();
	}


	public function get_surveys_limit()
	{
		$query= $this->db->query('Select * from survey_info join surveylimit where 
			survey_info.survey_id=surveylimit.survey_id and status="approved"');

		return $query->result();

	}

	public function get_new_surveyID()
	{
		$this->db->select_max('survey_id');
		$this->db->where('surveyor', $_SESSION['id_no']);
		$query = $this->db->get('survey_info');

		return $query->row();
	}

	public function limit_survey_student($survey_id,$audience)
	{
		$data = array(
			'survey_id' => $survey_id,
			'audience' => $audience,	
			'usertype' => "student"
		);

		return $this->db->insert('surveylimit', $data);
	}

	public function limit_survey_instructor($survey_id,$audience)
	{
		$data = array(
			'survey_id' => $survey_id,
			'audience' => $audience,
			'usertype' => "instructor"
		);

		return $this->db->insert('surveylimit', $data);
	}

	public function limit_survey_invited($survey_id)
	{
		$data = array(
			'survey_id' => $survey_id,
			'audience' => "invited",
			'usertype' => "invited"
		);

		return $this->db->insert('surveylimit', $data);
	}

	public function add_directlink($survey_id,$direct_link)
	{
		$data = array(
			'code_link' => $direct_link
		);

		$this->db->where('survey_id', $survey_id);
		return $this->db->update('survey_info', $data);
	}

	public function add_invitedpassword($survey_id,$pass)
	{
		$data = array(
			'survey_id' => $survey_id,
			'password_desc' => $pass,
			'status' => "Unanswered"
		);

		return $this->db->insert('closed_survey_info', $data);
	}

	public function get_respondent_limit($survey_id)
	{
		$query = $this->db->get_where('surveylimit',['survey_id'=>$survey_id]);
		return $query->result();
	}

		public function get_surveyor($id_no,$usertype)
	{
		if ($usertype=="Instructor") {
			$query = $this->db->get_where('instructor',['id_no'=>$id_no]);
		}

		if ($usertype=="Student") {
			$query = $this->db->get_where('student_profile',['id_no'=>$id_no]);
		}

		if ($usertype=="Admin") {
			$query = $this->db->get_where('admin',['id_no'=>$id_no]);

		}

		return $query->row();
	}

	public function get_survey_byId($survey_id)
	{
		$query = $this->db->get_where('survey_info',['survey_id'=>$survey_id]);
		return $query->row();
	}

	public function get_survey_parting($survey_id)
	{
		$query = $this->db->get_where('survey_part',['survey_id'=>$survey_id]);
		return $query->result();
	}

	public function get_specific_parting($survey_id,$specified)
	{
		$query = $this->db->get_where('survey_part',['survey_id'=>$survey_id]);
		return $query->result()[$specified];
	}


	public function add_question($survey_id, $question,$q,$part,$question_type)
	{
		$data = array(
			'survey_id' => $survey_id,
			'question' => $question,
			'number' => $q,
			'part' => $part,
			'question_type' => $question_type
		);

		return $this->db->insert('survey_questions', $data);
	}

	public function add_choices($survey_id,$q,$choices,$num)
	{
		$data = array(
			'survey_id' => $survey_id,
			'choice' => $choices,
			'number' => $q,
			'part' => $num
		);

		return $this->db->insert('survey_choices', $data);
	}

	public function display_questions($survey_id)
	{
		$query = $this->db->get_where('survey_questions',['survey_id'=>$survey_id]);
		return $query->result();
	}

	public function get_questions_part($survey_id,$part)
	{
		$query = $this->db->get_where('survey_questions',['survey_id'=>$survey_id, 'part'=>$part]);
		return $query->result();
	}

	public function display_choices($survey_id)
	{
		$query = $this->db->get_where('survey_choices',['survey_id'=>$survey_id]);
		return $query->result();
	}

	public function display_choices_scale($survey_id,$part)
	{
		$query = $this->db->get_where('survey_choices',['survey_id'=>$survey_id, 'part'=>$part]);
		return $query->result();
	}

	public function get_responded($respondent)
	{
		$query = $this->db->get_where('survey_respondent',['respondent'=>$respondent]);
		return $query->result();
	}

	public function get_per_survey_answered($survey_id)
	{
		$query = $this->db->get_where('survey_respondent',['survey_id'=>$survey_id]);
		return $query->result();
	}

	public function add_answer($survey_id,$number,$answer,$part)
	{
		$data = array(
			'survey_id' => $survey_id,
			'number' => $number,
			'answer' => $answer,
			'respondent' => $_SESSION['id_no'],
			'part' => $part
		);

		return $this->db->insert('survey_answer', $data);
	}

	public function respondent_to_survey($survey_id,$date_posted)
	{
		$data = array(
			'survey_id' => $survey_id,
			'date_posted' => $date_posted,
			'respondent' => $_SESSION['id_no']
		);

		return $this->db->insert('survey_respondent', $data);

	}

	public function get_all_answerable_surveys($audience)
	{
/*		$this->db->select('*');
		$this->db->from('surveylimit');
		$this->db->join('survey_info', 'surveylimit.survey_id = survey_info.survey_id
		and status="approved"
		and audience ="'.$audience.'"');
		$query = $this->db->get();
*/
		$query= $this->db->query('Select * from surveylimit join survey_info
			where surveylimit.survey_id = survey_info.survey_id
			and status="approved"
			and audience ="'.$audience.'"');

		return $query->result();
	}

	public function get_open_survey()
	{
		$this->db->where('respondents', "Open");
		$this->db->where('status', "approved");
		$this->db->where('availability', "open");
		$query = $this->db->get('survey_info');

		return $query->result();
	}

	public function get_full_survey()
	{
		$this->db->where('availability', "closed");
		$query = $this->db->get('survey_info');

		return $query->result();
	}

	public function get_close_survey($audience)
	{		
/*		$this->db->select('*');
		$this->db->from('surveylimit');
		$this->db->join('survey_info', 'surveylimit.survey_id = survey_info.survey_id 
			and status="approved"
			and audience !="'.$audience.'"');
		$this->db->group_by("survey_info.survey_id");
		$query = $this->db->get();
*/
		$query= $this->db->query('Select * from surveylimit join survey_info
			on surveylimit.survey_id = survey_info.survey_id
			where status="approved"
			and audience !="'.$audience.'"
			group by survey_info.survey_id');

		return $query->result();	
	}


	public function get_answer_from_survey($survey_id)
	{
		$this->db->where('survey_id', $survey_id);
		$query = $this->db->get('survey_answer');

		return $query->result();
	}

	public function get_num_respondents($survey_id)
	{
		$query= $this->db->query("Select * from survey_respondent where survey_id=".$survey_id);

		return $query->result();
	}

	public function get_answered_survey($id_no)
	{
		$this->db->where('respondent', $id_no);
//		$this->db->group_by("survey_id");
		$query = $this->db->get('survey_respondent');

		return $query->result();
	}

	public function get_approved()
	{
		$this->db->where('status', "approved");
		$query = $this->db->get('survey_info');

		return $query->result();
	}

	public function get_disapproved()
	{
		$this->db->where('status', "disapproved");
		$query = $this->db->get('survey_info');

		return $query->result();
	}

	public function remove_survey($survey_id)
	{
		$tables = array('survey_info', 'survey_questions', 'survey_choices', 'survey_respondent', 'surveylimit', 'survey_answer' , 'survey_part');
		$this->db->where('survey_id', $survey_id);
		return $this->db->delete($tables);
	}

	public function match_password_survey($survey_id, $survey_no, $password)
	{
		$this->db->where('survey_id', $survey_id);
		$this->db->where('survey_no', $survey_no);
		$this->db->where('password_desc', $password);
		$this->db->where('status', "Unanswered");
		$query= $this->db->get('closed_survey_info');

		return $query->row();
	}

	public function verify_codelink($survey_id, $code_link)
	{
		$this->db->where('survey_id', $survey_id);
		$this->db->where('code_link', $code_link);
		$query= $this->db->get('survey_info');

		return $query->row();
	}

	public function add_label($survey_id, $label)
	{
		$data = array(
			'label' => $label
		);

		$this->db->where('survey_id', $survey_id);
		return $this->db->update('survey_part', $data);
	}

	public function get_own_survey($id_no)
	{
		$this->db->where('surveyor', $id_no);
		$query= $this->db->get('survey_info');

		return $query->result();
	}

	public function get_pass_closed($survey_id)
	{
		$this->db->where('survey_id', $survey_id);
		$query= $this->db->get('closed_survey_info');

		return $query->row();
	}

	public function get_close_info($survey_no)
	{
		$this->db->where('survey_no', $survey_no);
		$query= $this->db->get('closed_survey_info');

		return $query->row();
	}

	public function get_table_closed_survey($survey_id)
	{
		$this->db->where('survey_id', $survey_id);
		$query= $this->db->get('closed_survey_info');

		return $query->result();
	}

	public function update_status_invited($survey_no)
	{
		$data = array(
			'status' => "Answered"
		);

		$this->db->where('survey_no', $survey_no);
		return $this->db->update('closed_survey_info', $data);
	}

	public function update_availability($survey_id)
	{
		$data = array(
			'availability' => "closed"
		);

		$this->db->where('survey_id', $survey_id);
		return $this->db->update('survey_info', $data);
	}


}
?>