<?php

namespace Address\Commands
{

    use Address\Forms\FormError;
    use Address\Forms\FormPopulate;
    use Address\Gateways\AddressTableDataGateway;
    use Address\Http\Session;
    use Address\Http\Request;
    use Address\ValueObjects\Zip;

    class UpdateAddressFormCommand extends AbstractFormCommand
    {
        /** @var Session */
        private $session;

        /** @var AddressTableDataGateway */
        private $dataGateway;

        /** @var FormPopulate */
        private $populate;

        /** @var FormError */
        private $error;

        /** @var int */
        private $id;

        /** @var string */
        private $address1;

        /** @var string */
        private $address2;

        /** @var string */
        private $city;

        /** @var int */
        private $postalCode;

        public function __construct(
            AddressTableDataGateway $dataGateway,
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
            $this->address1 = $request->getValue('address1');
            $this->address2 = $request->getValue('address2');
            $this->city = $request->getValue('city');
            $this->postalCode = $request->getValue('postalCode');

            $this->validateRequest();
            if (!$this->hasErrors()) {
                $this->performAction();
                return true;
            }
            return false;
        }

        public function validateRequest()
        {
            if ($this->address1 === '') {
                $this->error->set('address1', 'Bitte geben Sie einen Namen ein.');
            }

            if ($this->address2 === '') {
                $this->error->set('address2', 'Bitte geben Sie eine Addresse ein.');
            }

            if ($this->city === '') {
                $this->error->set('city', 'Bitte geben Sie einen Wohnort ein.');
            }

            try {
                new Zip($this->postalCode);
            } catch (\InvalidArgumentException $e) {
                $this->error->set('postalCode', 'Bitte geben Sie eine gültige Postleitzahl ein.');
            }
        }

        public function performAction()
        {
            $row = [
                'id' => $this->id,
                'address1' => $this->address1,
                'address2' => $this->address2,
                'city' => $this->city,
                'postalCode' => $this->postalCode,
                'updated' => date("Y-m-d H:i:s")
            ];

            if ($this->dataGateway->update($row)) {
                $this->session->setValue('message', 'Datensatz wurde geändert');
            } else {
                $this->session->setValue('warning', 'Aenderung fehlgeschlagen!');
            }
        }

        public function hasErrors(): bool
        {
            if ($this->session->isset('error')) {
                return true;
            }
            return false;
        }

        public function repopulateForm()
        {
            if ($this->address1 !== '') {
                $this->populate->set('address1', $this->address1);
            }

            if ($this->address2 !== '') {
                $this->populate->set('address2', $this->address2);
            }

            if ($this->city !== '') {
                $this->populate->set('city', $this->city);
            }

            if ($this->postalCode !== '') {
                $this->populate->set('postalCode', $this->postalCode);
            }
        }
    }
}
