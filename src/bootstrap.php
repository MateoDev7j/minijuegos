<?php
declare(strict_types=1);

if(session_status()===PHP_SESSION_NONE){
    session_start();
}

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/autoloader.php';
require_once BASE_PATH . '/config/config.php';
require_once BASE_PATH . '/src/Lib/helpers.php';

use Controllers\FrontController;
FrontController::main();
