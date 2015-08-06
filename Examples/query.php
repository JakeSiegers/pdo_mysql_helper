<?php
	/*
		QUERY example - using the pdo_mysql_helper to select some data from a database.
		In this case, we will be getting all users from the 'users' table
		(a dump of this database is avaiable in this repo)
	*/

	//Load up some CSS to make our example look nicer :)
	echo '<link href="style/example-style.css" rel="stylesheet" type="text/css">';

	//Require the library
	require_once("../pdo_mysql_helper.php");

	//create a pdo helper object
	$dbc = new pdo_mysql_helper("creds/creds.php");

	//Run a basic query
	$dbc->query("SELECT id,fname,lname,age FROM users");
	
	//Dump results
	echo 'All Users';
	echo '<pre>';
	var_dump($dbc->fetch_all_assoc());
	echo '</pre>';


	//Let's set a min age to pull from 'users'
	$minAge = 25;	

	//Run the query, using parameters
	$dbc->query("SELECT id,fname,lname,age FROM users WHERE age >= ?",array($minAge));
	
	//Dump results
	echo 'Age > 25';
	echo '<pre>';
	var_dump($dbc->fetch_all_assoc());
	echo '</pre>';


?>