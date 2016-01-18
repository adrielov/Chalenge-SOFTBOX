<?php
namespace App\Lib;

use App\Application;
use App\Router;
use App\Helpers\Request;
use App\Helpers\Utils;

class View extends Controller {
	private $view;
	private $file;
	
	public function __construct($view) {
		$this->view = str_replace(".",DS,$view);
		$this->file = ROOT_DIR."App".DS."Views".DS.$this->view.".php";
		$this->render();
	}

	public function Request($key) {
		return Request::get($key);
	}

	public function formartNumber($value) {
		return Utils::formatNumber($value);
	}
	
	private function render() {
		require_once(ROOT_DIR."App".DS."Layout".DS."Header.php");
		if(file_exists($this->file)) {
			require_once($this->file);
		} else {
			echo "A view {$this->view} não existe";
		}
		require_once(ROOT_DIR."App".DS."Layout".DS."Footer.php");
	}

	public function get($key) {
		return Application::get($key);
	}

	public function checkRouter($route) {
		return Router::checkRoute($route);
	}

	public function setActive($route) {
		return ($this->checkRouter($route)) ? "active" : "" ;
	}

	public function getRouter() {
		$route  = $_SERVER['REQUEST_URI'];
		return current(str_word_count($route,2));
	}

	public function breadCrumb() {
		Utils::generateBreadCrumb();
	}

	public function textLimit($text) {
		return Utils::textLimit($text,40);
	}
}