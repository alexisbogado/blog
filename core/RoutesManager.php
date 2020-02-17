<?php

/**
 * @author Alexis Bogado
 * @package blog
 * @version 1.0.0
 */

namespace Core;

class RoutesManager
{
    /**
     * Application routes variable
     *
     * @var Core\Route[]
     */
    private $routesList;

    /**
     * Current route
     *
     * @var Core\Route
     */
    public $route;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->routesList = [ ];
    }

    /**
     * Magic function to add route to the specific method
     *
     * @param string $function
     * @param array $arguments
     * 
     * @return mixed
     */
    public function __call($function, $arguments)
    {
        switch ($function):
            case 'get':
            case 'post':
            case 'delete':
            case 'put':
                // Add method to passed arguments
                array_splice($arguments, 1, 0, strtoupper($function));
                return $this->add(...$arguments);
            break;
        endswitch;
    }

    /**
     * Add route to list
     *
     * @param string $uri
     * @param string $method
     * @param object $invokable
     * 
     * @return Core\Route
     */
    public function add($uri, $method, $invokable)
    {
        if (!strstr($uri, '/'))
            $uri = "/{$uri}";

        $route = new Route($uri, $method, $invokable);
        $this->routesList[] = $route;
        return $route;
    }

    /**
     * Render the requested route
     *
     * @param string $method
     * @param string $uri
     * 
     * @return Core\View
     */
    public function render($method, $uri)
    {
        $this->parseUri($uri);
        
        $route = array_values(array_filter($this->routesList, function ($route) use ($method, $uri) {
            return $route->method == $method && $route->path == $uri;
        }))[0] ?? null;
        
        if (!$route) return "Cannot {$method} {$uri}";

        $this->route = $route;
        return $route->render();
    }

    /**
     * Get route by name
     *
     * @param string $name
     * 
     * @return Core\Route
     */
    public function getRouteByName($name)
    {
        return array_values(array_filter($this->routesList, function ($route) use ($name) {
            return $route->name == $name;
        }))[0] ?? null;
    }

    /**
     * Remove parameters from URI
     *
     * @param string $uri
     * 
     * @return string
     */
    public function parseUri(&$uri)
    {
        if (strpos($uri, '?') !== false):
            $uri_array = explode('?', $uri);
            $uri = $uri_array[0];
        endif;

        return $uri;
    }
}
