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
		$this->load->helper('url');
	}

	public function index() {
		$this->load->view('admin_panel');
	}

}