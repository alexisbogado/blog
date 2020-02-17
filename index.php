<?php

/**
 * @author Alexis Bogado
 * @package blog
 * @version 1.0.0
 */

require_once __DIR__ . '/app.php';

load_app();

echo $routes->render($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
