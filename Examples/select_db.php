<?php
	/*
		Select_DB Example - Connect to a database and select some data - then switch to a different database on the same server and select some other data!
	*/

	//Load up some CSS to make our example look nicer :)
	echo '<link href="style/example-style.css" rel="stylesheet" type="text/css">';

	//Require the library
	require_once("../pdo_mysql_helper.php");

	//create a pdo helper object
	$dbc = new pdo_mysql_helper("creds/creds.php");

	//Select from table in first database
	$dbc->query("SELECT * FROM users");
	
	//Dump results
	echo '<pre>';
	var_dump($dbc->fetch_all_assoc());
	echo '</pre>';

	//NOW, Select New Database
	$dbc->select_db('pdo-mysql-helper-other-example');
	
	//Select from table in new database
	$dbc->query("SELECT * FROM users");
	
	//Dump results
	echo '<pre>';
	var_dump($dbc->fetch_all_assoc());
	echo '</pre>';

?>