<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
 */

namespace useless\modules\site;

use useless\abstraction\{
    Action, Application, Registry, Response
};
use useless\core\ActionTrait;
use useless\modules\template\Page;
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
            return new ConfigRegistry($container->get('service.storage.default'));
        });
    }

    /**
     * @return Response
     */
    public function index()
    {
        return $this->render(new IndexPage(), [
            'title'   => $this->container()->get('config.site.title'),
            'message' => 'Here content',
            'slider'  => true
        ]);
    }

    public function error404()
    {
        return $this->render(new ErrorPage(), [
            'title'   => $this->container()->get('config.site.title'),
            'message' => 'Here content'
        ])->setCode(404);
    }

    /**
     * @param Page  $page
     * @param array $values
     *
     * @return Response
     */
    protected function render(Page $page, array $values):Response
    {
        $body = $page->render($values);

        return $this->response()->setBody($body);
    }
}