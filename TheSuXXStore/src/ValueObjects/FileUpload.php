<?php

namespace Suxx\ValueObjects
{

    use Suxx\Exceptions\InvalidUploadedFileException;
    use Suxx\FileHandlers\UploadedFile;

    class FileUpload
    {
        /**
         * @var array
         */
        private $allowedMimeTypes = [
            'image/jpeg',
            'image/jpg',
            'image/png',
            'image/gif'
        ];

        /**
         * @var UploadedFile
         */
        private $file;

        public function __construct(UploadedFile $file)
        {
            $this->file = $file;

            $this->ensureValidImage();
            $this->ensureValidSize();
            $this->ensureAllowedMimeType();
        }

        private function ensureValidImage()
        {
            $result = $this->file->getImageSize();

            if ($result === false) {
                throw new InvalidUploadedFileException('Die übergebene Datei ist ungültig!');
            }
        }

        private function ensureValidSize()
        {
            if ($this->file->getSize() > 500000) {
                throw new InvalidUploadedFileException('Die übergebene Datei ist zu gross!');
            }
        }

        private function ensureAllowedMimeType()
        {
            $mimeType = $this->file->getMimeType();

            if (!in_array($mimeType, $this->allowedMimeTypes)) {
                throw new InvalidUploadedFileException('Der übergebene Dateityp ist ungültig!');
            }
        }
    }
}
