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
        SuxxSession $session)
    {
        $this->request = $request;
        $this->response = $response;
        $this->session = $session;
        $this->dataGateway = $dataGateway;
        $this->label = $request->getValue('label');
        $this->price = $request->getValue('price');
    }

    public function validateRequest()
    {
        if ($this->label === '') {
            $this->session->setValue('error', 'Bitte geben Sie einen Label-Text ein!');
        }

        if ($this->price === '') {
            $this->session->setValue('error', 'Bitte geben Sie einen Preis ein!');
        }
    }

    public function performAction()
    {
        $row = [
            'pid' => $this->request->getValue('product'),
            'label' => $this->label,
            'price' => $this->price
        ];

        if ($this->dataGateway->update($row)) {
            $this->session->setValue('message', 'Datensatz wurde geändert');
        } else {
            $this->session->setValue('error', 'Aenderung fehlgeschlagen!');
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
        // TODO !!! i have to put a new value into object product which is in the request object!!!!
        //  TODO --> create a normal class instead of stdclass and do an getter and setter of the attributes!!
        if ($this->label !== '') {
            $this->response->product->label = $this->label;
        }

        if ($this->price !== '') {
            $this->response->product->price = $this->price;
        }
    }
}

