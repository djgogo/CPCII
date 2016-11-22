<?php

namespace Suxx\Commands {

    use Suxx\Forms\FormError;
    use Suxx\Forms\FormPopulate;
    use Suxx\Gateways\ProductTableDataGateway;
    use Suxx\Http\Session;
    use Suxx\Http\Request;

    class UpdateProductFormCommand extends AbstractFormCommand
    {
        /**
         * @var Session
         */
        private $session;

        /**
         * @var ProductTableDataGateway
         */
        private $dataGateway;

        /**
         * @var FormPopulate
         */
        private $populate;

        /**
         * @var FormError
         */
        private $error;

        /**
         * @var int
         */
        private $pid;

        /**
         * @var string
         */
        private $label;

        /**
         * @var string
         */
        private $price;

        public function __construct(
            ProductTableDataGateway $dataGateway,
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

            $this->pid = $request->getValue('product-id');
            $this->label = $request->getValue('label');
            $this->price = $request->getValue('price');

            $this->validateRequest();
            if (!$this->hasErrors()) {
                $this->performAction();
                return true;
            }
            return false;
        }

        public function validateRequest()
        {
            if ($this->label === '') {
                $this->error->set('label', 'Bitte geben Sie einen Label-Text ein!');
            }

            if ($this->price === '') {
                $this->error->set('price', 'Bitte geben Sie einen Preis ein!');
            }
        }

        public function performAction()
        {
            $row = [
                'pid' => $this->pid,
                'label' => $this->label,
                'price' => $this->price
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
            if ($this->label !== '') {
                $this->populate->set('label', $this->label);
            }

            if ($this->price !== '') {
                $this->populate->set('price', $this->price);
            }
        }
    }
}

