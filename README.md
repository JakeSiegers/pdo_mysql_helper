# pdo_mysql_helper

The goal of this library is to keep PDO mysql simple and easy to use, while making it easier to port your older mysql code. 

You'll find this libary has a very similar api to php_mysql (http://php.net/manual/en/book.mysql.php), so if you are used to old-school mysql programming in php, learning this new library will be a breeze.

This library also supports parameterized queries, which you **should always use**  to prevent SQL Injection when accepting data from the user.

# Usage
```
$dbc = new pdo_mysql_helper("location/of/credentials.php");
```
"location/of/credentials.php" would contain the credentials used to connect to the database.
This file template is located in Examples/creds
```
//location/of/credentials.php
<?php
	$server = 'localhost';
	$user = '';
	$password = '';
	$database = 'pdo-mysql-helper-example';
	$port = 3306;
?>
```
Once you have your pdo_mysql_helper object set up, you can then start executing queries!
```
//Query
$dbc->query("SELECT * FROM users WHERE age > 25");
//Results
var_dump($dbc->fetch_all_assoc());
```

[More Documentation coming very shortly]

# Examples 

**Note**: In order to run these examples, you will need to load the database dumps into your database (located at /Examples/example-database-dumps). You will also need to rename the creds.template.php to creds.php and then setup your database info inside it.

Current Examples:
* query.php - a basic mysql query example
* select_db.php - switching databases in mysql
* insert_id.php - Example showing the last insert id after a insert statement

# Changelog
## v0.2 - Beta
* The first beta release
* Finalized class structure
* Implemented all basic database methods
* Updated examples and added a "insert_id" example
* Updated example database dumps
* Properly Throws 'pdo_mysql_helper_exception' Exceptions on DB errors

#### Roadmap from here
* Testing testing testing! - I'll be using this in my own projects, so any issues I notice will be fixed immediately
* Full documentation of the library - I'd love to get some PHPDocs set up for this library. I also want to get some more examples set up to help with using the library. 
