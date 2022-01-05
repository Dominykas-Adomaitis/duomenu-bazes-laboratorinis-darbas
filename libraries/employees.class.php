<?php
/**
 * Automobilių modelių redagavimo klasė
 *
 * @author ISK
 */

class employees {
	
	private $pirkejasx_lentele = '';
	private $uzsakymasx_lentele = '';
	private $sutartisx_lentele = '';
	
	public function __construct() {
		$this->pirkejasx_lentele = config::DB_PREFIX . 'pirkejasx';
		$this->uzsakymasx_lentele = config::DB_PREFIX . 'uzsakymasx';
		$this->sutartisx_lentele = config::DB_PREFIX . 'sutartisx';
	}
	
	/**
	 * Modelio išrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getEmployee($id) {
		$query = "  SELECT *
					FROM `{$this->uzsakymasx_lentele}`
					WHERE `uzsakymo_nr`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0];
	}
	
	/**
	 * Modelių sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	public function getEmplyeesList($limit = null, $offset = null) {
		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
			
			if(isset($offset)) {
				$limitOffsetString .= " OFFSET {$offset}";
			}	
		}
		
		$query = "  SELECT `{$this->uzsakymasx_lentele}`.`uzsakymo_nr`,
                                                   `{$this->uzsakymasx_lentele}`.`pristatymo_miestas`,
						   `{$this->uzsakymasx_lentele}`.`pristatymo_gatve`,
                                                   `{$this->uzsakymasx_lentele}`.`pristatymo_namo_nr`,
                                                   `{$this->uzsakymasx_lentele}`.`uzsakymo_data`,
						    `{$this->pirkejasx_lentele}`.`vardas` AS `pirkejas`
					FROM `{$this->uzsakymasx_lentele}`
						LEFT JOIN `{$this->pirkejasx_lentele}`
							ON `{$this->uzsakymasx_lentele}`.`fk_PIRKEJASpirkejo_id`=`{$this->pirkejasx_lentele}`.`pirkejo_id`{$limitOffsetString}";
		$data = mysql::select($query);
		
		return $data;
	}

	/**
	 * Modelių kiekio radimas
	 * @return type
	 */
	public function getEmplyeesListCount() {
		$query = "  SELECT COUNT(`{$this->uzsakymasx_lentele}`.`uzsakymo_nr`) as `kiekis`
					FROM `{$this->uzsakymasx_lentele}`
						LEFT JOIN `{$this->pirkejasx_lentele}`
							ON `{$this->uzsakymasx_lentele}`.`fk_PIRKEJASpirkejo_id`=`{$this->pirkejasx_lentele}`.`pirkejo_id`";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
	
	/**
	 * Modelių išrinkimas pagal markę
	 * @param type $brandId
	 * @return type
	 */
	public function getOrderListByCustomer($brandId) {
		$query = "  SELECT *
					FROM `{$this->pirkejasx_lentele}`
					WHERE `fk_PIRKEJASpirkejo_id`='{$brandId}'";
		$data = mysql::select($query);
		
		return $data;
	}
	
	/**
	 * Modelio atnaujinimas
	 * @param type $data
	 */
	public function updateEmployee($data) {
		$query = "  UPDATE `{$this->uzsakymasx_lentele}`
					SET     `pristatymo_miestas`='{$data['pristatymo_miestas']}',
                                                `pristatymo_gatve`='{$data['pristatymo_gatve']}',
                                                `pristatymo_namo_nr`='{$data['pristatymo_namo_nr']}',
                                                `pristatymo_pasto_kodas`='{$data['pristatymo_pasto_kodas']}',
                                                `uzsakymo_data`='{$data['uzsakymo_data']}',
						`fk_PIRKEJASpirkejo_id`='{$data['fk_PIRKEJASpirkejo_id']}'
					WHERE `uzsakymo_nr`='{$data['uzsakymo_nr']}'";
		mysql::query($query);
	}
	
	/**
	 * Modelio įrašymas
	 * @param type $data
	 */
	public function insertEmployee($data) {
		$query = "  INSERT INTO `{$this->uzsakymasx_lentele}`
								(
									`uzsakymo_nr`,
                                                                        `pristatymo_miestas`,
                                                                        `pristatymo_gatve`,
                                                                        `pristatymo_namo_nr`,
                                                                        `pristatymo_pasto_kodas`,
                                                                        `uzsakymo_data`,
									`fk_PIRKEJASpirkejo_id`
								)
								VALUES
								(
									'{$data['uzsakymo_nr']}',
									'{$data['pristatymo_miestas']}',
                                                                        '{$data['pristatymo_gatve']}',
                                                                        '{$data['pristatymo_namo_nr']}',
                                                                        '{$data['pristatymo_pasto_kodas']}',
                                                                        '{$data['uzsakymo_data']}',
									'{$data['fk_PIRKEJASpirkejo_id']}'
								)";
		mysql::query($query);
	}
	
	/**
	 * Modelio šalinimas
	 * @param type $id
	 */
	public function deleteEmployee($id) {
		$query = "  DELETE FROM `{$this->uzsakymasx_lentele}`
					WHERE `uzsakymo_nr`='{$id}'";
		mysql::query($query);
	}
	
	/**
	 * Nurodyto modelio automobilių kiekio radimas
	 * @param type $id
	 * @return type
	 */
	public function getContractCountOfEmployee($id) {
		$query = "  SELECT COUNT(`{$this->sutartisx_lentele}`.`nr`) AS `kiekis`
					FROM `{$this->uzsakymasx_lentele}`
						INNER JOIN `{$this->sutartisx_lentele}`
							ON `{$this->uzsakymasx_lentele}`.`uzsakymo_nr`=`{$this->sutartisx_lentele}`.`fk_PIRKEJASpirkejo_id`
					WHERE `{$this->uzsakymasx_lentele}`.`uzsakymo_nr`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
	
	
}