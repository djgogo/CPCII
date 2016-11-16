<?php
namespace Fancy;

class SuxxFileBackend
{
    public function moveUploadedFileTo($source, $destination)
    {
        //@codeCoverageIgnoreStart
        $spl = new \SplFileInfo($destination);
        //@codeCoverageIgnoreEnd

        if (!$this->directoryExists($spl->getPath())) {
            throw new \InvalidFileBackendException('Das angegebene Directory existiert nicht!');
        }
        move_uploaded_file($source, $destination);
    }

    public function directoryExists($directory) : bool
    {
        return is_dir($directory);

    }
}

