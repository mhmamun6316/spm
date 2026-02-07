<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait ImageUploadTrait
{
    /**
     * Upload a base64 encoded image or standard uploaded file.
     *
     * @param mixed $image Input image (base64 string or UploadedFile)
     * @param string $path Directory path
     * @return string|null The stored file path
     */
    public function uploadImage($image, $path = 'images')
    {
        if (!$image) {
            return null;
        }

        // Handle Base64
        if (is_string($image) && strpos($image, 'base64') !== false) {
            $image_parts = explode(";base64,", $image);
            $image_type_aux = explode("image/", $image_parts[0]);
            
            // Default to png if type can't be determined (though it usually can)
            $image_type = isset($image_type_aux[1]) ? $image_type_aux[1] : 'png';
            
            $image_base64 = base64_decode($image_parts[1]);
            $fileName = $path . '/' . Str::random(40) . '.' . $image_type;

            Storage::disk('public')->put($fileName, $image_base64);

            return $fileName;
        }
        
        // Handle Standard UploadedFile
        if (is_object($image) && method_exists($image, 'store')) {
             return $image->store($path, 'public');
        }

        return null;
    }

    /**
     * Delete an image from storage.
     * 
     * @param string|null $path
     * @return bool
     */
    public function deleteImage($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }
        return false;
    }
}
