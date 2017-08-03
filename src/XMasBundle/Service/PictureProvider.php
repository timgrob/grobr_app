<?php

namespace XMasBundle\Service;

class PictureProvider
{
    /**
     * PictureProvider constructor.
     */
    public function __construct()
    {
    }

    public function fetchPictureFileNames()
    {
        $picturePaths = [];
        $dir = __DIR__ . '/../Resources/images';

        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    array_push($picturePaths, $file);
                }
                closedir($dh);
            }
        }
        return $picturePaths;
    }
}