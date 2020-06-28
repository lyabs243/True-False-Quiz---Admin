<?php
/**
 * Created by PhpStorm.
 * User: lyabs
 * Date: 28/06/2020
 * Time: 12:33
 */

include APPPATH . 'controllers/Api.php';
class Player extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('Player_model');
	}

	public function add() {
		$this->load->library('form_validation');

		// définition des règles de validation
		$this->form_validation->set_rules('id_account', '« Id Account »', 'required');
		$this->form_validation->set_rules('url_profil_pic', '« Url Profil Picture »', 'required');
		$this->form_validation->set_rules('full_name', '« Full Name »', 'required');

		$result['result'] = '0';

		if ($this->form_validation->run() == FALSE) {
			$result['result'] = '0';
		} else {
			$idAccount = $this->input->post('id_account');
			$urlProfilPic = $this->input->post('url_profil_pic');
			$fullName = $this->input->post('full_name');

			$player = $this->Player_model->add_player($idAccount, $fullName, $urlProfilPic);
			if ($player) {
				$result['result'] = '1';
			}
		}
		header( 'Content-Type: application/json; charset=utf-8' );
		echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}

}