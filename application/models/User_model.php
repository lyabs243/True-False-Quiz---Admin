<?php
/**
 * Created by PhpStorm.
 * User: lyabs
 * Date: 27/06/2020
 * Time: 17:08
 */

class User_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		$this->load->library('ion_auth');
	}

}