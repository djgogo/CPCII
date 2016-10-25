<?php

class SuxxCommentFormCommand
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
     * @var SuxxCommentTableDataGateway
     */
    private $dataGateway;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var string
     */
    private $picture;

    public function __construct(SuxxCommentTableDataGateway $dataGateway, SuxxRequest $request, SuxxSession $session)
    {
        $this->request = $request;
        $this->session = $session;
        $this->comment = $request->getValue('comment');
        $this->dataGateway = $dataGateway;

        unset($_SESSION['message']);
        $this->picture = isset($_FILES['picture']) ? $_FILES['picture']['name'] : '';
    }

    public function validateRequest()
    {
        if ($this->comment === '') {
            $_SESSION['message'] = 'Bitte geben Sie einen Kommentar ein!';
        }

        if ($this->picture !== '') {
            try {
                new SuxxFileUpload();
            } catch (\InvalidUploadedFileException $e) {
                $_SESSION['message'] = 'Das Bild ist ungültig - Dateiupload konnte nicht ausgeführt werden!';
            }
        }
    }

    public function performAction()
    {
        $row = [
            'pid' => $this->request->getValue('product'),
            'author' => $this->session->getValue('user'),
            'comment' => $this->comment,
            'picture' => $this->picture
        ];

        $cid = $this->dataGateway->insert($row);

        if ($cid !== '') {
            $_SESSION['message'] = 'Vielen Dank für Deinen Kommentar';
        } else {
            $_SESSION['message'] = 'Kommentar fehlgeschlagen!';
        }

        if ($this->picture) {
            $path = __DIR__ . '/../../html/Images/Comments/' . $cid . '_' . $this->picture;
            move_uploaded_file($_FILES['picture']['tmp_name'], $path);
        }
    }

    public function hasErrors() : bool
    {
        if ($_SESSION['message'] !== null) {
            return true;
        }
        return false;
    }
}

