<?php

class SuxxFileUpload
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

    public function __construct()
    {
        $this->ensureValidImage();
        $this->ensureValidSize();
        $this->ensureAllowedMimeType();
    }

    private function ensureValidImage()
    {
        $result = getimagesize($_FILES['picture']['tmp_name']);

        if ($result === false) {
            throw new \InvalidUploadedFileException('Die übergebene Datei ist ungültig!');
        }
    }

    private function ensureValidSize()
    {
        if ($_FILES['picture']['size'] > 500000) {
            throw new \InvalidUploadedFileException('Die übergebene Datei ist zu gross!');
        }
    }

    private function ensureAllowedMimeType()
    {
        $result = getimagesize($_FILES['picture']['tmp_name']);

        if (!in_array($result['mime'], $this->allowedMimeTypes)) {
            throw new \InvalidUploadedFileException('Der übergebene Dateityp ist ungültig!');
        }
    }
}
