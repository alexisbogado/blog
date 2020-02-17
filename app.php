<?php

/**
 * @author Alexis Bogado
 * @package blog
 * @version 1.0.0
 */

/**
 * Configuration values array
 * 
 * @var array $_config
 */
$_config = null;

/**
 * Routes manager instace
 * 
 * @var Core\RoutesManager $routes
 */
$routes = null;

/**
 * Load all application components
 */
function load_app()
{
    global $routes, $_config;

    // Load all application components
    foreach (glob(__DIR__ . '/core/*.php') as $component)
        require_once $component;

    $_config = parse_ini_file(__DIR__ . '/config.ini');
    $routes = new Core\RoutesManager;

    // Load all application routes
    require_once __DIR__ . '/routes.php';

    // Load all application models and controllers
    foreach (glob(__DIR__ . '/{models,controllers}/*.php', GLOB_BRACE) as $component)
        require_once $component;
}

/**
 * Get configuration value
 * 
 * @param string $key
 * 
 * @return object
 */
function config($key)
{
   global $_config;

   return $_config[$key];
}

/**
 * Build view
 * 
 * @param string $view
 * @param array $params
 * 
 * @return Core\ViewManager
 */
function view($view, $params = [ ])
{
   return Core\ViewManager::make($view, $params);
}

/**
 * Get route by name or get current route
 *
 * @param string $name
 * 
 * @return Core\Route
 */
function route($name = null)
{
    global $routes;

    if (!$name) return $routes->route;
    return $routes->getRouteByName($name);
}

/**
 * Limit string
 *
 * @param string $text
 * @param int $max_length
 * 
 * @return string
 */
function str_limit($text, $max_length)
{
    if (strlen($text) <= $max_length)
        return $text;

    return substr($text, 0, $max_length) . '...';    
}

/**
 * Make a web request
 *
 * @param string $url
 * @param array $post_parameters
 * 
 * @return array
 */
function api_call($url, $post_parameters = null)
{
    $headers = [
        'Accept: application/json',
        'Content-type: application/json',
        'Cache-Control: no-cache',
        'Pragma: no-cache',
        'Authorization: Bearer ' . config('api.key')
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_TIMEOUT, 180);
    curl_setopt($ch, CURLOPT_ENCODING, '');

    if (!is_null($post_parameters)):
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_parameters));
    endif;

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $output = curl_exec($ch);

    curl_close($ch);

    return json_decode($output);
}

/**
 * Get sent post paramenters
 *
 * @param string $name
 * 
 * @return mixed
 */
function old($name)
{
    if (!isset($_POST)) return null;

    return ($_POST[$name] ?? null);
}
