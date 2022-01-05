<?php
/**
 * Automobilių modelių redagavimo klasė
 *
 * @author ISK
 */

class models {
	
	private $gamintojasx_lentele = '';
	private $modelisx_lentele = '';
	private $baldasx_lentele = '';
	
	public function __construct() {
		$this->gamintojasx_lentele = config::DB_PREFIX . 'gamintojasx';
		$this->modelisx_lentele = config::DB_PREFIX . 'modelisx';
		$this->baldasx_lentele = config::DB_PREFIX . 'baldasx';
	}
	
	/**
	 * Modelio išrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getModel($id) {
		$query = "  SELECT *
					FROM `{$this->modelisx_lentele}`
					WHERE `id`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0];
	}
	
	/**
	 * Modelių sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	public function getModelList($limit = null, $offset = null) {
		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
			
			if(isset($offset)) {
				$limitOffsetString .= " OFFSET {$offset}";
			}	
		}
		
		$query = "  SELECT `{$this->modelisx_lentele}`.`id`,
						   `{$this->modelisx_lentele}`.`pavadinimas`,
						    `{$this->gamintojasx_lentele}`.`pavadinimas` AS `gamintojas`
					FROM `{$this->modelisx_lentele}`
						LEFT JOIN `{$this->gamintojasx_lentele}`
							ON `{$this->modelisx_lentele}`.`fk_GAMINTOJASid`=`{$this->gamintojasx_lentele}`.`id`{$limitOffsetString}";
		$data = mysql::select($query);
		
		return $data;
	}

	/**
	 * Modelių kiekio radimas
	 * @return type
	 */
	public function getModelListCount() {
		$query = "  SELECT COUNT(`{$this->modelisx_lentele}`.`id`) as `kiekis`
					FROM `{$this->modelisx_lentele}`
						LEFT JOIN `{$this->gamintojasx_lentele}`
							ON `{$this->modelisx_lentele}`.`fk_GAMINTOJASid`=`{$this->gamintojasx_lentele}`.`id`";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
	
	/**
	 * Modelių išrinkimas pagal markę
	 * @param type $brandId
	 * @return type
	 */
	public function getModelListByBrand($brandId) {
		$query = "  SELECT *
					FROM `{$this->modelisx_lentele}`
					WHERE `fk_GAMINTOJASid`='{$brandId}'";
		$data = mysql::select($query);
		
		return $data;
	}
	
	/**
	 * Modelio atnaujinimas
	 * @param type $data
	 */
	public function updateModel($data) {
		$query = "  UPDATE `{$this->modelisx_lentele}`
					SET    `pavadinimas`='{$data['pavadinimas']}',
						   `fk_GAMINTOJASid`='{$data['fk_GAMINTOJASid']}'
					WHERE `id`='{$data['id']}'";
		mysql::query($query);
	}
	
	/**
	 * Modelio įrašymas
	 * @param type $data
	 */
	public function insertModel($data) {
		$query = "  INSERT INTO `{$this->modelisx_lentele}`
								(
                                                                        `id`,
									`pavadinimas`,
									`fk_GAMINTOJASid`
								)
								VALUES
								(
                                                                        '{$data['id']}',
									'{$data['pavadinimas']}',
									'{$data['fk_GAMINTOJASid']}'
								)";
		mysql::query($query);
	}
	
	/**
	 * Modelio šalinimas
	 * @param type $id
	 */
	public function deleteModel($id) {
		$query = "  DELETE FROM `{$this->modelisx_lentele}`
					WHERE `id`='{$id}'";
		mysql::query($query);
	}
	
	/**
	 * Nurodyto modelio automobilių kiekio radimas
	 * @param type $id
	 * @return type
	 */
	public function getCarCountOfModel($id) {
		$query = "  SELECT COUNT(`{$this->baldasx_lentele}`.`id`) AS `kiekis`
					FROM `{$this->modelisx_lentele}`
						INNER JOIN `{$this->baldasx_lentele}`
							ON `{$this->modelisx_lentele}`.`id`=`{$this->baldasx_lentele}`.`fk_MODELISid`
					WHERE `{$this->modelisx_lentele}`.`id`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
	
	
}