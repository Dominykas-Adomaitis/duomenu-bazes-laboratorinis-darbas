<?php

include 'libraries/cars.class.php';
$carsObj = new cars();

include 'libraries/brands.class.php';
$brandsObj = new brands();

include 'libraries/models.class.php';
$modelsObj = new models();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('id', 'modelis', 'kiekis', 'pagaminimo_data', 
    'tipas', 'produktas', 'plotis', 'ilgis', 'aukstis', 
    'spalva', 'medziaga', 'svoris', 'kaina');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	'modelis' => 15
);

// vartotojas paspaudė išsaugojimo mygtuką
if(!empty($_POST['submit'])) {
	// nustatome laukų validatorių tipus
	$validations = array (
                'id' => 'positivenumber',
		'modelis' => 'positivenumber',
		'kiekis' => 'positivenumber',
                'pagaminimo_data' => 'date',
		'tipas' => 'alfanum',
		'produktas' => 'alfanum',
		'plotis' => 'positivenumber',
		'ilgis' => 'positivenumber',
		'aukstis' => 'positivenumber',
		'spalva' => 'alfanum',
		'medziaga' => 'alfanum',
		'svoris' => 'positivenumber',
		'kaina' => 'price'
		);

	// sukuriame laukų validatoriaus objektą
	include 'utils/validator.class.php';
	$validator = new validator($validations, $required, $maxLengths);

	// laukai įvesti be klaidų
	if($validator->validate($_POST)) {
		// suformuojame laukų reikšmių masyvą SQL užklausai
		$dataPrepared = $validator->preparePostFieldsForSQL();


		// įrašome naują įrašą
		$carsObj->insertCar($dataPrepared);

		// nukreipiame vartotoją į automobilių puslapį
		common::redirect("index.php?module={$module}&action=list");
		die();
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();
		// laukų reikšmių kintamajam priskiriame įvestų laukų reikšmes
		$data = $_POST;
	}
} else {
	// tikriname, ar nurodytas elemento id. Jeigu taip, išrenkame elemento duomenis ir jais užpildome formos laukus.
	if(!empty($id)) {
		// išrenkame automobilį
		$data = $carsObj->getCar($id);
	}
}

// įtraukiame šabloną
include 'templates/car_form.tpl.php';

?>