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
		if (!$this->ion_auth->logged_in()) {
			redirect('user/signin');
		}
	}

	public function index() {
		$data['user'] = $this->getUser();
		$this->load->view('admin_panel', $data);
	}

	private function getUser() {
		$user = $this->ion_auth->user()->row();
		return$user;
	}

}