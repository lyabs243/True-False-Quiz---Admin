<?php
/**
 * Created by PhpStorm.
 * User: lyabs
 * Date: 14/06/2020
 * Time: 10:17
 */

class Player_score_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function add_score($idAccount, $score)
	{
		$data['id_account'] = $idAccount;
		$data['score'] = $score;
		$this->db->insert('tf_player_score', $data);
		$id = $this->db->insert_id();
		return $id;
	}

	//get leadboard: per week or mothly
	//can also get score of specific player
	function get_player_score($start, $length, $perWeek=1, $idAccount=0)
	{
		$sql = 'SELECT ps.id_account, p.full_name, p.url_profil_pic, SUM(ps.score) as total
				FROM tf_player_score ps
				JOIN tf_player p
				ON ps.id_account = p.id_account
				';
		if ($perWeek) {
			$sql .= ' WHERE yearweek(DATE(ps.register_date), 1) = yearweek(curdate(), 1) ';
		}
		else {
			$sql .= 'WHERE MONTH(ps.register_date) = MONTH(CURRENT_DATE())
				AND YEAR(ps.register_date) = YEAR(CURRENT_DATE()) ';
		}

		if ($idAccount <> 0) {
			$sql .= ' AND ps.id_account = ? ';
		}

		$sql .= ' GROUP BY ps.id_account
				ORDER BY total DESC
				';

		if ($idAccount == 0) {
			$sql .= ' LIMIT ?, ?';
			$args = array($start, $length);
		}
		else {
			$args = array($idAccount);
		}

		$query = $this->db->query($sql, $args);
		return $query->result();
	}
}