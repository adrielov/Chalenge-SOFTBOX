<?php
namespace App\Lib;
use App\Application;
use App\Helpers\Request;

class Controller {

	protected $update;

	public function __construct() {
		$this->update = (object) array();
	}

	public function set($key,$value) {
		return Application::set($key,$value);
	}

	public function redirect($url) {
		$url = str_replace(".",DS,$url);
		header('location: /'.$url);
	}
}