<?php
	require 'vendor/autoload.php';
	use Kreait\Firebase\Factory;
	$factory = (new Factory)
		->withServiceAccount('data/js/krish.json')
		->withDatabaseUri('https://krishinternshala-default-rtdb.firebaseio.com/');


	$database = $factory->createDatabase();
?>