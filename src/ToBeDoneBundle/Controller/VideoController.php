<?php

namespace ToBeDoneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpFoundation\Response;

class VideoController extends Controller
{
    /**
     * @return Response
     */
    public function listAction()
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
            '@ToBeDone/video/video_list.html.twig',
            ['fileNames' => $fileNames]
        );
    }

    /**
     * @param string $filename
     * @return Response
     */
    public function singleAction($filename)
    {
        return $this->render('@ToBeDone/video/video.html.twig', ['filename' => $filename]);
    }
}
