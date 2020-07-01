<?php
/**
 * Created by PhpStorm.
 * User: lyabs
 * Date: 14/06/2020
 * Time: 18:01
 */

include APPPATH . 'controllers/Api.php';
class PlayerScore extends Api {

	public function __construct() {
		parent::__construct();
		$this->load->model('Player_score_model');
	}

	public function add() {
		$this->load->library('form_validation');

		// définition des règles de validation
		$this->form_validation->set_rules('id_account', '« Id Account »', 'required');
		$this->form_validation->set_rules('score', '« Score »', 'required');

		if ($this->form_validation->run() == FALSE) {
			$result['result'] = '0';
		} else {
			$idAccount = $this->input->post('id_account');
			$playerScore = $this->input->post('score');

			$score = $this->Player_score_model->add_score($idAccount, $playerScore);
			$result['result'] = $score;
		}
		header( 'Content-Type: application/json; charset=utf-8' );
		echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}

	public function get_top_leadboard($start, $length, $perWeek=1, $idAccount=0) {
		$playersScore = $this->Player_score_model->get_player_score((int)$start, (int)$length, (int)$perWeek, $idAccount);
		header( 'Content-Type: application/json; charset=utf-8' );
		$result['data'] = $playersScore;
		echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		die;
	}

}