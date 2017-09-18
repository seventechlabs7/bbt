<?php
namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file ,$uId)
    {
        $fileName =mt_rand(100000,999999).$uId.'.'.$file->guessExtension();
        //$fileName = $uId.'.'.$file->guessExtension();
        ($file->move(__DIR__.$this->getTargetDir(), $fileName));
        //$save = $this->getTargetDir(). strtolower($uId) .".png";
        //$img  = imagecreatefrompng($file);
        
       $fType = (mime_content_type((__DIR__.$this->getTargetDir().$fileName)));
       if($fType != "image/png" &&  $fType != "image/jpeg" && $fType != "image/gif")
        {
            $removeFile = $fileUploader->removeFileFullPath($fileName);

            return "failure";

        }
        
        return $fileName;
    }

    public function removeFile($image)
    {
        if(file_exists(__DIR__.$this->getTargetDir().$image))
        unlink(__DIR__.$this->getTargetDir().$image);
    }
    public function removeFileFullPath($image)
    {
        if(file_exists($image))
            unlink($image);
    }
     public function getImagePath()
    {       
        return __DIR__.$this->getTargetDir() ;
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }
}