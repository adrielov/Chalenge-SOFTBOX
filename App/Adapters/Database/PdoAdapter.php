<?php
namespace App\Adapters\Database;

use App\Adapters\Contracts\IDatabaseAdapter;
use App\Models\Model;
use App\Config;

class PdoAdapter implements IDatabaseAdapter {
	private $db;
	private $connected = false;

	public function __construct ()  {
		try{
			$this->db = new \PDO(Config::get('database.providers.pdo.host'), Config::get('database.providers.pdo.user'),Config::get('database.providers.pdo.pass'), array(
				\PDO::ATTR_PERSISTENT => true
				));
			$this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			$this->connected = true;	
		}
		catch(\PDOException $e) {
			$this->connected = false;
			die($e->getMessage());
		}
	}

	public function cleanModel(Model $model , $ignore = array()) {
		$model  = (object) array_filter( (array) $model );
		foreach ($model as $key => $value) {
			if(!in_array($key, $ignore)) {
				$newMode[$key] = $value;
			}
		}
		return $newMode;
	}

	public function checkStatus () {
		if(!$this->connected){
			die("Algum erro foi encontrado ao tentar se conectar com o banco, verifique suas configurações e tent novamente.");
		}
	}

	public function save (Model $model) {
		$table = $model->getTable();
		$model = (object) array_filter( (array) $model );

		foreach ($model as $key => $value) {
			if($key !=="table" && $key !=="Adapter" && $key !== "update") {
				$keys[$key] 			= $value;
				$values["'".$value."'"] = null;
			}
		}

		$query	=  	"INSERT INTO `{$table}` (" . implode(",", array_keys($keys)) . ") VALUES(";
			$query .= 	implode(",", array_keys($values)).")";

		return $this->db->query($query);
	}

	public function delete (Model $model) {
		$table 	= $model->getTable();
		$model 	= (object) array_filter( (array) $model );

		foreach ($model as $key => $value) {
			if($key !=="table" && $key !=="Adapter" && $key !== "update" && $key !== "created_at") {
				$values[$key."='".$value."'"] = null;
			}
		}

		$query 		=  	" DELETE FROM  `{$table}` WHERE ";
		$query 	   .=	" ".implode(" AND ", array_keys($values))." LIMIT 1";

		return $this->db->query($query);

	}

	public function get (Model $model) {   
		$this->checkStatus();
		$table  = $model->getTable();
		$model  = (object) array_filter( (array) $model );
		unset($model->created_at);
		$values = array();
		foreach ($model as $key => $value) {
			if($key !=="table" && $key !=="Adapter" && $key !== "update" && $key !== "created_at") {
				if (preg_match('/GreaterThan/',$key)) {
					$key = str_replace("GreaterThan","", $key);
					$values[$key." > '".$value."'"] = null;
				} else {
					$values[$key."='".$value."'"] = null;
				}
			}
		}
		$where  = (count($values) > 0) ? "WHERE" : false;

		$query      =   " SELECT * FROM `{$table}` {$where} ";
		$query     .=   " ".implode(" AND ", array_keys($values))." ";
		$execute    =   $this->db->query($query);
		$result     =   $execute->fetchAll(\PDO::FETCH_ASSOC);
		return $result[0];
	}


	public function getall (Model $model) {   
		$this->checkStatus();
		$table  = $model->getTable();
		$model  = (object) array_filter( (array) $model );
		unset($model->created_at);
		$values = array();
		foreach ($model as $key => $value) {
			if($key !=="table" && $key !=="Adapter" && $key !== "update" && $key !== "created_at") {
				if (preg_match('/GreaterThan/',$key)) {
					$key = str_replace("GreaterThan","", $key);
					$values[$key." > '".$value."'"] = null;
				} else {
					$values[$key."='".$value."'"] = null;
				}
			}
		}
		$where  = (count($values) > 0) ? "WHERE" : false;

		$query      =   " SELECT * FROM `{$table}` {$where} ";
		$query     .=   " ".implode(" AND ", array_keys($values))." ";
		$execute    =   $this->db->query($query);
		$result     =   $execute->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
	}

	public function update (Model $model) {
		$this->checkStatus();
		$table 			= $model->getTable();
		$model 			= (object) array_filter( (array) $model );
		$model->update 	= array_filter( (array) $model->update );
		foreach ($model as $key => $value) {
			if($key !=="table" && $key !=="Adapter" && $key !== "update" && $key !== "created_at") {
				$values[$key."='".$value."'"] 	= null;
			}
		}

		if(count($model->update) > 0) {
			foreach ($model->update as $key => $value) {
				$update[$key."='".$value."'"] = $value;
			}
		} else {
			return false;
		}
		$query 		=  	" UPDATE `{$table}` SET " . implode(",", array_keys($update)) . " WHERE ";
		$query 	   .=	" ".implode(" AND ", array_keys($values))." ";

		return $this->db->query($query);
	}
}