<?php
/**
 * Created by PhpStorm.
 * User: lyabs
 * Date: 27/06/2020
 * Time: 22:54
 */

class Question extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('Question_model');
		$this->load->library('ion_auth');
		if (!$this->ion_auth->logged_in()) {
			redirect('user/signin');
		}
	}

	public function add() {
		$this->load->library('form_validation');

		$user = $this->ion_auth->user()->row();

		// définition des règles de validation
		$this->form_validation->set_rules('question', '« Question »', 'required');
		$this->form_validation->set_rules('level', '« Level »', 'required');

		$_SESSION['success'] = true;
		if ($this->form_validation->run() == FALSE) {
			$_SESSION['success'] = false;
		} else {
			$question['description'] = $this->input->post('question');
			$question['level'] = $this->input->post('level');

			$question['answer'] = (int)$this->input->post('answer');

			$result = $this->Question_model->add_question($user->id, $question);
			if(!$result) {
				$_SESSION['success'] = false;
			}
		}
		if ($_SESSION['success']) {
			$_SESSION['message'] = 'The new question has been successfully added!';
		} else {
			$_SESSION['message'] = 'Error when adding a new question, please check your data maybe the question is already exist.';
		}
		redirect('admin/question');
	}

}