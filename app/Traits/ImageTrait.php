<?php

namespace App\Traits;

use App\Models\Role;


trait ImageTrait
{
    // todo save image 
    public function saveimage($image, $folder)
    {
        //? Ensure the folder exists
        $folderPath = public_path($folder);
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0755, true);
        }

        $image_name = time() . '.' . $image->extension();
        $images = $image->move(public_path($folder), $image_name);
        $path = $folder . $image_name;

        return $path;
    }


    // todo save pdf
    public function savePdf($file, $folder)
    {
        $folderPath = public_path($folder);

        //? Ensure the folder exists
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0755, true);
        }
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        try {
            $file->move($folderPath, $fileName);
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
        return $folder . '/' . $fileName;
    }






}





