<?php

namespace Address\Controllers
{

    use Address\Gateways\TextTableDataGateway;
    use Address\Http\Request;
    use Address\Http\Response;
    use Address\Http\Session;

    class TextController implements ControllerInterface
    {
        /** @var Session */
        private $session;

        /** @var TextTableDataGateway */
        private $dataGateway;

        public function __construct(Session $session, TextTableDataGateway $dataGateway)
        {
            $this->session = $session;
            $this->dataGateway = $dataGateway;
        }

        public function execute(Request $request, Response $response): string
        {
            if ($request->hasValue('sort')) {
                if ($request->getValue('sort') === 'ASC') {
                    $response->setTexts(...$this->dataGateway->getAllTextsOrderedByUpdated('ASC'));
                } elseif ($request->getValue('sort') === 'DESC') {
                    $response->setTexts(...$this->dataGateway->getAllTextsOrderedByUpdated('DESC'));
                }
            } else {
                $response->setTexts(...$this->dataGateway->getAllTexts());
            }

            if ($request->hasValue('searchText')) {
                $response->setTexts(...$this->dataGateway->getSearchedText($request->getValue('searchText')));
            }

            return 'text.twig';
        }
    }
}
