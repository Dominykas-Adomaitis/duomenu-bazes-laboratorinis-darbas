<?php
/**
 * Klientų redagavimo klasė
 *
 * @author ISK
 */

class customers {
	
	private $pirkejas_lentele = '';
	//private $sutartys_lentele = '';
	
	public function __construct() {
		$this->pirkejas_lentele = config::DB_PREFIX . 'pirkejasx';
		//$this->sutartys_lentele = config::DB_PREFIX . 'sutartys';
	}
	
	/**
	 * Kliento išrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getCustomer($id) {
		$query = "  SELECT *
					FROM `{$this->pirkejas_lentele}`
					WHERE `pirkejo_id`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0];
	}
	
	/**
	 * Klientų sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	public function getCustomersList($limit = null, $offset = null) {
		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
		}
		if(isset($offset)) {
			$limitOffsetString .= " OFFSET {$offset}";
		}
		
		$query = "  SELECT *
					FROM `{$this->pirkejas_lentele}`" . $limitOffsetString;
		$data = mysql::select($query);
		
		return $data;
	}
	
	/**
	 * Klientų kiekio radimas
	 * @return type
	 */
	public function getCustomersListCount() {
		$query = "  SELECT COUNT(`pirkejo_id`) as `kiekis`
					FROM `{$this->pirkejas_lentele}`";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
	
	/**
	 * Kliento šalinimas
	 * @param type $id
	 */
	public function deleteCustomer($id) {
		$query = "  DELETE FROM `{$this->pirkejas_lentele}`
					WHERE `pirkejo_id`='{$id}'";
		mysql::query($query);
	}
	
	/**
	 * Kliento atnaujinimas
	 * @param type $data
	 */
	public function updateCustomer($data) {
		$query = "  UPDATE `{$this->pirkejas_lentele}`
					SET    `vardas`='{$data['vardas']}',
                                               `pavarde`='{$data['pavarde']}',
                                               `miestas`='{$data['miestas']}',
                                               `gatve`='{$data['gatve']}',
                                               `namo_nr`='{$data['namo_nr']}',
                                               `pasto_kodas`='{$data['pasto_kodas']}',
					       `telefono_nr`='{$data['telefono_nr']}',
                                               `el_pastas`='{$data['el_pastas']}'
					WHERE `pirkejo_id`='{$data['pirkejo_id']}'";
		mysql::query($query);
	}
	
	/**
	 * Kliento įrašymas
	 * @param type $data
	 */
	public function insertCustomer($data) {
		$query = "  INSERT INTO `{$this->pirkejas_lentele}`
								(
									`pirkejo_id`,
									`vardas`,
									`pavarde`,
									`miestas`,
									`gatve`,
                                                                        `namo_nr`,
                                                                        `pasto_kodas`,
                                                                        `telefono_nr`,
									`el_pastas`
								) 
								VALUES
								(
									'{$data['pirkejo_id']}',
									'{$data['vardas']}',
									'{$data['pavarde']}',
									'{$data['miestas']}',
									'{$data['gatve']}',
                                                                        '{$data['namo_nr']}',
                                                                        '{$data['pasto_kodas']}',
                                                                        '{$data['telefono_nr']}',
									'{$data['el_pastas']}'
								)";
		mysql::query($query);
	}
	
	/**
	 * Sutarčių, į kurias įtrauktas klientas, kiekio radimas
	 * @param type $id
	 * @return type
	 */
//	public function getContractCountOfCustomer($id) {
//		$query = "  SELECT COUNT(`{$this->sutartys_lentele}`.`nr`) AS `kiekis`
//					FROM `{$this->klientai_lentele}`
//						INNER JOIN `{$this->sutartys_lentele}`
//							ON `{$this->klientai_lentele}`.`pirkejo_id`=`{$this->sutartys_lentele}`.`fk_klientas`
//					WHERE `{$this->klientai_lentele}`.`pirkejo_id`='{$id}'";
//		$data = mysql::select($query);
//		
//		return $data[0]['kiekis'];
//	}
	
}