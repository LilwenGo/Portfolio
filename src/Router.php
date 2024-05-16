<?php
namespace Portfolio;

//use App\Controllers\UserController;
/** 
 * Class Router get the url and call the corresponding method
 */

class Router {
    /**
     * Called Url
     */
    private string $url;
    /**
     * Routes list
     */
    private array $routes = [];

    /**
     * Store the url and prepare for redirection
     */
    public function __construct(string $url){
        $this->url = $url;
    }

    /**
     * Store the route of method GET
     * @param string $path The route (/login/) with param (/user/:id/show/)
     * @param string $callable The controllers method (ControllerName@methodName)
     */
    public function get(string $path, string $callable): Route {
        $route = new Route($path, $callable);
        $this->routes["GET"][] = $route;
        return $route;
    }

    /**
     * Store the route od method POST
     * @param string $path The route (/login/) with param (/user/:id/show/)
     * @param string $callable The controllers method (ControllerName@methodName)
     */
    public function post(string $path, string $callable): Route {
        $route = new Route($path, $callable);
        $this->routes["POST"][] = $route;
        return $route;
    }

    /**
     * Read through the routes and search a match
     */
    public function run() {
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            throw new \Exception('REQUEST_METHOD does not exist');
        }
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
            if($route->match($this->url)){
                return $route->call();
            }
        }
        // throw new \Exception('No matching routes');
        require VIEWS . '404.php';
    }

}
