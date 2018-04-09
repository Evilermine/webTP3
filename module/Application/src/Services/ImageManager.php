<?php
namespace Application\Services;

/*
    Source : https://olegkrivtsov.github.io/using-zend-framework-3-book/html/en/Uploading_Files_with_Forms/Example__Image_Gallery.html
*/
// The image manager service.
class ImageManager 
{
    // The directory where we save image files.
    private $saveToDir = './data/upload/';
        
    // Returns path to the directory where we save the image files.
    public function getSaveToDir() 
    {
        return $this->saveToDir;
    }

    public function getImagePathByName($fileName) 
    {
        // Take some precautions to make file name secure.
        $fileName = str_replace("/", "", $fileName);  // Remove slashes.
        $fileName = str_replace("\\", "", $fileName); // Remove back-slashes.
                
        // Return concatenated directory name and file name.
        return $this->saveToDir . $fileName;                
    }
  
    // Returns the image file content. On error, returns boolean false. 
    public function getImageFileContent($filePath) 
    {
        return file_get_contents($filePath);
    }
    
    // Retrieves the file information (size, MIME type) by image path.
    public function getImageFileInfo($filePath) 
    {
        // Try to open file        
        if (!is_readable($filePath)) {            
            return false;
        }
            
        // Get file size in bytes.
        $fileSize = filesize($filePath);

        // Get MIME type of the file.
        $finfo = finfo_open(FILEINFO_MIME);
        $mimeType = finfo_file($finfo, $filePath);
        if($mimeType===false)
            $mimeType = 'application/octet-stream';
    
        return [
            'size' => $fileSize,
            'type' => $mimeType 
        ];
    }

    public  function resizeImage($filePath, $desiredWidth = 240) 
    {
        // Get original image dimensions.
        list($originalWidth, $originalHeight) = getimagesize($filePath);

        // Calculate aspect ratio
        $aspectRatio = $originalWidth/$originalHeight;
        // Calculate the resulting height
        $desiredHeight = $desiredWidth/$aspectRatio;

        // Get image info
        $fileInfo = $this->getImageFileInfo($filePath); 
        
        // Resize the image
        $resultingImage = imagecreatetruecolor($desiredWidth, $desiredHeight);
        if (substr($fileInfo['type'], 0, 9) =='image/png')
            $originalImage = imagecreatefrompng($filePath);
        else
            $originalImage = imagecreatefromjpeg($filePath);
        imagecopyresampled($resultingImage, $originalImage, 0, 0, 0, 0, 
            $desiredWidth, $desiredHeight, $originalWidth, $originalHeight);

        // Save the resized image to temporary location
        $tmpFileName = tempnam("/tmp", "FOO");
        imagejpeg($resultingImage, $tmpFileName, 80);
        
        // Return the path to resulting image.
        return $tmpFileName;
    }
}