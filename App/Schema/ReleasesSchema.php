<?php

namespace App\Schema;
use App\Schema\AbstractSchema;

class ReleasesSchema extends AbstractSchema {

	public function __construct() {
		$this->schema = array(
			'type' => array('Required','Empty','Unique'),
			'description' => array('Required','Empty'),
			'id' => array('Unique'),
			);
	}

	public function validateUnique($obj, $field) {
		return true;
	}

}