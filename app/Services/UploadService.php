<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadService
{
    public static function upload(UploadedFile $uploadedFile, string $folder, string $disk = 'public'): string
    {
        // Nombre del archivo sin la extensión
        $fileName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);

        // Extensión del archivo
        $fileExtension = $uploadedFile->getClientOriginalExtension();

        // Renombrando el archivo
        $fileName = $fileName . '-' . time() . '.' . $fileExtension;

        return $uploadedFile->storeAs($folder, $fileName, $disk);
    }

    public static function delete(string $path, string $disk = 'public'): bool
    {
        if (!Storage::disk($disk)->exists($path)) {
            return false;
        }

        return Storage::disk($disk)->delete($path);
    }

    public static function url(string $path, string $disk = 'public'): string
    {
        // return Storage::disk($disk)->path($path);
        return Storage::disk($disk)->url($path);
        // return Storage::url($path);
    }
}
