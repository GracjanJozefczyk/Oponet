<?php


namespace App\Service;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderHelper
{
    const TIRE_BRAND_IMAGE = 'tires_brands';

    /**
     * @var string
     */
    private $uploadsPath;

    public function __construct(string $uploadsPath)
    {
        $this->uploadsPath = $uploadsPath;
    }

    public function uploadBrandImage(UploadedFile $uploadedFile, string $filename): string
    {
        $destination = $this->uploadsPath.'/tires_brands';
        $filename = preg_replace('/[^a-z0-9]+/', '_', strtolower($filename)).'.'.$uploadedFile->guessExtension();

        $uploadedFile->move(
            $destination,
            $filename
        );

        return $filename;
    }
}