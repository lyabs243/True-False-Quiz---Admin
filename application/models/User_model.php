<?php
/**
 * Created by PhpStorm.
 * User: lyabs
 * Date: 27/06/2020
 * Time: 17:08
 */

class User_model extends CI_Model {

	public function __construct() {
		$this->load->database();
		$this->load->library('ion_auth');
	}

	public function add_user($user) {
		$password = $user['password'];
		$email = $user['email'];
		$additional_data = array(
			'username' => $user['username'],
			'first_name' => $user['first_name'],
			'last_name' => $user['last_name'],
		);
		$group = array($user['group']);

		return $this->ion_auth->register('username', $password, $email, $additional_data, $group);
	}

	public function get_users() {
		return $this->ion_auth->users()->result();
	}

}