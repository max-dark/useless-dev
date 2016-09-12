<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
 */

namespace useless\core;

use useless\abstraction\{
    Application, Registry, Request, Response
};

/**
 * Class Router
 *
 * @package useless\core
 */
class SimpleRouter implements Dispatcher
{
    /**
     * @var array
     */
    private $routes = [];

    /**
     * @var Application
     */
    private $application;

    /**
     * Router constructor.
     *
     * @param Application $application
     * @param array       $routes
     */
    public function __construct(Application $application, array $routes)
    {
        $this->application = $application;
        $this->routes      = $routes;
    }

    /**
     * Dispatches request to action
     *
     * @param Request $request
     *
     * @return Response
     */
    public function dispatch(Request $request):Response
    {
        $matched = false;
        $method  = strtolower($request->method());
        $path    = "{$method}:{$request->path()}";
        foreach ($this->routes as $currentPath => $currentAction) {
            if ($currentPath !== $path) {
                continue;
            }
            $matched     = true;
            $actionClass = $currentAction['class'];
            $methodName  = $currentAction['action'];
            $paramList   = $this->checkParams($request, $currentAction['params']);
            if (false !== $paramList) {
                return $this->fireAction($actionClass, $methodName, $paramList);
            }
        }
        if (isset($this->routes['*'])) {
            $currentAction = $this->routes['*'];
            $actionClass   = $currentAction['class'];
            $methodName    = $currentAction['action'];

            return $this->fireAction($actionClass, $methodName, [$path]);
        }

        $body = $matched ? 'Missing required parameters' : 'Requested method does not exist.';
        $error_page = $this->container()->get('config.site.error_page') ?: '/';
        return $this->application->getResponse()
                                 ->setCode(301)
                                 ->redirect($error_page)
                                 ->setBody($body);
    }

    /**
     * Extract requested params
     *
     * @param Request  $request HTTP method in lower case
     * @param string[] $names   array of param names
     *
     * @return array|bool false if not all params found
     */
    private function checkParams(Request $request, array $names)
    {
        $params = [];
        foreach ($names as $name) {
            if (!$request->has($name)) {
                return false;
            }
            $params[$name] = $request->get($name);
        }

        return $params;
    }

    /**
     * @param string $actionClass
     * @param string $methodName
     * @param array  $paramList
     *
     * @return Response
     */
    protected function fireAction(string $actionClass, string $methodName, array $paramList):Response
    {
        $controller = new $actionClass($this->application);

        return $controller->$methodName(...$paramList);
    }

    /**
     * @return Registry
     */
    protected function container():Registry
    {
        return $this->application->container();
    }
}
