<?php
declare(strict_types = 1);

class SuxxFileBackend
{
    public function moveUploadedFileTo($source, $destination)
    {
        $spl = new \SplFileInfo($destination);

        if (!$this->directoryExists($spl->getPath())) {
            throw new \InvalidFileBackendException('Das angegebene Directory existiert nicht!');
        }
        move_uploaded_file($source, $destination);
    }

    public function exists($filename) : bool
    {
        return file_exists($filename);
    }

    public function directoryExists($directory) : bool
    {
        return is_dir($directory);
    }
}

