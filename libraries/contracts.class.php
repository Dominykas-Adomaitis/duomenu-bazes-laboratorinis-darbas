<?php
/**
 * Sutarčių redagavimo klasė
 *
 * @author ISK
 */

class contracts {

	private $pirkejasx_lentele = '';
	private $uzsakymasx_lentele = '';
	private $sutartisx_lentele = '';
        private $uzsakytos_paslaugos_lentele = '';
	
	public function __construct() {
		$this->pirkejasx_lentele = config::DB_PREFIX . 'pirkejasx';
		$this->uzsakymasx_lentele = config::DB_PREFIX . 'uzsakymasx';
		$this->sutartisx_lentele = config::DB_PREFIX . 'sutartisx';
                $this->uzsakytos_paslaugos_lentele = config::DB_PREFIX . 'uzsakytos_paslaugos';
	}
	
	/**
	 * Sutarčių sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	public function getContractList($limit, $offset) {
		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
		}
		if(isset($offset)) {
			$limitOffsetString .= " OFFSET {$offset}";
		}
		
		$query = "  SELECT `{$this->sutartisx_lentele}`.`nr`,
						   `{$this->sutartisx_lentele}`.`kaina`,
						   `{$this->uzsakymasx_lentele}`.`pristatymo_miestas` AS `miestas`,
						   `{$this->pirkejasx_lentele}`.`vardas` AS `pirkejas`
					FROM `{$this->sutartisx_lentele}`
						LEFT JOIN `{$this->uzsakymasx_lentele}`
							ON `{$this->sutartisx_lentele}`.`fk_UZSAKYMASuzsakymo_nr`=`{$this->uzsakymasx_lentele}`.`uzsakymo_nr`
						LEFT JOIN `{$this->pirkejasx_lentele}`
							ON `{$this->uzsakymasx_lentele}`.`fk_PIRKEJASpirkejo_id`=`{$this->pirkejasx_lentele}`.`pirkejo_id`" . $limitOffsetString;
		$data = mysql::select($query);
		
		return $data;
	}
	
	/**
	 * Sutarčių kiekio radimas
	 * @return type
	 */
	public function getContractListCount() {
		$query = "  SELECT COUNT(`{$this->sutartisx_lentele}`.`nr`) AS `kiekis`
					FROM `{$this->sutartisx_lentele}`
						LEFT JOIN `{$this->uzsakymasx_lentele}`
							ON `{$this->sutartisx_lentele}`.`fk_UZSAKYMASuzsakymo_nr`=`{$this->uzsakymasx_lentele}`.`uzsakymo_nr`
						LEFT JOIN `{$this->pirkejasx_lentele}` 
							ON `{$this->uzsakymasx_lentele}`.`fk_PIRKEJASpirkejo_id`=`{$this->pirkejasx_lentele}`.`pirkejo_id`";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
	
	/**
	 * Sutarties išrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getContract($id) {
		$query = "  SELECT      `{$this->sutartisx_lentele}`.`nr`,
					`{$this->sutartisx_lentele}`.`sutarties_data`,
					`{$this->sutartisx_lentele}`.`apmokejimo_budas`,
					`{$this->sutartisx_lentele}`.`kaina`,
					`{$this->sutartisx_lentele}`.`pristatymo_budas`,
					`{$this->sutartisx_lentele}`.`fk_UZSAKYMASuzsakymo_nr`
					FROM `{$this->sutartisx_lentele}`
					WHERE `{$this->sutartisx_lentele}`.`nr`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0];
	}
	
	/**
	 * Užsakytų papildomų paslaugų sąrašo išrinkimas
	 * @param type $orderId
	 * @return type
	 */
//	public function getOrderedServices($orderId) {
//		$query = "  SELECT *
//					FROM `{$this->uzsakytos_paslaugos_lentele}`
//					WHERE `fk_sutartis`='{$orderId}'";
//		$data = mysql::select($query);
//		
//		return $data;
//	}
	
	/**
	 * Sutarties atnaujinimas
	 * @param type $data
	 */
	public function updateContract($data) {
		$query = "  UPDATE `{$this->sutartisx_lentele}`
					SET        `sutarties_data`='{$data['sutarties_data']}',
						   `apmokejimo_budas`='{$data['apmokejimo_budas']}',
						   `kaina`='{$data['kaina']}',
						   `pristatymo_budas`='{$data['pristatymo_budas']}',
						   `fk_UZSAKYMASuzsakymo_nr`='{$data['fk_UZSAKYMASuzsakymo_nr']}'
					WHERE `nr`='{$data['nr']}'";
		mysql::query($query);
	}
	
	/**
	 * Sutarties įrašymas
	 * @param type $data
	 */
	public function insertContract($data) {
		$query = "  INSERT INTO `{$this->sutartisx_lentele}` 
			(
                                `nr`,
				`sutarties_data`,
                                `apmokejimo_budas`,
				`kaina`,
				`pristatymo_budas`,
				`fk_UZSAKYMASuzsakymo_nr`
			) 
			VALUES
			(
                                '{$data['nr']}',
				'{$data['sutarties_data']}',
				'{$data['apmokejimo_budas']}',
				'{$data['kaina']}',
				'{$data['pristatymo_budas']}',
				'{$data['fk_UZSAKYMASuzsakymo_nr']}'
			)";
		mysql::query($query);
	}
	
	/**
	 * Sutarties šalinimas
	 * @param type $id
	 */
	public function deleteContract($id) {
		$query = "  DELETE FROM `{$this->sutartisx_lentele}`
					WHERE `nr`='{$id}'";
		mysql::query($query);
	}
        
        
        
        
        
        
        
        
        
	
	/**
	 * Užsakytų papildomų paslaugų šalinimas
	 * @param type $contractId
	 */
	public function deleteOrderedServices($contractId) {
		$query = "  DELETE FROM `{$this->uzsakytos_paslaugos_lentele}`
					WHERE `fk_sutartis`='{$contractId}'";
		mysql::query($query);
	}
	
	/**
	 * Užsakytų papildomų paslaugų atnaujinimas
	 * @param type $data
	 */
	public function updateOrderedServices($data) {
		$this->deleteOrderedServices($data['nr']);
		
		if(isset($data['paslaugos']) && sizeof($data['paslaugos']) > 0) {
			foreach($data['paslaugos'] as $key=>$val) {
				$tmp = explode(":", $val);
				$serviceId = $tmp[0];
				$price = $tmp[1];
				$date_from = $tmp[2];
				$query = "  INSERT INTO `{$this->uzsakytos_paslaugos_lentele}`
										(
											`fk_sutartis`,
											`fk_kaina_galioja_nuo`,
											`fk_paslauga`,
											`kiekis`,
											`kaina`
										)
										VALUES
										(
											'{$data['nr']}',
											'{$date_from}',
											'{$serviceId}',
											'{$data['kiekiai'][$key]}',
											'{$price}'
										)";
					mysql::query($query);
			}
		}
	}
	
	/**
	 * Sutarties būsenų sąrašo išrinkimas
	 * @return type
	 */
	public function getContractStates() {
		$query = "  SELECT *
					FROM `{$this->sutarties_busenos_lentele}`";
		$data = mysql::select($query);
		
		return $data;
	}
	
	/**
	 * Aikštelių sąrašo išrinkimas
	 * @return type
	 */
	public function getParkingLots() {
		$query = "  SELECT *
					FROM `{$this->aiksteles_lentele}`";
		$data = mysql::select($query);
		
		return $data;
	}
	
	/**
	 * Paslaugos kainų įtraukimo į užsakymus kiekio radimas
	 * @param type $serviceId
	 * @param type $validFrom
	 * @return type
	 */
	public function getPricesCountOfOrderedServices($serviceId, $validFrom) {
		$query = "  SELECT COUNT(`{$this->uzsakytos_paslaugos_lentele}`.`fk_paslauga`) AS `kiekis`
					FROM `{$this->paslaugu_kainos_lentele}`
						INNER JOIN `{$this->uzsakytos_paslaugos_lentele}`
							ON `{$this->paslaugu_kainos_lentele}`.`fk_paslauga`=`{$this->uzsakytos_paslaugos_lentele}`.`fk_paslauga` AND `{$this->paslaugu_kainos_lentele}`.`galioja_nuo`=`{$this->uzsakytos_paslaugos_lentele}`.`fk_kaina_galioja_nuo`
					WHERE `{$this->paslaugu_kainos_lentele}`.`fk_paslauga`='{$serviceId}' AND `{$this->paslaugu_kainos_lentele}`.`galioja_nuo`='{$validFrom}'";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}

	public function getCustomerContracts($dateFrom, $dateTo) {
		$whereClauseString = "";
		if(!empty($dateFrom)) {
			$whereClauseString .= " WHERE `{$this->sutartisx_lentele}`.`sutarties_data`>='{$dateFrom}'";
			if(!empty($dateTo)) {
				$whereClauseString .= " AND `{$this->sutartisx_lentele}`.`sutarties_data`<='{$dateTo}'";
			}
		} else {
			if(!empty($dateTo)) {
				$whereClauseString .= " WHERE `{$this->sutartisx_lentele}`.`sutarties_data`<='{$dateTo}'";
			}
		}                 
                
                $query = "  SELECT `{$this->uzsakymasx_lentele}`.`pristatymo_miestas`,
                `{$this->uzsakymasx_lentele}`.`pristatymo_gatve`,
                `{$this->sutartisx_lentele}`.`kaina`,
                `{$this->sutartisx_lentele}`.`sutarties_data`,
                `{$this->sutartisx_lentele}`.`nr`
                FROM `{$this->uzsakymasx_lentele}`
                    INNER JOIN `{$this->sutartisx_lentele}`
                        ON `{$this->uzsakymasx_lentele}`.`uzsakymo_nr`=`{$this->sutartisx_lentele}`.`nr`
                {$whereClauseString} ORDER BY kaina DESC";             
                            
                $data = mysql::select($query);
                return $data;
	}
	
	public function getSumPriceOfContracts($dateFrom, $dateTo) {
		$whereClauseString = "";
		if(!empty($dateFrom)) {
			$whereClauseString .= " WHERE `{$this->sutartisx_lentele}`.`sutarties_data`>='{$dateFrom}'";
			if(!empty($dateTo)) {
				$whereClauseString .= " AND `{$this->sutartisx_lentele}`.`sutarties_data`<='{$dateTo}'";
			}
		} else {
			if(!empty($dateTo)) {
				$whereClauseString .= " WHERE `{$this->sutartisx_lentele}`.`sutarties_data`<='{$dateTo}'";
			}
		}
		
		$query = "  SELECT sum(`{$this->sutartisx_lentele}`.`kaina`) AS `suma`
					FROM `{$this->sutartisx_lentele}`
					{$whereClauseString}";
		$data = mysql::select($query);

		return $data;
	}

	public function getSumPriceOfOrderedServices($dateFrom, $dateTo) {
		$whereClauseString = "";
		if(!empty($dateFrom)) {
			$whereClauseString .= " WHERE `{$this->sutartisx_lentele}`.`sutarties_data`>='{$dateFrom}'";
			if(!empty($dateTo)) {
				$whereClauseString .= " AND `{$this->sutartisx_lentele}`.`sutarties_data`<='{$dateTo}'";
			}
		} else {
			if(!empty($dateTo)) {
				$whereClauseString .= " WHERE `{$this->sutartisx_lentele}`.`sutarties_data`<='{$dateTo}'";
			}
		}
		
		$query = "  SELECT  MAX(`{$this->sutartisx_lentele}`.`sutarties_data`) AS 'laikas'
                    FROM `{$this->sutartisx_lentele}` {$whereClauseString}";                  
		$data = mysql::select($query);

		return $data;
	}
	
	public function getDelayedCars($dateFrom, $dateTo) {
		$whereClauseString = "";
		if(!empty($dateFrom)) {
			$whereClauseString .= " AND `{$this->sutartys_lentele}`.`sutarties_data`>='{$dateFrom}'";
			if(!empty($dateTo)) {
				$whereClauseString .= " AND `{$this->sutartys_lentele}`.`sutarties_data`<='{$dateTo}'";
			}
		} else {
			if(!empty($dateTo)) {
				$whereClauseString .= " AND `{$this->sutartys_lentele}`.`sutarties_data`<='{$dateTo}'";
			}
		}
		
		$query = "  SELECT `nr`,
						   `sutarties_data`,
						   `planuojama_grazinimo_data_laikas`,
						   IF(`faktine_grazinimo_data_laikas`='0000-00-00 00:00:00', 'negrąžinta', `faktine_grazinimo_data_laikas`) AS `grazinta`,
						   `{$this->klientai_lentele}`.`vardas`,
						   `{$this->klientai_lentele}`.`pavarde`
					FROM `{$this->sutartys_lentele}`
						INNER JOIN `{$this->klientai_lentele}`
							ON `{$this->sutartys_lentele}`.`fk_klientas`=`{$this->klientai_lentele}`.`asmens_kodas`
					WHERE (DATEDIFF(`faktine_grazinimo_data_laikas`, `planuojama_grazinimo_data_laikas`) >= 1 OR
						(`faktine_grazinimo_data_laikas` = '0000-00-00 00:00:00' AND DATEDIFF(NOW(), `planuojama_grazinimo_data_laikas`) >= 1))
					{$whereClauseString}";
		$data = mysql::select($query);

		return $data;
	}
	
}