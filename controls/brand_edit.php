<?php

include 'libraries/brands.class.php';
$brandsObj = new brands();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('pavadinimas', 'id');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	'pavadinimas' => 20
);

// paspaustas išsaugojimo mygtukas
if(!empty($_POST['submit'])) {
	// nustatome laukų validatorių tipus
	$validations = array (
		'pavadinimas' => 'anything',
                'id' => 'positivenumber');

	// sukuriame validatoriaus objektą
	include 'utils/validator.class.php';
	$validator = new validator($validations, $required, $maxLengths);

	if($validator->validate($_POST)) {
		// suformuojame laukų reikšmių masyvą SQL užklausai
		$dataPrepared = $validator->preparePostFieldsForSQL();

		// atnaujiname duomenis
		$brandsObj->updateBrand($dataPrepared);
                $brandsObj->updateBrandModel($dataPrepared);

		// nukreipiame į markių puslapį
		common::redirect("index.php?module={$module}&action=list");
		die();
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();
		// gauname įvestus laukus
		$data = $_POST;
                 if(isset($_POST['miestai']) && sizeof($_POST['miestai']) > 0) {
			$i = 0;
			foreach($_POST['pavadinimai'] as $key => $val) {
				$data['papildomi_modeliai'][$i]['id_MODELIS'] = $_POST['idai'][$key];
                                $data['papildomi_modeliai'][$i]['miesta'] = $val;
                                $data['papildomi_modeliai'][$i]['pavadinimas'] = $_POST['pavadinimai'][$key];
//				$data['kategorijos_atributai'][$i]['neaktyvus'] = $_POST['neaktyvus'][$key];
				$i++;
			}
		}
	}
} else {
    // tikriname, ar nurodytas elemento id. Jeigu taip, išrenkame elemento duomenis ir jais užpildome formos laukus.
	
		//$data = $brandsObj->getBrand($id);
                if(!empty($id)) {
		$data = $brandsObj->getBrand($id);
		$tmp = $brandsObj->getBrandModel($id);
		if(sizeof($tmp) > 0) {
			foreach($tmp as $key => $val) {
				
				$data['papildomi_modeliai'][] = $val;
			}
		}
	}
		
	// išrenkame elemento duomenis ir jais užpildome formos laukus.
	//$data = $brandsObj->getBrand($id);
}

// įtraukiame šabloną
include 'templates/brand_form.tpl.php';

?>