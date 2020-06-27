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

	public function logout() {
		$this->ion_auth->logout();
		redirect('admin/');
	}

}