<?php

namespace Suxx\Commands {

    use Suxx\Backends\FileBackend;
    use Suxx\Exceptions\InvalidUploadedFileException;
    use Suxx\Forms\FormError;
    use Suxx\Gateways\CommentTableDataGateway;
    use Suxx\Http\Request;
    use Suxx\Http\Session;
    use Suxx\ValueObjects\FileUpload;

    class CommentFormCommand extends AbstractFormCommand
    {
        /**
         * @var Request
         */
        private $request;

        /**
         * @var Session
         */
        private $session;

        /**
         * @var CommentTableDataGateway
         */
        private $dataGateway;

        /**
         * @var FileBackend
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
         * @var FormError
         */
        private $error;

        public function __construct(
            CommentTableDataGateway $dataGateway,
            Session $session,
            FileBackend $backend,
            FormError $error)
        {
            $this->session = $session;
            $this->dataGateway = $dataGateway;
            $this->backend = $backend;
            $this->error = $error;
        }

        public function execute(Request $request)
        {
            if ($this->session->isset('error')) {
                $this->session->deleteValue('error');
            }

            $this->request = $request;
            $this->comment = $request->getValue('comment');
            $this->picture = $request->getUploadedFile()->getFilename();

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
                    new FileUpload($this->request->getUploadedFile());
                } catch (InvalidUploadedFileException $e) {
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
                // Wieso keine Coverage für das? Das wäre doch noch wichtig das zu testen..
                //@codeCoverageIgnoreStart
                $targetPath = __DIR__ . '/../../html/images/Comments/' . $cid . '_' . $this->picture;
                $originalPath = $this->request->getUploadedFile()->getFilePath();
                $this->backend->moveUploadedFileTo($originalPath, $targetPath);
                //@codeCoverageIgnoreEnd
            }
        }

        protected function hasErrors() : bool
        {
            if ($this->session->isset('error')) {
                return true;
            }
            return false;
        }

        /**
         * @codeCoverageIgnore
         */
        protected function repopulateForm()
        {
        }
    }
}

