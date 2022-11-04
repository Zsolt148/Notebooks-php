<?php

use App\Helpers\Router;

// Load autoload
require __DIR__ . '/../vendor/autoload.php';

// Load Config
require_once __DIR__ . '/../config/config.php';

// Routes
require_once __DIR__ . '/../routes/web.php';

session_start();

$router = new Router();
$router($routes);