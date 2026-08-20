<?php

namespace App\Services\Dashboard;

use Illuminate\Support\Str;
use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Laravel\Facades\Image;
use InvalidArgumentException;

class FileUploaderService
{
    public function __construct()
    {
        $uploadsDirectory = public_path('uploads');
        if (!is_dir($uploadsDirectory)) {
            mkdir($uploadsDirectory, 0755, true);
        }
        $filesDirectory = [
            'images/avatars',
            'images/watermark',
            'images/thumbnails/large',
            'images/thumbnails/medium',
            'images/thumbnails/small',
            'file_manager',
        ];

        foreach ($filesDirectory as $directory) {
            $fullDirectory = $uploadsDirectory . '/' . $directory;
            if (!is_dir($fullDirectory)) {
                mkdir($fullDirectory, 0755, true);
            }
        }
    }

    public function upload($file, $thumbnail = false, $avatar = false, $fileManager = false)
    {
        $processMethods = [
            $thumbnail => 'processThumbnail',
            $avatar => 'processAvatar',
            $fileManager => 'processFileManager',
        ];

        foreach ($processMethods as $condition => $method) {
            if ($condition) {
                return $this->$method($file);
            }
        }
    }

    private function processThumbnail($file)
    {
        $thumbnailDimensions = [
            'small' => [300, 225],
            'medium' => [500, 500],
            'large' => [1000, 750],
        ];

        $names = [];
        foreach ($thumbnailDimensions as $sizeLabel => $dimensions) {
            $resizedImage = $this->resize($file, $dimensions[0], $dimensions[1]);
            $markedImage = $this->addWatermark($resizedImage);
            $names[$sizeLabel] = $this->storeFile($file, $markedImage, $sizeLabel);
        }

        return $names;
    }

    private function processAvatar($file)
    {
        $interventionFile = Image::read($file);
        return $this->storeFile($file, $interventionFile, 'avatars');
    }

    private function processFileManager($files)
    {
        $names = [];
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF'];
        foreach ($files['files'] as $file) {
            if (in_array($file->getClientOriginalExtension(), $imageExtensions)) {
                $markedImage = $this->addWatermark($file);
                $names[]  = $this->storeFile($file, $markedImage, 'file_manager', 'images');
            } else {
                $type = explode('/', $file->getClientMimeType())[0] . 's';
                $names[]  = $this->storeFile($file, null, 'file_manager', $type);
            }
        }

        return $names;
    }

    private function resize($file, $width, $height): ImageInterface
    {
        $image = Image::read($file);

        $aspectRatio = $image->width() / $image->height();

        if ($width === $height) {
            return $image->cover($width, $height);
        }

        if ($aspectRatio > ($width / $height)) {
            $calculatedWidth = $width;
            $calculatedHeight = intval($width / $aspectRatio);
        } else {
            $calculatedHeight = $height;
            $calculatedWidth = intval($height * $aspectRatio);
        }

        return $image->resize($calculatedWidth, $calculatedHeight);
    }

    private function addWatermark($image): ImageInterface
    {
        $image = Image::read($image);
        $watermarkImage = public_path('uploads/images/watermark/logo.png');
        if (file_exists($watermarkImage)) {
            return $image->place($watermarkImage, 'bottom-left', 5, 5);
        }

        return $image;
    }

    private function storeFile($originalFile, $fileToStore, string $variant, $type = ''): string
    {
        $fileName = pathinfo($originalFile->getClientOriginalName(), PATHINFO_FILENAME);
        $fileExtension = $originalFile->getClientOriginalExtension();

        if ($variant !== 'avatars') {
            $generatedFileName = $fileName . '_' . time() . '-' . $variant . '.' . $fileExtension;
        } else {
            $generatedFileName = auth()->id() . '.png';
        }

        $uploadDirectory = public_path($this->findUploadPath($variant, $type));

        if (!$type) {
            $fileToStore->save($uploadDirectory . $generatedFileName);
            return $generatedFileName;
        } else {
            $fileNameWithLastDir = Str::after($uploadDirectory, 'file_manager/') . $generatedFileName;
            if ($type == 'images' && $fileExtension != 'svg') {
                $fileToStore->save($uploadDirectory . $generatedFileName);
            } else {
                $originalFile->move($uploadDirectory, $generatedFileName);
            }
            return $fileNameWithLastDir;
        }
    }

    private function findUploadPath($variant, $type): string
    {
        if ($type) {
            $directory = "uploads/{$variant}/{$type}";
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }
        }
        return match ($variant) {
            'avatars' => "uploads/images/{$variant}/",
            'large', 'medium', 'small' => "uploads/images/thumbnails/{$variant}/",
            'file_manager' => "uploads/{$variant}/{$type}/",
            default => throw new InvalidArgumentException('Variant نامعتبر است'),
        };
    }

}
