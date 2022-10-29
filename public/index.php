<?php

use App\Helpers\Router;

// Load autoload
require_once 'vendor/autoload.php';

// Load Config
require_once 'config/config.php';

// Routes
require_once 'routes/web.php';

$router = new Router();
$router($routes);