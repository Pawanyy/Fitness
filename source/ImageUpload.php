<?php
class ImageUpload{

    // file name
    protected ? string $name;

    // file type
    protected ? string $mime;

    // file extension
    protected ? string $extension;

    // file path
    protected ? string $path;

    // error message
    protected ? string $message;

    // file storage
    protected string $storage;

    // file size
    protected int $size;

    // 3 MB (1 byte * 1024 * 1024 * 3 (for 3 MB)) = 3145728
    protected array $allowedSize = array(100, 3145728);

    // file allowed mime
    protected array $allowedMimeTypes;

    // supported mineTypes
    protected array $mimeTypes = array('jpeg', 'png', 'gif', 'jpg');

    // file upload status
    protected bool $upload = false;

    public function __construct()
    {   
        $this->name = null;
        $this->path = null;
        $this->mime = null;
        $this->message = null;
        $this->allowedMimeTypes = $this->mimeTypes;
    }

    // Pass a custom name, or it will be auto-generated
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    // define the min/max image upload size (size in bytes) 
    public function setSize(int $min_bytes, int $max_bytes):void
    {
        $this->allowedSize = array($min_bytes, $max_bytes);
    }

    // define the min/max image upload size (size in bytes) 
    public function setPath(string $path):void
    {
        $this->path = $path;
    }

    // define allowed mime types to upload
    function setMime(array $mimeTypes): void
    {
        $this->allowedMimeTypes = $mimeTypes;
    }

    // Start File Upload
    public function Upload( $_file)
    {

        $this->size  = filesize($_file);
        $fileInfo    = finfo_open(FILEINFO_MIME_TYPE);
        $this->ext   = strtolower(pathinfo($_file, PATHINFO_EXTENSION));

        $filetype    = finfo_file($fileInfo, $_file);

        $this->extension = str_replace('image/', '', $filetype);
        $this->mime      = $filetype;

        $this->upload    = true;

        // Checks for File Types
        if ( ! in_array($this->extension, $this->allowedMimeTypes) && $this->upload) {
            $this->upload   = false;
            $this->message .= "File type is not allowed!";
        }

        // Checks for Empty File
        if ( $this->size === 0  && $this->upload) {
            $this->upload   = false;
            $this->message .= "The file is empty!";
        }

        // Checks for Large File Size
        if ( $this->size > $this->allowedSize[1]  && $this->upload) { 
            $this->upload   = false;
            $this->message .= "The file is too large!";
        }

        // Checks for Small File Size
        if ( $this->size < $this->allowedSize[0]  && $this->upload) {
            $this->upload   = false;
            $this->message .= "The file is too small!";
        }

        if ( $this->upload) { 
            
            // Search for malicious code
            $imagedata = file_get_contents($_file);
            if ( preg_match('/(<\?php\s)/',$imagedata)) {
                $this->upload   = false;
                $this->message .= "This file contains a Virus!";
            } else {
                $imagedata = str_replace(chr(0), '', $imagedata);
            }
        }

        // Check for null filename
        if ( is_null($this->name)) {
            $this->name = 'Image_' . time();
        }

        // Move file if validated
        if ( $this->upload) {

            $folder = $this->path . $this->name . '.' . $this->extension;
            
            if ( move_uploaded_file($_file, $folder)) {
                $this->upload   = true;
                $this->message .= "Image Uploaded Successfully!!!";
            } else {
                $this->upload   = false;
                $this->message .= "Failed to upload image!";
            }

        }

    }

    // set the max width/height limit of images to upload (limit in pixels)
    public function isUploaded(): bool
    {
        return $this->upload;
    }

    // get the provided or auto-generated image name
    public function getName(): string | null
    {
        return $this->name;
    }

    // get the provided or auto-generated full image name
    public function getFullName(): string | null
    {
        return $this->name . '.' . $this->extension;
    }

    // get the image size (in bytes)
    public function getSize(): int
    {
        return $this->size;
    }

    // get the image mime (extension)
    public function getMime(): string | null
    {
        return $this->mime;
    }

    // get the image mime (extension)
    public function getExtension(): string | null
    {
        return $this->extension;
    }

    // get the image message
    public function getMessage(): string | null
    {
        return $this->message;
    }

    // get the upload path
    public function getPath(): string | null
    {
        return $this->path;
    }

    //TODO: get image location (folder where images are uploaded)
    public function getLocation(): string
    {
        return '';
    }

    // get the full image path. ex 'images/logo.jpg'
    public function getFullPath(): string
    {
        return $this->path . '' .$this->getFullName();
    }
    
    // Helper to merge paths
    public function merge_paths($path1, $path2){
        $paths = func_get_args();
        $last_key = func_num_args() - 1;
        array_walk($paths, function(&$val, $key) use ($last_key) {
            switch ($key) {
                case 0:
                    $val = rtrim($val, '/ ');
                    break;
                case $last_key:
                    $val = ltrim($val, '/ ');
                    break;
                default:
                    $val = trim($val, '/ ');
                    break;
            }
        });
    
        $first = array_shift($paths);
        $last = array_pop($paths);
        $paths = array_filter($paths); // clean empty elements to prevent double slashes
        array_unshift($paths, $first);
        $paths[] = $last;
        return implode('/', $paths);
    }

}