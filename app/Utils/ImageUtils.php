<?php


namespace App\Utils;


use App\Models\Fragment as FragmentModel;


class ImageUtils
{
    public static function imageCut($imagePath, $id)
    {

        $imageInfo = getimagesize($imagePath);
        $imageW=$imageInfo[0];
        $imageH=$imageInfo[1];

        $imageSizeW = 0;
        $imageSizeH = 0;

        for ($i = 0; $i < 2; $i++) {
            for ($j = 0; $j < 2; $j++) {
                $newImg = imagecreatetruecolor($imageW/2, $imageH/2);
                $orig = imagecreatefromjpeg($imagePath);
                imagecopy($newImg, $orig, 0, 0, $imageSizeW, $imageSizeH, $imageW/2, $imageH/2);
                $fileName = $id.'-'.$i.'-'.$j.'.jpg';
                imagejpeg($newImg,'storage/uploads/'.$fileName);

                $fragment = new FragmentModel;
                $fragment->name = $fileName;
                $fragment->image_id = $id;
                $fragment->save();

                $imageSizeW = $imageSizeW + ($imageW/2);
            }
            $imageSizeH = $imageSizeH + ($imageH/2);
            $imageSizeW = 0;
        }

        return "success";

    }


}
