<?php
/**
 * Created by PhpStorm.
 * User: lyabs
 * Date: 28/06/2020
 * Time: 12:34
 */

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Question_model');

		$apiKey = $this->input->post('api_key');
		if($apiKey != 'xz]nNQsgdye647493snnsd<*Rd,*eA4oak0w~EYs9N')
		{
			redirect('user/signin');
		}
	}
}