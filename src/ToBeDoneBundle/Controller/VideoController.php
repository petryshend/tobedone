<?php

namespace ToBeDoneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class VideoController extends Controller
{
    public function indexAction()
    {
        $finder = new Finder();

        $moviesDirectory = $this->get('kernel')->getRootDir() . '/../web/movies';

        $finder->files()->in($moviesDirectory);

        $fileNames = [];
        foreach ($finder as $file) {
            /** @var SplFileInfo $file */
            $fileNames[] = $file->getFilename();
        }

        return $this->render(
            '@ToBeDone/video/video.html.twig',
            ['fileNames' => $fileNames]
        );
    }
}
