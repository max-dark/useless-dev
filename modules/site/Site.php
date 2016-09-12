<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license MIT; see LICENSE.txt
 */

namespace useless\modules\site;

use useless\abstraction\{
    Action, Application, Registry, Response
};
use useless\core\ActionTrait;
use useless\themes\bootstrap\{
    ErrorPage, IndexPage
};

class Site implements Action
{
    use ActionTrait;

    /**
     * Action constructor.
     *
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->application($application);
        $this->container()->set('service.site.config', function (Registry $container) {
            return new ConfigRegistry(
                $container->get('service.storage.default')
            );
        });
    }

    /**
     * @return Response
     */
    public function index()
    {
        $view = new IndexPage();
        $body = $view->render([
            'title' => $this->container()->get('config.site.title'),
            'message' => 'Here content',
            'slider' => true
        ]);

        return $this
            ->response()
            ->setBody($body);
    }

    public function error404()
    {
        $view = new ErrorPage();
        $body = $view->render([
            'title' => $this->container()->get('config.site.title'),
            'message' => 'Here content'
        ]);

        return $this
            ->response()
            ->setBody($body)
            ->setCode(404);
    }
}