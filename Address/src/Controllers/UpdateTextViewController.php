<?php

namespace Address\Controllers
{

    use Address\Exceptions\TextTableGatewayException;
    use Address\Forms\FormPopulate;
    use Address\Gateways\TextTableDataGateway;
    use Address\Http\Request;
    use Address\Http\Response;
    use Address\Http\Session;

    class UpdateTextViewController implements ControllerInterface
    {
        /** @var TextTableDataGateway */
        private $textDataGateway;

        /** @var Session */
        private $session;

        /** @var FormPopulate */
        private $populate;

        public function __construct(Session $session, TextTableDataGateway $textDataGateway, FormPopulate $formPopulate)
        {
            $this->textDataGateway = $textDataGateway;
            $this->session = $session;
            $this->populate = $formPopulate;
        }

        public function execute(Request $request, Response $response): string
        {
            if ($request->hasValue('id') && $request->getValue('id') === '') {
                return 'templates/errors/404.twig';
            }

            try {
                $response->setText($this->textDataGateway->findTextById($request->getValue('id')));
            } catch (TextTableGatewayException $e) {
                return 'templates/errors/500.twig';
            }

            $this->populate->set('text1', $response->getText()->getText1());
            $this->populate->set('text2', $response->getText()->getText2());

            if ($this->session->isset('error')) {
                $this->session->deleteValue('error');
            }

            return 'texts/updatetext.twig';
        }

    }
}
