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
     * @var SuxxFileBackend
     */
    private $backend;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var string
     */
    private $picture;

    public function __construct(
        SuxxCommentTableDataGateway $dataGateway,
        SuxxRequest $request,
        SuxxSession $session,
        SuxxFileBackend $backend)
    {
        $this->request = $request;
        $this->session = $session;
        $this->dataGateway = $dataGateway;
        $this->backend = $backend;
        $this->comment = $request->getValue('comment');
        $this->picture = $this->request->getFile();
    }

    public function validateRequest()
    {
        if ($this->comment === '') {
            $this->session->setValue('error', 'Bitte geben Sie einen Kommentar ein!');
        }

        if ($this->picture !== '') {
            try {
                new SuxxFileUpload();
            } catch (\InvalidUploadedFileException $e) {
                $this->session->setValue('error', 'Das Bild ist ungültig - Dateiupload konnte nicht ausgeführt werden!');
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
            $this->session->setValue('message', 'Vielen Dank für Deinen Kommentar');
        } else {
            $this->session->setValue('error', 'Kommentar fehlgeschlagen!');
        }

        if ($this->picture) {
            $targetPath = __DIR__ . '/../../html/images/Comments/' . $cid . '_' . $this->picture;
            $originalPath = $this->request->getFilePath();
            $this->backend->moveUploadedFileTo($originalPath, $targetPath);
        }
    }

    public function hasErrors() : bool
    {
        if ($this->session->isset('error')) {
            return true;
        }
        return false;
    }
}

