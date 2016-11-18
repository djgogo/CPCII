<?php

class SuxxUploadedFile
{
    /**
     * @var array
     */
    private $files;

    public function __construct(array $files)
    {
        $this->files = $files;
    }

    public function hasFile($key) : bool
    {
        return isset($this->files[$key]);
    }

    public function getFilename() : string
    {
        if ($this->hasFile('picture')) {
            return $this->files['picture']['name'];
        }

        return '';
    }

    public function getFilePath() : string
    {
        return $this->files['picture']['tmp_name'];
    }

    public function getSize() : int
    {
        return $this->files['picture']['size'];
    }

    public function getImageSize()
    {
        return getimagesize($this->getFilePath());
    }

    public function getMimeType() : string
    {
        return $this->files['picture']['type'];
    }

    public function getUploadedFile() : SuxxUploadedFile
    {
        return $this;
    }
}
