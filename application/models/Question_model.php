<?php
/**
 * Created by PhpStorm.
 * User: lyabs
 * Date: 27/06/2020
 * Time: 19:43
 */

class Question_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get specific number of questions in a specific level
	 * for level=-1 it gets questions in any level
	 * @param $start
	 * @param $length
	 * @param int $level
	 */
	function get_questions($start, $length, $level=-1, $search='') {
		$sql = 'SELECT q.id, q.description, q.level, q.register_date, u.first_name, u.last_name 
		FROM questions q 
		JOIN users u 
		ON q.add_by =u.id ';
		$args = [];
		if(!empty($search))
		{
			$sql .= ' WHERE LOWER(description) LIKE ? ';
			$args[] = '%' . strtolower($search) . '%';
		}
		else if($level > -1)
		{
			$sql .= ' WHERE level = ? ';
			$args[] = $level;
		}
		$sql .= ' ORDER by register_date DESC ';

		//when searching data or get all data, there is no limit on result
		if(empty($search) && $length > 0) {
			$sql .= ' LIMIT ?, ? ';
			$args[] = $start;
			$args[] = $length;
		}

		$query = $this->db->query($sql, $args);
		return $query->result();
	}

	public function add_question($idUser, $question) {
		if(!$this->is_question_exist($question['description'])) {
			$data['description'] = $question['description'];
			$data['level'] = $question['level'];
			$data['add_by'] = $idUser;
			$data['answer'] = $question['answer'];
			$this->db->insert('questions', $data);
			$id = $this->db->insert_id();
			return $id;
		}
		return false;
	}

	function is_question_exist($description) {
		$sql = 'SELECT * 
		FROM questions q 
		WHERE LOWER(description) = ? ';

		$args = array(strtolower($description));

		$query = $this->db->query($sql, $args);
		$results = $query->result();

		foreach ($results as $result) {
			return true;
		}
		return false;
	}

	function  total_questions($level=-1, $search='') {
		$total = 0;
		$sql = '
		SELECT COUNT(*) as total
		 FROM questions 
		 ';
		$args = array();
		if(!empty($search))
		{
			$sql .= ' WHERE LOWER(description) LIKE ? ';
			$args[] = '%' . strtolower($search) . '%';
		}
		else if($level > -1)
		{
			$sql .= ' WHERE level = ? ';
			$args[] = $level;
		}
		$query = $this->db->query($sql
			,$args);
		$results = $query->result();
		foreach ($results as $result)
		{
			$total = $result->total;
		}
		return $total;
	}

}