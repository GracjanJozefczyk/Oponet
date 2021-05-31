<?php


namespace App\Service;


use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Filesystem;

class UploaderHelper
{
    const TIRE_BRAND_IMAGE = 'tires_brands';

    /**
     * @var string
     */
    private $uploadsPath;
    /**
     * @var string
     */
    private $environment;

    public function __construct(string $uploadsPath, ParameterBagInterface $params)
    {
        $this->uploadsPath = $uploadsPath;
        $this->environment = $params->get('kernel.environment');
    }

    public function uploadBrandImage(UploadedFile $uploadedFile): string
    {
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
        $destination = $this->uploadsPath.'/tires_brands';
        $filename = $safeFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();

        if ($this->environment !== 'test') {
            $uploadedFile->move(
                $destination,
                $filename
            );
        }

        return $filename;
    }

    public function uploadModelImage(UploadedFile $uploadedFile): string
    {
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
        $destination = $this->uploadsPath.'/tires_models';
        $filename = $safeFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();

        $uploadedFile->move(
            $destination,
            $filename
        );

        return $filename;
    }

    public function deleteModelImage(string $img)
    {
        $filesystem = new Filesystem();
        $filesystem->remove($this->uploadsPath.'/tires_models/'.$img);
    }
}