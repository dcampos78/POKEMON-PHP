<?php

namespace App\Manager;

use Doctrine\DBAL\Driver\Exception;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PokemonManager
{
    public function subirImagen(UploadedFile $imagen, string $destino):string
    {
        $fileName = uniqid(). ".".$imagen->guessExtension();

        try{
            $imagen->move($destino, $fileName);
        } catch (Exception $e){

        }

        return $fileName;
    }
}
