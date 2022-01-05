<?php
	
include 'libraries/contracts.class.php';
$contractsObj = new contracts();

include 'libraries/employees.class.php';
$employeesObj = new employees();

include 'libraries/customers.class.php';
$customersObj = new customers();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('nr', 'sutarties_data', 'apmokejimo_budas', 'kaina', 'pristatymo_budas', 'fk_UZSAKYMASuzsakymo_nr');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	'nr' => 11
);

// vartotojas paspaudė išsaugojimo mygtuką
if(!empty($_POST['submit'])) {
	include 'utils/validator.class.php';

	// nustatome laukų validatorių tipus
	$validations = array (
		'nr' => 'positivenumber',
		'sutarties_data' => 'date',
                'apmokejimo_budas'=> 'anything',
		'kaina' => 'price',
                'pristatymo_budas' => 'anything',
                'fk_UZSAKYMASuzsakymo_nr' =>'positivenumber');



	$validator = new validator($validations, $required, $maxLengths);

	// laukai įvesti be klaidų
	if($validator->validate($_POST)) {
		// suformuojame laukų reikšmių masyvą SQL užklausai
		$dataPrepared = $validator->preparePostFieldsForSQL();


		// įrašome naują įrašą
		$contractsObj->insertContract($dataPrepared);

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
		$data = $contractsObj->getContract($id);
	}
}
// įtraukiame šabloną
include 'templates/contract_form.tpl.php';

?>