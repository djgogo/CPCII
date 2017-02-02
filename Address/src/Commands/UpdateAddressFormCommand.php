<?php

namespace Address\Commands
{

    use Address\Exceptions\AddressTableGatewayException;
    use Address\Forms\FormError;
    use Address\Forms\FormPopulate;
    use Address\Gateways\AddressTableDataGateway;
    use Address\Http\Session;
    use Address\Http\Request;
    use Address\ParameterObjects\AddressParameterObject;
    use Address\ValueObjects\Id;
    use Address\ValueObjects\Zip;

    class UpdateAddressFormCommand extends AbstractFormCommand
    {
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

        /** @var \DateTime */
        private $dateTime;

        public function __construct(
            Session $session,
            AddressTableDataGateway $dataGateway,
            FormPopulate $formPopulate,
            FormError $error,
            \DateTime $dateTime)
        {
            parent::__construct($session);

            $this->dataGateway = $dataGateway;
            $this->populate = $formPopulate;
            $this->error = $error;
            $this->dateTime = $dateTime;
        }

        protected function setFormValues(Request $request)
        {
            $this->id = $request->getValue('id');
            $this->address1 = $request->getValue('address1');
            $this->address2 = $request->getValue('address2');
            $this->city = $request->getValue('city');
            $this->postalCode = $request->getValue('postalCode');
        }

        protected function validateRequest()
        {
            try {
                new Id($this->id);
            } catch (\InvalidArgumentException $e) {
            $this->error->set('postalCode', 'Die Address-Id ist ungültig.');
            }

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

        protected function performAction()
        {
            $address = new AddressParameterObject(
                $this->id,
                $this->address1,
                $this->address2,
                $this->city,
                $this->postalCode,
                $this->dateTime->format('Y-m-d H:i:s')
            );

            try {
                $this->dataGateway->update($address);
                $this->getSession()->setValue('message', 'Datensatz wurde geändert');
            } catch (AddressTableGatewayException $e) {
                $this->getSession()->setValue('warning', 'Aenderung fehlgeschlagen!');
            }
        }

        protected function repopulateForm()
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
