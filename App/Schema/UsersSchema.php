<?php

namespace App\Schema;
use App\Schema\AbstractSchema;

class UsersSchema extends AbstractSchema {

	public function __construct() {
		$this->schema = array(
			'name' => array('Required','Empty','Unique'),
			'email' => array('Required','Empty'),
			'id' => array('Unique'),
			);
	}

	public function validateUnique($obj, $field) {
		return true;
	}

}