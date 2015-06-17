<?php
	//The Mysqli Helper 2015 - Jake Siegers
	//It's simple for now, it will grow as I need it to :)

	//To do list:
	//==========================
	// *ERROR CHECKING
	// *ERROR LOGS (for when errors are hidden)
	// *More options for functions, util all features of PDO
	//==========================


	class pdo_helper{

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
		private $errorPrefix = 'pdo_helper FATAL ERROR: ';

		//accepts string file location of creds, or array of creds.

		function __construct($creds){
			if(!is_array($creds)){
				require_once($creds);
				$this->server = $server;
				$this->user = $user;
				$this->password = $password;
				$this->port = $port;
				$this->database = $database;
			}else{
				$this->server = $creds['server'];
				$this->user = $creds['user'];
				$this->password = $creds['password'];
				$this->port = $creds['port'];
				$this->database = $creds['database'];
			}

			try {
				$this->pdo = new PDO('mysql:dbname='.$this->database.';host='.$this->server.';port='.$this->port,$this->user,$this->password);
			} catch (PDOException $e) {
				$this->logError($e->getMessage());
				return false;
			}
			$this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		}

		private function logError($msg){
			//actually log here, eventually. for now just update the variables.
			$this->error = true;
			$this->errorDesc = $this->errorPrefix.$msg;
			return true;
		}

		//Use ? in your query, then pass values in array $params in the same order.
		function query($query,$params=null){
			$this->preparedStatement = $this->pdo->prepare($query);
			if(!is_null($params)){
				for($i=0;$i<count($params);$i++){
					$this->preparedStatement->bindParam($i+1, $params[$i]);
				}
			}
			try {
				$this->preparedStatement->execute();
			} catch (PDOException $e) {
				$this->logError($e->getMessage());
				return false;
			}
		}

		function rowCount(){
			return $this->preparedStatement->rowCount();
		}

		function lastError(){
			return $this->errorDesc;
		}

		function fetchAssoc(){
			return $this->preparedStatement->fetch(PDO::FETCH_ASSOC);
		}

		function fetchAllAssoc(){
			$result = array();
			while($row = $this->preparedStatement->fetch(PDO::FETCH_ASSOC)){
				$result[] = $row;
			}
			return $result;
		}

		function fetchColumn(){
			return $this->preparedStatement->fetchColumn();
		}

	}

?>
