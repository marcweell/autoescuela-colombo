<?php

namespace Flores;

class FileManager
{
    private $file;
    private $mime_type;


    public function __construct($file = null)
    {
        $this->file = $file;
        $this->handleMimetype();
    }


    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file){
        $this->file = $file;
        $this->handleMimetype();
    }
    private function handleMimetype(){
        $this->mime_type = "";
        if (!is_file($this->file)) {
            return $this;
        }
        $this->mime_type = mime_content_type($this->file);
        return $this;
    }

    public function isVideo()
    {
        if (strstr($this->mime_type, "video/")) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isImage()
    {
        if (strstr($this->mime_type, "image/")) {
            return true;
        }
        return false;
    }
    /**
     * @return bool
     */
    public function isPDF()
    {
        if (strtolower($this->mime_type) == "application/pdf") {
            return true;
        }
        return false;
    }
}
