<?php

class SuxxUpdateProductFormCommand
{
    /**
     * @var SuxxRequest
     */
    private $request;

    /**
     * @var SuxxResponse
     */
    private $response;

    /**
     * @var SuxxSession
     */
    private $session;

    /**
     * @var SuxxProductTableDataGateway
     */
    private $dataGateway;

    /**
     * @var array
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
        SuxxRequest $request,
        SuxxResponse $response,
        SuxxSession $session,
        array $error)
    {
        $this->request = $request;
        $this->response = $response;
        $this->session = $session;
        $this->dataGateway = $dataGateway;
        $this->error = $error;

        $this->label = $request->getValue('label');
        $this->price = $request->getValue('price');
    }

    public function validateRequest()
    {
        if ($this->label === '') {
            $this->error['label'] = 'Bitte geben Sie einen Label-Text ein!';
            $this->session->setValue('error', $this->error);
        }

        if ($this->price === '') {
            $this->error['price'] = 'Bitte geben Sie einen Preis ein!';
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

