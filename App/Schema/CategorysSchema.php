<?php

namespace App\Schema;
use App\Schema\AbstractSchema;

class CategorysSchema extends AbstractSchema {

	public function __construct() {
		$this->schema = array(
			'name' => array('Required','Empty','Unique'),
			'id' => array('Unique'),
			);
	}

	public function validateUnique($obj, $field) {
		return true;
	}

}