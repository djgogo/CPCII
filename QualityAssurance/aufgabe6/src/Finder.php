<?php
declare(strict_types = 1);

class Finder
{
    public function findDeclarationsInDirectory(string $filePath) : array
    {
        $classNames = [];
        if ($handle = opendir($filePath)) {
            while (($entry = readdir($handle)) !== false) {
                if ($entry != '.' && $entry != '..') {
                    $classNames[] = $this->getClassFromFile($entry);
                }
            }
            closedir($handle);
        }
        return $classNames;
    }

    private function getClassFromFile(string $entry)
    {
        // Grab the contents of the file
        $contents = file_get_contents(__DIR__ . '/' . $entry);

        // Initialize class Name Variable
        $className = '';

        // Set helper value to know that we have found the class token and need to collect the string values after them
        $getClass = false;

        // Go through each token
        foreach (token_get_all($contents) as $token) {

            // If this token is the class declaring, then flag that the next tokens will be the class name
            if (is_array($token) && $token[0] === T_CLASS) {
                $getClass = true;
            }

            // Grabbing the class name...
            if ($getClass === true) {

                // If the token is a string, it's the name of the class
                if (is_array($token) && $token[0] === T_STRING) {
                    $className = $token[1];
                    break;
                }
            }
        }
        return $className;
    }

    public function printClassNames(array $classNames)
    {
        foreach ($classNames as $className) {
            printf("Found: %s\n", $className);
        }
    }
}
