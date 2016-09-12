<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
 */

namespace useless\web;

use useless\abstraction\{
    Application as AbstractApplication, Response as AbstractResponse
};
use useless\core\{
    ApplicationTrait, Dispatcher
};

class Application implements AbstractApplication
{
    use ApplicationTrait;

    public function run():AbstractResponse
    {
        try {
            /** @var Dispatcher $router */
            $router = $this->container()->get('service.route');

            $response = $router->dispatch($this->getRequest());
        } catch (\Exception $e) {
            $this->eraseOutput();
            $response = $this->getResponse()
                ->setHeaders([])
                ->setBody('Oops')
                ->setCode(500);
        }

        return $response->send();
    }

    protected function createResponse():AbstractResponse
    {
        return new Response();
    }

    protected function eraseOutput()
    {
        while (ob_get_level() > 0) {
            ob_end_clean();
        }
    }
}