<?php
namespace Portfolio;

/**
 * Class Route store the paths given and call the Controller's method
 */
class Route {

    /**
     * Route to match
     */
    private string $path;
    /**
     * Controller's method to call (ControllerName@methodName)
     */
    private string $callable;
    /**
     * Params list in the url
     */
    private array $matches = [];

    /**
     * Store the path and the callable
     */
    public function __construct(string $path, string $callable){
        $this->path = trim($path, '/');
        $this->callable = $callable;
    }

    /**
     * Returns a boolean if the given url matches with the route
     */
    public function match(string $url): bool{
        $url = trim($url, '/');
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $regex = "#^$path$#i";
        if(!preg_match($regex, $url, $matches)){
            return false;
        }
        array_shift($matches);
        $this->matches = $matches;
        return true;
    }

    /**
     * Call the controller's method with the params
     */
    public function call() {
         $rep = explode("@", $this->callable);
         $controller = "Portfolio\\Controllers\\".$rep[0];
         $controller = new $controller();

        return call_user_func_array([$controller, $rep[1]], $this->matches);
    }

}
