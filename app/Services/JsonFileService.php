<?php

namespace App\Services;

class JsonFileService
{
    protected $jsonFile;

    // Method to set the json file
    public function setJsonFile($jsonFile)
    {
        $this->jsonFile = $jsonFile;
    }

    // Method to get the json file
    public function getJsonFile()
    {
        return $this->jsonFile;
    }
}
