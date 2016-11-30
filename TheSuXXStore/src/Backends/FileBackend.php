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

            $result = move_uploaded_file($source, $destination);
            if ($result === false) {
                throw new InvalidFileBackendException('Das File konnte nicht bewegt werden oder ist ungültig!');
            }
        }

        public function directoryExists($directory) : bool
        {
            return is_dir($directory);

        }
    }
}

