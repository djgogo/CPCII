<?php
declare(strict_types=1);

class Application
{
    private $factory;
    private $session;
    
    public function __construct(Factory $factory, Session $session)
    {
        $this->factory = $factory;
        $this->session = $session;
    }

    public function run(Request $request, Response $response, $send = true)
    {
        $routerChain = $this->selectRouterChain($request);

        $result = $routerChain->route($request, $this->session)->execute();

        if ($result instanceof Redirect) {
            // $response->setStatus(302);
            $response->addHeader('Location: ' . $result->getTarget());
            $response->setBody('You will be redirected to ' . $result->getTarget() . PHP_EOL);
        }

        if ($send) {
            $response->send();
        }
    }

    private function selectRouterChain(Request $request)
    {
        if ($request->isGetRequest()) {
            return $this->factory->createGetRequestRouterChain();
        } else {
            return $this->factory->createPostRequestRouterChain();
        }
    }
}
