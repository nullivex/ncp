<?php

class Db {

	static $inst = false;

	private $driver = 'mysql';
	private $host = 'localhost';
	private $port = '';
	private $user = 'root';
	private $pass = '';
	private $database = '';
	private $pdo;
	private $connected = false;
	private $query_count = 0;
	
	public static function _get(){
		if(self::$inst == false) self::$inst = new Db();
		return self::$inst;
	}
	
	public function setConfig($config){
		$this->driver = $config['driver'];
		$this->host = $config['host'];
		$this->user = $config['user'];
		$this->pass = $config['password'];
		$this->database = $config['database'];
		return $this;
	}
	
	public function connect(){

		//Connection String
		$dsn  = $this->driver.':dbname='.$this->database;
		$dsn .= ';host='.$this->host.';port='.$this->port;
		$user = $this->user;
		$pass = $this->pass;
		
		try{
			$this->pdo = new PDO(
				$dsn,
				$user,
				$pass,
				array(
					PDO::ATTR_ERRMODE	=>	PDO::ERRMODE_EXCEPTION
				)
			);
			$this->connected = true;
		}
		catch(PDOException $error){
			echo "Database Connection Failed: ".$error->getMessage();
			$this->connected = false;
		}
		
		//Set Driver Properties
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		return $this;
		
	}
	
	public function beginTransaction(){
		return $this->pdo->beginTransaction();
	}
	
	public function commit(){
		return $this->pdo->commit();
	}
	
	public function errorCode(){
		return $this->pdo->errorCode();
	}
	
	public function errorInfo(){
		return $this->pdo->errorInfo();
	}
	
	public function exec($statement){
		$this->query_count++;
		return $this->pdo->exec($statement);
	}
	
	public function getAttribute($attribute){
		return $this->pdo->getAttribute($attribute);
	}
	
	public static function getAvailableDrivers(){
		return PDO::getAvailableDrivers();
	}
	
	public function lastInsertId($name=null){
		return $this->pdo->lastInsertId($name);
	}
	
	public function prepare($statement,$driver_options=array()){
		$this->query_count++;
		try{
			$query = $this->pdo->prepare($statement,$driver_options);
		}
		catch(PDOException $error){
			echo "Query Prepare Failed: ".$error->getMessage();
			exit;
		}

		return $query;
		
	}
	
	public function fetch($query){
		$result = $query->fetch();
		$query->closeCursor();
		return $result;
	}
	
	public function query($statement){
		$this->query_count++;
		try {
			$query = $this->pdo->query($statement);
		} catch(PDOException $err){
			echo "Query Failed: ".$err->getMessage();
			echo "<br />";
			echo "$statement";
			exit;
		}
		return $query;
	}
	
	public function quote($string,$paramater_type=false){
		if($paramater_type){
			return $this->pdo->quote($string,$parameter_type);
		}
		else
		{
			return $this->pdo->quote($string);
		}
	}
	
	public function rollBack(){
		return $this->pdo->rollBack();
	}
	
	public function setAttribute($attribute,$value){
		return $this->pdo->setAttribute($attribute,$value);
	}

	public function getQueryCount(){
		return $this->query_count;
	}
	
}

