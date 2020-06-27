<?php
/**
 * Created by PhpStorm.
 * User: lyabs
 * Date: 27/06/2020
 * Time: 17:06
 */

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('form');
		$this->load->library('ion_auth');
		$this->load->model('User_model');
		$this->load->library('session');
	}

	public function signin() {
		if ($this->ion_auth->logged_in()) {
			redirect('admin/');
		}
		else {
			$this->load->view('login_page');
		}
	}

	public function login() {

		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', '« Email »', 'required');
		$this->form_validation->set_rules('password', '« Password »', 'required');

		// ajout du style pour les messages d'erreur
		$this->form_validation->set_error_delimiters('<br /><div class="errorMessage"><span style="font-size: 150%;">&uarr;&nbsp;</span>', '</div>');

		if ($this->form_validation->run() == FALSE) {
			redirect('admin/');
		} else {
			$data['email'] = $this->input->post('email');
			$data['password'] = $this->input->post('password');
			$data['remember'] = $this->input->post('remember');

			$remember = isset($data['remember'])? TRUE : FALSE; // remember the user
			$login = $this->ion_auth->login($data['email'], $data['password'], $remember);

			redirect('admin/');
		}

	}

	public function add() {
		if ($this->ion_auth->is_admin()) {
			$this->load->library('form_validation');
			// définition des règles de validation
			$this->form_validation->set_rules('email', '« Email »', 'required');
			$this->form_validation->set_rules('password', '« Password »', 'required');
			$this->form_validation->set_rules('username', '« Username »', 'required');
			$this->form_validation->set_rules('first_name', '« First name »', 'required');
			$this->form_validation->set_rules('last_name', '« Last name »', 'required');
			$this->form_validation->set_rules('user_group', '« User group »', 'required');

			if ($this->form_validation->run() == FALSE) {
				$_SESSION['success'] = false;
			} else {
				$user['email'] = $this->input->post('email');
				$user['password'] = $this->input->post('password');
				$user['username'] = $this->input->post('username');
				$user['first_name'] = $this->input->post('first_name');
				$user['last_name'] = $this->input->post('last_name');
				$user['group'] = $this->input->post('user_group');

				$result = $this->User_model->add_user($user);
				if ($result) {
					$_SESSION['success'] = true;
				}
			}
			if ($_SESSION['success']) {
				$_SESSION['message'] = 'The new user has been successfully added!';
			} else {
				$_SESSION['message'] = 'Error when adding a new user, please check your information.';
			}
		} else {
			$_SESSION['success'] = false;
			$_SESSION['message'] = 'Only administrators have the right to add a new user.';
		}
		redirect('admin/user');
	}

	public function logout() {
		$this->ion_auth->logout();
		redirect('admin/');
	}

}