<?php

namespace Address\Commands {

    use Address\Forms\FormError;
    use Address\Forms\FormPopulate;
    use Address\Gateways\TextTableDataGateway;
    use Address\Http\Session;
    use Address\Http\Request;

    class UpdateTextFormCommand extends AbstractFormCommand
    {
        /** @var Session */
        private $session;

        /** @var TextTableDataGateway */
        private $dataGateway;

        /** @var FormPopulate */
        private $populate;

        /** @var FormError */
        private $error;

        /** @var int */
        private $id;

        /** @var string */
        private $text1;

        /** @var string */
        private $text2;

        public function __construct(
            TextTableDataGateway $dataGateway,
            Session $session,
            FormPopulate $formPopulate,
            FormError $error)
        {
            $this->dataGateway = $dataGateway;
            $this->session = $session;
            $this->populate = $formPopulate;
            $this->error = $error;
        }

        public function execute(Request $request)
        {
            if ($this->session->isset('error')) {
                $this->session->deleteValue('error');
            }

            $this->id = $request->getValue('id');
            $this->text1 = $request->getValue('text1');
            $this->text2 = $request->getValue('text2');

            $this->validateRequest();
            if (!$this->hasErrors()) {
                $this->performAction();
                return true;
            }
            return false;
        }

        public function validateRequest()
        {
            if ($this->text1 === '') {
                $this->error->set('text1', 'Bitte geben Sie einen Text ein.');
            }

            if (strlen($this->text1) > 1024 ) {
                $this->error->set('text1', 'Die Textlänge darf maximal 1024 Zeichen beinhalten.');
            }

            if ($this->text2 === '') {
                $this->error->set('text2', 'Bitte geben Sie eine Text ein.');
            }

            if (strlen($this->text2) > 1024 ) {
                $this->error->set('text2', 'Die Textlänge darf maximal 1024 Zeichen beinhalten.');
            }
        }

        public function performAction()
        {
            $row = [
                'id' => $this->id,
                'text1' => $this->text1,
                'text2' => $this->text2,
                'updated' => date("Y-m-d H:i:s")
            ];

            if ($this->dataGateway->update($row)) {
                $this->session->setValue('message', 'Datensatz wurde geändert');
            } else {
                $this->session->setValue('warning', 'Aenderung fehlgeschlagen!');
            }
        }

        public function hasErrors() : bool
        {
            if ($this->session->isset('error')) {
                return true;
            }
            return false;
        }

        public function repopulateForm()
        {
            if ($this->text1 !== '') {
                $this->populate->set('text1', $this->text1);
            }

            if ($this->text2 !== '') {
                $this->populate->set('text2', $this->text2);
            }
        }
    }
}

