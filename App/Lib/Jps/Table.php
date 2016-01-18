<?php
namespace App\Lib\Jps;

	class Table {
	/**
	* @var string
	*/
	protected $jsonFilename;

	/**
	* @var array
	*/
	protected $jsonData;

	/**
	* @param string $jsonFilename
	*/
	protected $tableName;
	protected $schema;

	public function __construct($jsonFilename) {
		$path_parts         = pathinfo($jsonFilename);
		$this->tableName    = $path_parts['filename'];
		$schema             = sprintf("\\App\\Schema\\%sSchema",$this->tableName);
		$schemaObj          = new $schema();
		$this->date         = new \DateTime('NOW');
		$this->jsonFilename = $jsonFilename;
		$this->jsonData     = json_decode(file_get_contents($this->jsonFilename), true);
		$this->schema       = $schemaObj;
	}

	public function persist() {
		foreach ($this->jsonData as $jsonData) {
			$this->schema->validate($jsonData);
		}

		$json = json_encode($this->jsonData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
		file_put_contents($this->jsonFilename, $json);
	}

	/**
	* @return int
	*/
	public function count() {
		return count($this->jsonData);
	}

	/**
	* @param array $search
	* @return array
	*/
	public function find($search = []) {
		if (!$search) {
			return $this->jsonData;
		}

		$filter = Matcher::factory($search);
		return @array_values(array_filter($this->jsonData, function ($item) use ($filter) {
			return $filter->match($item);
		}));
	}

	/**
	* @param array $data
	*/
	public function insert(array $data , $check = null) {  
		if(in_array('Unique',$this->schema->getSchema('id'))) {
			$last_item    = end($this->jsonData);
			$data['id'] =  (int)($last_item['id']++);
		}

		$count = 0;

		if($check != null) {
			foreach ($check as $key) {
				if(isset($data[$key]) && count($this->find([$key => $data[$key]])) > 0) {
					$count++;
				}
			}
		}

		if($count == 0) {
			$this->jsonData[] = $data;
		} else {
			echo"Registro ja encontrado";
		}
	}

	/**
	* @param array $search
	* @return array
	*/
	public function delete($search = []) {
		if (!$search) {
			throw new \InvalidArgumentException('Falta de consulta para exclusão');
		}

		$filter = Matcher::factory($search);
		$this->jsonData = array_values(array_filter($this->jsonData, function ($item) use ($filter) {
			return !$filter->match($item);
		}));
	}

	public function update(array $search, array $update) {

		$filter = Matcher::factory($search);

		$this->jsonData = array_map(function ($item) use ($filter, $update) {

			if ($filter->match((array) $item)) {
				foreach ($update as $updateKey => $updateValue) {
					$item[$updateKey] = $updateValue;
				}
			}
			return $item;

		}, $this->jsonData);

	}
}
