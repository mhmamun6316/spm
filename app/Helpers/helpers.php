<?php

use App\Models\Entrepreneur\Entrepreneur;
use App\Models\ProductStore;
use App\Models\TrainingManagement\TrainingCenter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;


if (!function_exists('en2bn')) {
    function en2bn($number)
    {
        // English to Bengali number mapping
        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $bengaliNumbers = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];

        // Replace English numbers with Bengali numbers
        return str_replace($englishNumbers, $bengaliNumbers, $number);
    }
}

if (!function_exists('bn2en')) {
    function bn2en($number)
    {
        // Bengali to English number mapping
        $bengaliNumbers = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        // Replace Bengali numbers with English numbers
        return str_replace($bengaliNumbers, $englishNumbers, $number);
    }
}

if (!function_exists('formatAmount')) {
    function formatAmount($amount)
    {
        if ($amount === null || $amount === '') {
            return '';
        }

        $number = (float) $amount;

        if (floor($number) == $number) {
            $formatted = number_format($number);
        } else {
            $formatted = rtrim(rtrim(number_format($number, 2), '0'), '.');
        }
        return app()->getLocale() === 'bn' ? en2bn($formatted) : $formatted;
    }
}

if (!function_exists('dateformat')) {
    function dateformat($date, $format = 'd-m-Y')
    {
        if (!$date) return '';

        $formatted = \Carbon\Carbon::parse($date)->format($format);

        // If locale is Bengali, convert numbers only
        if (app()->getLocale() === 'bn') {
            return en2bn($formatted);
        }

        return $formatted;
    }
}

if (!function_exists('getDayList')) {
    function getDayList($lang = 'en')
    {
        if ($lang === 'bn') {
            return ['রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শুক্রবার', 'শনিবার'];
        }
        return ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    }
}

if (!function_exists('getMonthList')) {
    function getMonthList($lang = 'en'): array
    {
        $en = [
            '1' => 'January',
            '2' => 'February',
            '3' => 'March',
            '4' => 'April',
            '5' => 'May',
            '6' => 'June',
            '7' => 'July',
            '8' => 'August',
            '9' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December'
        ];

        $bn = [
            '1' => 'জানুয়ারি',
            '2' => 'ফেব্রুয়ারি',
            '3' => 'মার্চ',
            '4' => 'এপ্রিল',
            '5' => 'মে',
            '6' => 'জুন',
            '7' => 'জুলাই',
            '8' => 'আগস্ট',
            '9' => 'সেপ্টেমবর',
            '10' => 'অক্টোবর',
            '11' => 'নভেম্বর',
            '12' => 'ডিসেম্বর'
        ];

        return $lang === 'bn' ? $bn : $en;
    }
}

if (!function_exists('getYearList')) {
    function getYearList($startYear = 2000)
    {
        $currentYear = date('Y');
        return range($startYear, $currentYear);
    }
}

if (!function_exists('helperFileUploader')) {
    function helperFileUploader($file, array $mimes, string $path)
    {
        $mimeType = $file->getClientMimeType();
        if (!in_array($mimeType, $mimes)) {
            throw new \Exception('Invalid file MIME type.');
        }


        $fileSize = $file->getSize();
        if ($fileSize > 2097152) { // 2MB in bytes
            throw new \Exception('File size exceeds 2MB limit.');
        }

        // Generate unique file path
        $storedFilePath = $path . '/' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Ensure the directory exists
        if (!Storage::disk('public')->exists($path)) {
            Storage::disk('public')->makeDirectory($path);
        }

        // Store the file
        Storage::disk('public')->put($storedFilePath, file_get_contents($file->getRealPath()));

        // Verify the file was stored
        if (!Storage::disk('public')->exists($storedFilePath)) {
            throw new \Exception('Failed to store the file.');
        }

        return $storedFilePath;
    }
}

if (!function_exists('helperLivePhotoUploader')) {
    /**
     * @throws Exception
     */
    function helperLivePhotoUploader($img, $liveImageField)
    {
        $endFilePath = str_replace('_', '-', $liveImageField) . 's/';
        $uploadPath = 'uploads/' . $endFilePath;
        $image_parts = explode(";base64,", $img);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';

        $file = $uploadPath . $fileName;
        Storage::disk('public')->put($file, $image_base64);

        return $file;
    }
}


if (!function_exists('uploadBase64Image')) {
    function uploadBase64Image(string $base64, string $disk = 'public', string $folder = 'images', string $extension = 'jpg'): string|false
    {
        if (str_contains($base64, 'data:image/')) {
            $base64 = explode(',', $base64)[1] ?? $base64;
        }
        $base64 = str_replace(' ', '+', $base64);
        $imageData = base64_decode($base64, true);

        if ($imageData === false) {
            return false;
        }

        $fileName = 'image_' . time() . '_' . uniqid() . '.' . $extension;
        $fullPath = $folder . '/' . $fileName;
        if (Storage::disk($disk)->put($fullPath, $imageData)) {
            return $fullPath;
        }

        return false;
    }
}

if (!function_exists('deleteStorageFile')) {
    function deleteStorageFile(?string $path, string $disk = 'public'): bool
    {
        if ($path && Storage::disk($disk)->exists($path)) {
            return Storage::disk($disk)->delete($path);
        }
        return false;
    }
}
if (!function_exists('getPageContent')) {
    /**
     * Get page content by key
     * 
     * @param string $key The content key (mission, values, footer_about, etc.)
     * @param string $default Default value if not found
     * @return string The content description or default value
     */
    function getPageContent($key, $default = '')
    {
        $content = \App\Models\PageContent::where('key', $key)
            ->where('is_active', true)
            ->first();

        return $content ? $content->description : $default;
    }
}

if (!function_exists('getPageTitle')) {
    /**
     * Get page content title by key
     * 
     * @param string $key The content key (mission, values, footer_about, etc.)
     * @param string $default Default value if not found
     * @return string The content title or default value
     */
    function getPageTitle($key, $default = '')
    {
        $content = \App\Models\PageContent::where('key', $key)
            ->where('is_active', true)
            ->first();

        return $content ? $content->title : $default;
    }
}