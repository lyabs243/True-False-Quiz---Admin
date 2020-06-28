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

	public function user() {
		if(isset($this->session->message)) {
			$data['message'] = $this->session->message;
			$data['success'] = $this->session->success;

			unset($_SESSION['success']);
			unset($_SESSION['message']);
		}
		$data['user'] = $this->getUser();
		$data['users'] = $this->User_model->get_users();
		$this->load->view('admin_user_page', $data);
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

	public function question($level=0, $page=0) {
		$this->load->library('pagination');

		if(isset($this->session->message)) {
			$data['message'] = $this->session->message;
			$data['success'] = $this->session->success;

			unset($_SESSION['success']);
			unset($_SESSION['message']);
		}
		$data['user'] = $this->getUser();

		//check if user search something
		$search = $this->input->post('search');

		// configure pagination
		$config['base_url'] = base_url() . 'index.php/admin/question/' . $level . '/';
		//On the link adress level start from 0 and not from -1
		$level -= 1;
		if(isset($search)) {
			$config['total_rows'] = $this->Question_model->total_questions(-1, $search);
		} else {
			$config['total_rows'] = $this->Question_model->total_questions($level);
		}
		$config['per_page'] = (isset($search))? $config['total_rows'] : 10;

		$config['full_tag_open'] = "<nav aria-label=\"...\"><ul class='pagination'>";
		$config['full_tag_close'] = '</ul></nav>';
		$config['num_tag_open'] = '<li class="page-item" style="font-size: 16px;padding: 10px; background-color: white">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item" style="font-size: 16px;padding: 10px;color: white; background-color: #00d75e">';
		$config['cur_tag_close'] = '</li>';

		$config['first_tag_open'] = '<li class="page-item" style="font-size: 16px;padding: 10px; background-color: white">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item" style="font-size: 16px;padding: 10px; background-color: white">';
		$config['last_tag_close'] = '</li>';

		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li class="page-item" style="font-size: 16px;padding: 10px; background-color: white">';
		$config['prev_tag_close'] = '</li>';

		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="page-item" style="font-size: 16px;padding: 10px; background-color: white">';
		$config['next_tag_close'] = '</li>';

		$this->pagination->initialize($config);

		if(isset($search)) {
			$data['questions'] = $this->Question_model->get_questions((int)$page, $config['per_page'], -1, $search);
			$data['search'] = $search;
		} else {
			$data['questions'] = $this->Question_model->get_questions((int)$page, $config['per_page'], $level);
		}
		$data['per_page'] = $config['per_page'];
		$data['page'] = $page;
		$data['level'] = $level;
		$data['pagination'] = $this->pagination->create_links();
		$data['first_index'] = $page + 1;

		$this->load->view('admin_quiz_page', $data);
	}

}