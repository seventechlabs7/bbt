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
        //$fileName = md5(uniqid()).'.'.$file->guessExtension();
        $fileName = $uId.'.'.$file->guessExtension();
       // $file->move($this->getTargetDir(), $fileName);
        $save = $this->getTargetDir(). strtolower($uId) .".png";
        $img  = imagecreatefrompng($file);
      return  imagepng($img, $save);
        
        return "success";
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }
}