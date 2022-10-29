<?php

use App\Helpers\Router;

// Load Config
require_once 'config/config.php';
// Load autoload
require_once 'vendor/autoload.php';

// Routes
require_once 'routes/web.php';

$router = new Router();
$router($routes);