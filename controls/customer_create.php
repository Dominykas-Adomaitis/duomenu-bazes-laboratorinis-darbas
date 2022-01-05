<?php
	
include 'libraries/customers.class.php';
$customersObj = new customers();

$formErrors = null;
$data = array();

// nustatome privalomus formos laukus
$required = array('pirkejo_id', 'vardas', 'pavarde', 'miestas', 'gatve','namo_nr','pasto_kodas','telefono_nr', 'el_pastas');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	'pirkejo_id' => 11,
	'vardas' => 20,
	'pavarde' => 20
);

// vartotojas paspaudė išsaugojimo mygtuką
if(!empty($_POST['submit'])) {
	include 'utils/validator.class.php';

	// nustatome laukų validatorių tipus
	$validations = array (
		'pirkejo_id' => 'positivenumber',
		'vardas' => 'alfanum',
		'pavarde' => 'alfanum',
                'miestas' => 'alfanum',
                'gatve' => 'alfanum',
                'namo_nr' => 'alfanum',
                'pasto_kodas' => 'alfanum',
		'telefono_nr' => 'phone',
		'el_pastas' => 'email'
	);

	// sukuriame laukų validatoriaus objektą
	$validator = new validator($validations, $required, $maxLengths);

	// laukai įvesti be klaidų
	if($validator->validate($_POST)) {
		// suformuojame laukų reikšmių masyvą SQL užklausai
		$dataPrepared = $validator->preparePostFieldsForSQL();

		// redaguojame klientą
		$customersObj->insertCustomer($dataPrepared);

		// nukreipiame vartotoją į klientų puslapį
		common::redirect("index.php?module={$module}&action=list");
		die();
	}
	else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();
		// laukų reikšmių kintamajam priskiriame įvestų laukų reikšmes
		$data = $_POST;
	}
}

// įtraukiame šabloną
include 'templates/customer_form.tpl.php';

?>