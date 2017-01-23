<?php

namespace Address\Controllers {

    use Address\Commands\UpdateTextFormCommand;
    use Address\Gateways\TextTableDataGateway;
    use Address\Http\Request;
    use Address\Http\Response;

    class UpdateTextController implements ControllerInterface
    {
        /**
         * @var TextTableDataGateway
         */
        private $textDataGateway;

        /**
         * @var UpdateTextFormCommand
         */
        private $updateTextFormCommand;

        public function __construct(UpdateTextFormCommand $updateTextFormCommand, TextTableDataGateway $textDataGateway)
        {
            $this->textDataGateway = $textDataGateway;
            $this->updateTextFormCommand = $updateTextFormCommand;
        }

        public function execute(Request $request, Response $response)
        {
            $result = $this->updateTextFormCommand->execute($request);

            if ($result === false) {
                $response->setText($this->textDataGateway->findTextById($request->getValue('id')));
                $this->updateTextFormCommand->repopulateForm();
                return 'texts/updatetext.twig';
            }

            $response->setTexts($this->textDataGateway->getAllTexts());
            $response->setRedirect('/text');
        }
    }
}
