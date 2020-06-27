<?php
/**
 * Created by PhpStorm.
 * User: lyabs
 * Date: 27/06/2020
 * Time: 14:21
 */

class Admin extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('ion_auth');
		$this->load->helper('url');
		$this->load->model('User_model');
		$this->load->model('Question_model');
		if (!$this->ion_auth->logged_in()) {
			redirect('user/signin');
		}
	}

	public function index() {
		$data['user'] = $this->getUser();
		$data['users'] = $this->User_model->get_users();
		$data['questions'] = $this->Question_model->get_questions(0, 5);
		$data['total_easy_question'] = $this->Question_model->total_questions(0);
		$data['total_medium_question'] = $this->Question_model->total_questions(1);
		$data['total_hard_question'] = $this->Question_model->total_questions(2);
		$this->load->view('admin_panel', $data);
	}

	private function getUser() {
		$user = $this->ion_auth->user()->row();
		return$user;
	}

}