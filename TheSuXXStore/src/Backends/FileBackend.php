<?php
namespace Suxx\Backends {

    use Suxx\Exceptions\InvalidFileBackendException;

    class FileBackend
    {
        public function moveUploadedFileTo($source, $destination)
        {
            //@codeCoverageIgnoreStart
            $spl = new \SplFileInfo($destination);
            //@codeCoverageIgnoreEnd

            if (!$this->directoryExists($spl->getPath())) {
                throw new InvalidFileBackendException('Das angegebene Directory existiert nicht!');
            }
            move_uploaded_file($source, $destination); //fehlerbehandlung der methode fehlt
        }

        public function directoryExists($directory) : bool
        {
            return is_dir($directory);

        }
    }
}

