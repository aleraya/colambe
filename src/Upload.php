<?php

namespace App;

use Exception;

class Upload {

    protected $path;
    
    public function __construct (?string $path=null) 
    {
        if ($path) {
            $this->path = $path;
        }
    }
    
    public function upload(array $file, ?string $oldFile=null): string
    {
        $this->delete($oldFile);
        

        if ($file['error'] !== UPLOAD_ERR_OK){
            throw new Exception("Une erreur est survenu lors du transfert : UPLOAD_ERR {$file['error']}");
        }

        $validExt = ['.jpg', '.jpeg', '.png', '.gif'];
        $fileName =$file['name'];
        $fileExt = "." . strtolower(substr(strrchr($fileName, '.'), 1));

        // $tabExt = explode('.', $name);
        // $fileExt = strtolower(end($tabExt))

        if (!in_array($fileExt, $validExt)) {
            throw new Exception("Le fichier n'est pas une image");
        }
        $maxSize = 500000;
        $fileSize = $file['size'];
        if ($fileSize > $maxSize) {
            throw new Exception("Fichier trop volumineux : doit être inférieur à $maxSize octets.");
        }

        //$fileName = uniqid('', true);  //$fileName md5(uniqid(rand(), true));
        $targetPath = $this->addSuffix($this->path . $fileName);
        $resultat = move_uploaded_file($file['tmp_name'], $targetPath);
        if (!$resultat) {
            throw new Exception("Une erreur est survenue lors de l'envoi du fichier");
        }
        $fileName = pathinfo($targetPath)['basename'];
        return $fileName;
    }

    private function addSuffix(string $path): string
    {
        if (file_exists($path)) {
            $info = pathinfo($path);
            $path = $info['dirname'] . DS . $info['filename'] . '_copy.' . $info['extension'];
            return $this->addSuffix($path);
        }
        return $path;
    }

    private function delete(?string $file): void
    {
        if ($file) {
            $file = $this->path . $file;
            if (file_exists($file)) {
                unlink($file);
            }    
        }
    }

}

