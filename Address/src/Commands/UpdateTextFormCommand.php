<?php

namespace Address\Commands
{

    use Address\Forms\FormError;
    use Address\Forms\FormPopulate;
    use Address\Gateways\TextTableDataGateway;
    use Address\Http\Session;
    use Address\Http\Request;
    use Address\ValueObjects\Id;

    class UpdateTextFormCommand extends AbstractFormCommand
    {
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
            Session $session,
            TextTableDataGateway $dataGateway,
            FormPopulate $formPopulate,
            FormError $error)
        {
            parent::__construct($session);

            $this->dataGateway = $dataGateway;
            $this->populate = $formPopulate;
            $this->error = $error;
        }

        protected function setFormValues(Request $request)
        {
            $this->id = $request->getValue('id');
            $this->text1 = $request->getValue('text1');
            $this->text2 = $request->getValue('text2');
        }

        protected function validateRequest()
        {
            try {
                new Id($this->id);
            } catch (\InvalidArgumentException $e) {
                $this->error->set('postalCode', 'Die Address-Id ist ungültig.');
            }

            if ($this->text1 === '') {
                $this->error->set('text1', 'Bitte geben Sie einen Text ein.');
            }

            if (strlen($this->text1) > 1024 ) {
                $this->error->set('text1', 'Der Text darf maximal 1024 Zeichen lang sein.');
            }

            if ($this->text2 === '') {
                $this->error->set('text2', 'Bitte geben Sie einen Text ein.');
            }

            if (strlen($this->text2) > 1024 ) {
                $this->error->set('text2', 'Der Text darf maximal 1024 Zeichen lang sein.');
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
                $this->getSession()->setValue('message', 'Datensatz wurde geändert');
            } else {
                $this->getSession()->setValue('warning', 'Aenderung fehlgeschlagen!');
            }
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
