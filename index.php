<?php

define("DS", DIRECTORY_SEPARATOR);
define("ROOT_DIR", realpath(dirname(__FILE__)) . DS);

require_once "autoload.php";

(new \App\Application)->run();