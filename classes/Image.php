<?php

class Image 
{
    private $file;
    private $maxSize;
    private $type;
    private $validType;
    public $fileName;

    public function __construct($file, $size, $valid_exts)
    {
        $this->file = $file;
        $this->maxSize = $size;
        $this->validType = $valid_exts;
    }

    public function checkFile() 
    {
        if ($this->file['error'] == UPLOAD_ERR_NO_FILE) {
            throw new Exception('file_exist');
        }
    }
    
    public function checkSize() 
    {
        if($this->file['size'] > $this->maxSize){
            throw new Exception('file_size');
        }
    }
    
    private function getType() 
    {
        $this->type = pathinfo($this->file['name'], PATHINFO_EXTENSION);
    }

    public function checkType() 
    {    
        if(!in_array($this->type, $this->validType)) {
            throw new Exception('file_type');
        }
    }
    
    public function createName() 
    {
        $this->fileName = time() . '.' . $this->type;
    }
    
    public function moveFile($folders) 
    {
        $path = $folders . $this->fileName;
        move_uploaded_file($this->file['tmp_name'], $path);
    }
    
    public function uploadFile($folders){
        $this->checkFile();
        $this->checkSize();
        $this->getType();
        $this->checkType();
        $this->createName();
        $this->moveFile($folders);
    }
}