<?php

/**
 * @author Alexis Bogado
 * @package blog
 * @version 1.0.0
 */

namespace Core;

use \stdClass;

class Route
{
    /**
     * Route URI
     *
     * @var string
     */
    public $path;

    /**
     * Route method
     *
     * @var string
     */
    public $method;

    /**
     * Invokable object to show when route is called
     *
     * @var object
     */
    public $invokable;

    /**
     * Route name
     *
     * @var string
     */
    public $name;

    /**
     * Class constructor
     *
     * @param string $path
     * @param string $method
     * @param object $invokable
     */
    public function __construct($path, $method, $invokable)
    {
        $this->path = $path;
        $this->method = $method;
        $this->invokable = $invokable;
    }

    /**
     * Add name to route
     *
     * @param string $name
     * 
     * @return void
     */
    public function name($name)
    {
        $this->name = $name;
    }

    /**
     * Get route path
     *
     * @return string
     */
    public function path()
    {
        return config('site.url') . $this->path;
    }

    /**
     * Render route
     *
     * @return object
     */
    public function render()
    {
        $controller_array = explode('@', $this->invokable);
        $controller_name = "\\Controllers\\{$controller_array[0]}";
        $function = $controller_array[1];

        $controller = new $controller_name;
        return $controller->{$function}($this->requestParameters());
    }

    /**
     * Get HTTP parameters
     * 
     * @return \stdClass
     */
    public function requestParameters()
    {
        $request = new stdClass;

        switch (strtoupper($this->method)):
            case 'POST':
                $parameters = json_decode(file_get_contents('php://input'), true);
                if (is_array($parameters)) $_POST = array_merge($parameters, $_POST);

                $request->input = json_decode(json_encode($_POST));
                $request->files = $_FILES;
                $request->query = json_decode(json_encode($_GET));
            break;

            case 'GET':
                $request->input = json_decode(json_encode($_GET));
            break;

            case 'DELETE':
            case 'PUT':
                parse_str(file_get_contents('php://input'), $parameters);
                $request->input = json_decode(json_encode($parameters));
                $request->query = json_decode(json_encode($_GET));
            break;
        endswitch;

        return $request;
    }
}
