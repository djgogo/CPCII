<?php

class SuxxUpdateProductFormCommand extends SuxxAbstractFormCommand
{
    /**
     * @var SuxxRequest
     */
    private $request;

    /**
     * @var SuxxSession
     */
    private $session;

    /**
     * @var SuxxProductTableDataGateway
     */
    private $dataGateway;

    /**
     * @var SuxxFormError
     */
    private $error;

    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     */
    private $price;

    public function __construct(
        SuxxProductTableDataGateway $dataGateway,
        SuxxSession $session,
        SuxxFormError $error)
    {
        $this->dataGateway = $dataGateway;
        $this->session = $session;
        $this->error = $error;
    }

    public function execute(SuxxRequest $request)
    {
        $this->session->deleteValue('error');

        $this->request = $request;
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
            $this->session->setValue('error', $this->error);
        }

        if ($this->price === '') {
            $this->error->set('price', 'Bitte geben Sie einen Preis ein!');
            $this->session->setValue('error', $this->error);
        }
    }

    public function performAction()
    {
        $row = [
            'pid' => $this->request->getValue('product-id'),
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
            $this->session->setValue('updateproduct_label', $this->label);
        }

        if ($this->price !== '') {
            $this->session->setValue('updateproduct_price', $this->price);
        }
    }
}

