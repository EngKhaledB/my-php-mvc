<?php

/*
 * Constants
 */
define('ABSPATH', __DIR__);
define('VIEWPATH', __DIR__ . '/Views/');

/*
 * Required Files
 */
require_once('autoload.php');
require_once('config.php');


/*
 * Getting the route
 */
$router = new \Base\Router();

/*
 * New App Instance
 */
$app = new \Base\App();

/*
 * Run App
 */
$app->run($router);
