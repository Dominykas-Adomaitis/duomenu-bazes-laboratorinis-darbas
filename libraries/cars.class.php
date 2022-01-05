<?php
/**
 * Automobilių redagavimo klasė
 *
 * @author ISK
 */

class cars {

	private $gamintojasx_lentele = '';
	private $modelisx_lentele = '';
	private $baldasx_lentele = '';
	//private $sutartys_lentele = '';
	//private $degalu_tipai_lentele = '';
	//private $pavaru_dezes_lentele = '';
	
	public function __construct() {
		$this->gamintojasx_lentele = config::DB_PREFIX . 'gamintojasx';
		$this->modelisx_lentele = config::DB_PREFIX . 'modelisx';
		$this->baldasx_lentele = config::DB_PREFIX . 'baldasx';
	}
	
	/**
	 * Automobilio išrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getCar($id) {
		$query = "  SELECT `{$this->baldasx_lentele}`.`id`,
						   `{$this->baldasx_lentele}`.`kiekis`,
						   `{$this->baldasx_lentele}`.`pagaminimo_data`,
						   `{$this->baldasx_lentele}`.`plotis`,
						   `{$this->baldasx_lentele}`.`ilgis`,
						   `{$this->baldasx_lentele}`.`aukstis`,
						   `{$this->baldasx_lentele}`.`spalva`,
						   `{$this->baldasx_lentele}`.`medziaga`,
						   `{$this->baldasx_lentele}`.`svoris`,
						   `{$this->baldasx_lentele}`.`kaina`,
						   `{$this->baldasx_lentele}`.`tipas`,
						   `{$this->baldasx_lentele}`.`produktas`,
						   `{$this->baldasx_lentele}`.`fk_MODELISid` AS `modelis`
					FROM `{$this->baldasx_lentele}`
					WHERE `{$this->baldasx_lentele}`.`id`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0];
	}
	
	/**
	 * Automobilio atnaujinimas
	 * @param type $data
	 */
	public function updateCar($data) {
		$query = "  UPDATE `{$this->baldasx_lentele}`
					SET    `kiekis`='{$data['kiekis']}',
						   `pagaminimo_data`='{$data['pagaminimo_data']}',
						   `plotis`='{$data['plotis']}',
						   `ilgis`='{$data['ilgis']}',
						   `aukstis`='{$data['aukstis']}',
						   `spalva`='{$data['spalva']}',
						   `medziaga`='{$data['medziaga']}',
						   `svoris`='{$data['svoris']}',
						   `kaina`='{$data['kaina']}',
						   `tipas`='{$data['tipas']}',
						   `produktas`='{$data['produktas']}',
						   `fk_MODELISid`='{$data['modelis']}'
					WHERE `id`='{$data['id']}'";
		mysql::query($query);
	}

	/**
	 * Automobilio įrašymas
	 * @param type $data
	 */
	public function insertCar($data) {
		$query = "  INSERT INTO `{$this->baldasx_lentele}` 
			(
                                `id`,
				`kiekis`,
                                `pagaminimo_data`,
				`plotis`,
				`ilgis`,
				`aukstis`,
				`spalva`,
				`medziaga`,
				`svoris`,
				`kaina`,
				`tipas`,
				`produktas`,
				`fk_MODELISid`
			) 
			VALUES
			(
                                '{$data['id']}',
				'{$data['kiekis']}',
				'{$data['pagaminimo_data']}',
				'{$data['plotis']}',
				'{$data['ilgis']}',
				'{$data['aukstis']}',
				'{$data['spalva']}',
				'{$data['medziaga']}',
				'{$data['svoris']}',
				'{$data['kaina']}',
				'{$data['tipas']}',
				'{$data['produktas']}',
				'{$data['modelis']}'
			)";
		mysql::query($query);
	}
	
	/**
	 * Automobilių sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	public function getCarList($limit = null, $offset = null) {
		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
		}
		if(isset($offset)) {
			$limitOffsetString .= " OFFSET {$offset}";
		}
		
		$query = "  SELECT `{$this->baldasx_lentele}`.`id`,
						   `{$this->baldasx_lentele}`.`kiekis`,
						   `{$this->modelisx_lentele}`.`pavadinimas` AS `modelis`,
						   `{$this->gamintojasx_lentele}`.`pavadinimas` AS `gamintojas`
					FROM `{$this->baldasx_lentele}`
						LEFT JOIN `{$this->modelisx_lentele}`
							ON `{$this->baldasx_lentele}`.`fk_MODELISid`=`{$this->modelisx_lentele}`.`id`
						LEFT JOIN `{$this->gamintojasx_lentele}`
							ON `{$this->modelisx_lentele}`.`fk_GAMINTOJASid`=`{$this->gamintojasx_lentele}`.`id`" . $limitOffsetString;
		$data = mysql::select($query);
		
		return $data;
	}

	/**
	 * Automobilių kiekio radimas
	 * @return type
	 */
	public function getCarListCount() {
		$query = "  SELECT COUNT(`{$this->baldasx_lentele}`.`id`) AS `kiekis`
					FROM `{$this->baldasx_lentele}`
						LEFT JOIN `{$this->modelisx_lentele}`
							ON `{$this->baldasx_lentele}`.`fk_MODELISid`=`{$this->modelisx_lentele}`.`id`
						LEFT JOIN `{$this->gamintojasx_lentele}` 
							ON `{$this->modelisx_lentele}`.`fk_GAMINTOJASid`=`{$this->gamintojasx_lentele}`.`id`";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
	
	/**
	 * Automobilio šalinimas
	 * @param type $id
	 */
	public function deleteCar($id) {
		$query = "  DELETE FROM `{$this->baldasx_lentele}`
					WHERE `id`='{$id}'";
		mysql::query($query);
	}
}