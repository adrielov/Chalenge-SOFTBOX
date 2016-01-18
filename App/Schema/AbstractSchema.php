<?php

namespace App\Schema;

abstract class AbstractSchema {
	protected $schema = array();

	public  function validate($obj) {
		foreach ($this->schema as $field => $schemas) {
			foreach ($schemas as $rule) {
				$method = 'validate'.$rule;
				$response = $this->{$method}($obj,$field);
				if($response === false) {
					throw new \UnexpectedValueException("Error {$field} {$method}", 1);
				}
			}
		}
		return true;
	}

 	/**
     * @param string $fieldName
     * @return array
     */
	public function getSchema($field = null) {
		if(is_null($field)) {
			return $this->schema;
		}
		return $this->schema[$field];
	}
}