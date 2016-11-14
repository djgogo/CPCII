<?php

class SuxxCommentFormCommand extends SuxxAbstractFormCommand
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

    /**
     * @var SuxxFormError
     */
    private $error;

    public function __construct(
        SuxxCommentTableDataGateway $dataGateway,
        SuxxSession $session,
        SuxxFileBackend $backend,
        SuxxFormError $error)
    {
        $this->session = $session;
        $this->dataGateway = $dataGateway;
        $this->backend = $backend;
        $this->error = $error;
    }

    public function execute(SuxxRequest $request)
    {
        if ($this->session->isset('error')) {
            $this->session->deleteValue('error');
        }

        $this->request = $request;
        $this->comment = $request->getValue('comment');
        $this->picture = $request->getFile();

        $this->validateRequest();
        if (!$this->hasErrors()) {
            $this->performAction();
            return true;
        }
        return false;
    }

    protected function validateRequest()
    {
        if ($this->comment === '') {
            $this->error->set('comment', 'Bitte geben Sie einen Kommentar ein!');
        }

        if ($this->picture !== '') {
            try {
                new SuxxFileUpload();
            } catch (\InvalidUploadedFileException $e) {
                $this->error->set('file', 'Das Bild ist ungültig - Dateiupload konnte nicht ausgeführt werden!');
            }
        }
    }

    protected function performAction()
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
            $this->session->setValue('warning', 'Kommentar fehlgeschlagen!');
        }

        if ($this->picture) {
            $targetPath = __DIR__ . '/../../html/images/Comments/' . $cid . '_' . $this->picture;
            $originalPath = $this->request->getFilePath();
            $this->backend->moveUploadedFileTo($originalPath, $targetPath);
        }
    }

    protected function hasErrors() : bool
    {
        if ($this->session->isset('error')) {
            return true;
        }
        return false;
    }

    protected function repopulateForm()
    {
    }
}

