<?php
	
include 'libraries/employees.class.php';
$employeesObj = new employees();

include 'libraries/customers.class.php';
$customersObj = new customers();

$formErrors = null;
$data = array();

// nustatome privalomus formos laukus
$required = array('uzsakymo_nr', 'pristatymo_miestas', 'pristatymo_gatve','pristatymo_namo_nr', 'pristatymo_pasto_kodas', 'uzsakymo_data', 'fk_PIRKEJASpirkejo_id');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	'uzsakymo_nr' => 20
);

// vartotojas paspaudė išsaugojimo mygtuką
if(!empty($_POST['submit'])) {
	

	// nustatome laukų validatorių tipus
	$validations = array (
		'uzsakymo_nr' => 'positivenumber',
		'pristatymo_miestas' => 'anything',
                'pristatymo_gatve' => 'anything',
                'pristatymo_namo_nr' => 'anything',
                'pristatymo_pasto_kodas' => 'anything',
                'uzsakymo_data' => 'date',
		'fk_PIRKEJASpirkejo_id' => 'positivenumber');

	// sukuriame validatoriaus objektą
	include 'utils/validator.class.php';
	$validator = new validator($validations, $required, $maxLengths);

	// laukai įvesti be klaidų
	if($validator->validate($_POST)) {
		// suformuojame laukų reikšmių masyvą SQL užklausai
		$dataPrepared = $validator->preparePostFieldsForSQL();

		// atnaujiname duomenis
		$employeesObj->updateEmployee($dataPrepared);

		// nukreipiame į modelių puslapį
		common::redirect("index.php?module={$module}&action=list");
		die();
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();
		// gauname įvestus laukus
		$data = $_POST;
	}
} else {
	// tikriname, ar nurodytas elemento id. Jeigu taip, išrenkame elemento duomenis ir jais užpildome formos laukus.
	$data = $employeesObj->getEmployee($id);
}

// įtraukiame šabloną
include 'templates/employee_form.tpl.php';

?>