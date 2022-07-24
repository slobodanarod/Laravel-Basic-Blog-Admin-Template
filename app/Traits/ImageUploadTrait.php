<?php

namespace App\Traits;
use Illuminate\Support\Str;
trait ImageUploadTrait
{
    public function ImageUpload($query,$path = "",$name = "") // Taking input image as parameter
    {
        $image_name = Str::random(5) . "-" . Str::slug($name);
        $ext = strtolower($query->getClientOriginalExtension()); // You can use also getClientOriginalName()
        $image_full_name = $image_name.'.'.$ext;
        $upload_path = 'images/' . $path . "/";    //Creating Sub directory in Public folder to put image
        $image_url = $upload_path.$image_full_name;
        $success = $query->move($upload_path,$image_full_name);
        if($success){
            return $image_url; // Just return image
        }
        return $upload_path . "no-image.png";
    }


    public function deleteImage($file){

        if(file_exists($file)){
            unlink($file);
        }

    }

}

?>
