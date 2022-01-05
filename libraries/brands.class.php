<?php
/**
 * Batu gamintoju redagavimo klasė
 *
 * @author ISK
 */

class brands {
	
	private $gamintojas_lentele = '';
	private $modelis_lentele = '';
	
	public function __construct() {
		$this->gamintojas_lentele = config::DB_PREFIX . 'gamintojasx';
		$this->modelis_lentele = config::DB_PREFIX . 'modelisx';
	}
	
	/**
	 * Markės išrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getBrand($id) {
		$query = "  SELECT *
					FROM {$this->gamintojas_lentele}
					WHERE `id`='{$id}'";
		$data = mysql::select($query);
		return $data[0];
	}
        
       

	/**
	 * Markių sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	public function getBrandList($limit = null, $offset = null) {
		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
			
			if(isset($offset)) {
				$limitOffsetString .= " OFFSET {$offset}";
			}	
		}
		
		$query = "  SELECT *
					FROM {$this->gamintojas_lentele}{$limitOffsetString}";
		$data = mysql::select($query);
		
		return $data;
	}

	/**
	 * Markių kiekio radimas
	 * @return type
	 */
	public function getBrandListCount() {
		$query = "  SELECT COUNT(`id`) as `kiekis`
					FROM {$this->gamintojas_lentele}";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
	
	/**
	 * Markės įrašymas
	 * @param type $data
	 */
	public function insertBrand($data) {
		$query = "  INSERT INTO {$this->gamintojas_lentele}
								(
                                                                        `id`,
									`pavadinimas`
								)
								VALUES
								(
                                                                        '{$data['id']}',
									'{$data['pavadinimas']}'
								)";
                                                                        
		mysql::query($query);
	}
	
	/**
	 * Markės atnaujinimas
	 * @param type $data
	 */
	public function updateBrand($data) {
		$query = "  UPDATE {$this->gamintojas_lentele}
					SET    `pavadinimas`='{$data['pavadinimas']}'
					WHERE `id`='{$data['id']}'";
		mysql::query($query);
	}
	
	/**
	 * Markės šalinimas
	 * @param type $id
	 */
	public function deleteBrand($id) {
		$query = "  DELETE FROM {$this->gamintojas_lentele}
					WHERE `id`='{$id}'";
		mysql::query($query);
	}
	
	/**
	 * Markės modelių kiekio radimas
	 * @param type $id
	 * @return type
	 */
	public function getModelCountOfBrand($id) {
		$query = "  SELECT COUNT({$this->modelis_lentele}.`id`) AS `kiekis`
					FROM {$this->gamintojas_lentele}
						INNER JOIN {$this->modelis_lentele}
							ON {$this->gamintojas_lentele}.`id`={$this->modelis_lentele}.`fk_GAMINTOJASid`
					WHERE {$this->gamintojas_lentele}.`id`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
        
        
        public function getBrandModel($brandId) {
		$query = "  SELECT *
					FROM `{$this->modelis_lentele}`
					WHERE `fk_GAMINTOJASid`='{$brandId}'";
		$data = mysql::select($query);
		
		return $data;
	}
        
	public function insertBrandModel($data) {
		if(isset($data['pavadinimai']) && sizeof($data['pavadinimai']) > 0) {
			foreach($data['pavadinimai'] as $key=>$val) {
					$query = "  INSERT INTO `{$this->modelis_lentele}`
					(                                                     
                                            `fk_GAMINTOJASid`,
                                            `id`,
                                            `pavadinimas`
					)
					VALUES
					(
                                            '{$data['id_GAMINTOJAS']}',
                                            '{$data['idai'][$key]}',
                                            '{$val}'
					)";
					mysql::query($query);
				
			}
		}
	}
        public function deleteBrandModel($brandId) {
		$query = "  DELETE FROM `{$this->modelis_lentele}`
					WHERE `fk_GAMINTOJASid`='{$brandId}'";
		mysql::query($query);
	}
         public function updateBrandModel($data) {
		$this->deleteBrandModel($data['id']);
		
		if(isset($data['pavadinimai']) && sizeof($data['pavadinimai']) > 0) {
			foreach($data['pavadinimai'] as $key=>$val) {
					$query = "  INSERT INTO `{$this->modelis_lentele}`
					(
                                            `fk_GAMINTOJASid`,
                                            `id`,
                                            `pavadinimas`
					)
					VALUES
					(
					'{$data['id']}',
					'{$data['idai'][$key]}',
					'{$val}'
                                        )";
					mysql::query($query);
				
			}
		}
	}
}