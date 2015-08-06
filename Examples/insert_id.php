<?php
	/*
		Gets the last insert id for a insert on a table with an auto-increment column.
	*/

	//Load up some CSS to make our example look nicer :)
	echo '<link href="style/example-style.css" rel="stylesheet" type="text/css">';

	//Require the library
	require_once("../pdo_mysql_helper.php");

	//create a pdo helper object
	$dbc = new pdo_mysql_helper("creds/creds.php");

	$newPlace = "Bookstore";

	//Adding "Bookstore" to our database of places, remember to parameterize the query!
	$dbc->query("INSERT INTO places (place) VALUES (?)",array($newPlace));

	//Printing out the id of the inserted place
	echo 'Inserted "'.$newPlace.'" into places, its id was: '.$dbc->insert_id();
	

?>