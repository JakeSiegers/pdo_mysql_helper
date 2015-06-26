<?php
	/*
		SELECT Database example - using the pdo_mysql_helper to change databases after we've already created a pdo_mysql_helper object
		In this case, we will be getting all users from the 
		(a dump of this database is avaiable in this repo)
	*/

	//Require the library
	require_once("../pdo_mysql_helper.php");

	//create a pdo helper object
	$dbc = new pdo_mysql_helper("creds.php");

	//Let's set a min age to pull from 'users'
	$minAge = 25;

	//Run the query, using parameters
	$dbc->query("SELECT * FROM users WHERE age >= ?",array($minAge));
	
	//Dump results
	echo '<pre>';
	var_dump($dbc->fetch_all_assoc());
	echo '</pre>';

	//NOW, Select New Database
	$dbc->select_db('pdo-mysql-helper-other-example');
	
	//Select from table in new database
	$dbc->query("SELECT * FROM places");
	
	//Dump results
	echo '<pre>';
	var_dump($dbc->fetch_all_assoc());
	echo '</pre>';

?>