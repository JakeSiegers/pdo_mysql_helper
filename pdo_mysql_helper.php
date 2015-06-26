<?php
	//The Mysqli Helper 2015 - Jake Siegers
	//It's simple for now, it will grow as I need it to :)

	//To do list:
	//==========================
	// *ERROR CHECKING
	// *ERROR LOGS (for when errors are hidden)
	// *More options for functions, util all features of PDO
	//==========================


	class pdo_mysql_helper{

		//======THESE ARE ALL REQUIRED, EITHER IN CRED FILE, OR IN ARRAY FORM!====
		public $server;	//server ip or hostname
		public $port;	//server port
		public $user;
		public $password;
		public $database;
		//========================================================================

		public $pdo;
		public $preparedStatement;

		public $error;
		public $errorDesc;
		private $errorPrefix = 'pdo_mysql_helper FATAL ERROR: ';

		public $debugMode;

		//accepts string file location of creds, or array of creds.

		function __construct($creds = NULL){

			if($creds === NULL){
				$this->log_error("Tried to create a pdo_mysql_helper without database creds!");
				return false;
			}

			if(is_array($creds)){
				if(!isset($creds['server']) || !isset($creds['user']) || !isset($creds['password']) || !isset($creds['database']) || !isset($creds['port'])){
					$this->log_error("Missing Server, User, Password or Database in config array.");
					return false;
				}
				$this->server = $creds['server'];
				$this->user = $creds['user'];
				$this->password = $creds['password'];
				$this->port = $creds['port'];
				$this->database = $creds['database'];
			}else{
				require_once($creds);
				if(!isset($server) || !isset($user) || !isset($password) || !isset($database) ||  !isset($port)  ){
					$this->log_error("Missing Server, User, Password or Database in config file.");
					return false;
				}
				$this->server = $server;
				$this->user = $user;
				$this->password = $password;
				$this->port = $port;
				$this->database = $database;
			}

			try {
				$this->pdo = new PDO('mysql:dbname='.$this->database.';host='.$this->server.';port='.$this->port,$this->user,$this->password);
			} catch (PDOException $e) {
				$this->log_error($e->getMessage());
				return false;
			}
			$this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		}

		private function log_error($msg){
			//actually log here, eventually. for now just update the variables.
			$this->error = true;
			$this->errorDesc = $this->errorPrefix.$msg;
			if($this->dieOnError){
				if($this->debugMode){
					die($this->errorDesc);
				}
				die();
			}
			return true;
		}

		private function show_stack(){

		}

		// ==============================================================================================================
		// PUBLIC FUNCTIONS BELOW
		// ==============================================================================================================

		//Use ? in your query, then pass values in array $params in the same order.
		function query($query,$params=null){
			$this->preparedStatement = $this->pdo->prepare($query);
			/*
			if(!is_null($params)){
				for($i=0;$i<count($params);$i++){
					$this->preparedStatement->bindParam($i+1, $params[$i]);
				}
			}*/
			if($this->debugMode){
				$this->preparedStatement->debugDumpParams();
			}
			try {
				if(is_null($params)){
					$this->preparedStatement->execute();
				}else{
					$this->preparedStatement->execute($params);
				}
			} catch (PDOException $e) {
				$this->log_error($e->getMessage());
				return false;
			}
		}

		function select_db($new_database){
			$this->query("USE $new_database");
		}

		function die_on_error($switch = true){
			$this->dieOnError = $switch;
		}

		function set_debug($switch = true){
			$this->debugMode = $switch;
		}
		
		function insert_id(){}
		function affected_rows(){}
		function num_rows(){}
		function fetch_array(){}
		function fetch_all_array(){}

		function rowCount(){
			return $this->preparedStatement->rowCount();
		}

		function last_error(){
			return $this->errorDesc;
		}

		function fetch_assoc(){
			return $this->preparedStatement->fetch(PDO::FETCH_ASSOC);
		}

		function fetch_all_assoc(){
			$result = array();
			while($row = $this->preparedStatement->fetch(PDO::FETCH_ASSOC)){
				$result[] = $row;
			}
			return $result;
		}

		function fetch_column(){
			return $this->preparedStatement->fetchColumn();
		}

	}

?>
