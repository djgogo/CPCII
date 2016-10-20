<?php

class SuxxCommentFormCommand
{
    /**
     * @var SuxxRequest
     */
    private $request;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var SuxxCommentTableDataGateway
     */
    private $dataGateway;

    public function __construct(SuxxCommentTableDataGateway $dataGateway, SuxxRequest $request)
    {
        $this->request = $request;
        $this->comment = $request->getValue('comment');
        $this->dataGateway = $dataGateway;
    }

    public function validateRequest()
    {
        if ($this->comment === '') {
            $this->request->setParams(['message' => 'Bitte geben Sie einen Kommentar ein']);
        }
    }

    public function performAction()
    {
        $picture = isset($_FILES['picture']) ? $_FILES['picture']['name'] : '';

        $row = [
            'pid' => $this->request->getValue('product'),
            'author' => $this->request->getValue('user'),
            'comment' => $this->comment,
            'picture' => $picture
        ];

        $cid = $this->dataGateway->insert($row);

        if ($cid !== '') {
            $this->request->setParams(['message' => 'Vielen Dank für Deinen Kommentar']);
        } else {
            $this->request->setParams(['message' => 'Kommentar fehlgeschlagen!']);
        }

        if ($picture) {
            $path = __DIR__ . '/../Images/Comments/' . $cid . '_' . $picture;
            move_uploaded_file($_FILES['picture']['tmp_name'], $path);
        }
    }

    public function hasErrors() : bool
    {
        if ($this->request->params !== null) {
            return true;
        }
        return false;
    }
}

