<?php

// Load Config
use App\Helpers\Router;

require_once '../config/config.php';

// Load autoload
require_once '../vendor/autoload.php';

// Routes
require_once '../routes/web.php';

$router = new Router();
$router($routes);