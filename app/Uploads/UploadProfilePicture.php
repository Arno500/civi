<?php
/**
 * Created by PhpStorm.
 * User: Arno
 * Date: 08/02/2018
 * Time: 20:04
 */

namespace App\Uploads;


class UploadProfilePicture implements UploadProfilePictureInterface
{
    public function save($image)
    {
        if($image->isValid())
        {
            $chemin = config('images.path');
            $extension = $image->getClientOriginalExtension();

            do {
                $nom = str_random(10) . '.' . $extension; //À CHANGER POUR LA BDD
            } while(file_exists($chemin . '/' . $nom));

            return $image->move($chemin, $nom);
        }

        return false;
    }

}