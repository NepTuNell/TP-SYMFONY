<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ImageController extends AbstractController
{
    /**
     * @var string
     */
    private $path;


    public function __construct()
    {
        if (substr(PHP_OS, 0, 2) === 'WIN') {
            $this->path = __DIR__.'\\..\\..\\images\\';
        } else {
            $this->path = __DIR__.'/../../images/';
        } 
    }

    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @Route("/img/home1", name="image_home_1", methods={"GET"})
     */
    public function home1(): Response
    {
        return $this->render('image/home.html.twig');
    }

    /**
     * @Route("/img/home2", name="image_home_2", methods={"GET"})
     */
    public function home2(): Response
    {
        $files = scandir($this->getPath());

        $rootIndex = \array_search('.', $files);
        if (false !== $rootIndex) {
            unset($files[$rootIndex]);
        }

        $rootIndex = \array_search('..', $files);
        if (false !== $rootIndex) {
            unset($files[$rootIndex]);
        }

        return $this->render('image/home.html.twig', [
            'files' => $files
        ]);
    }

    /**
     * @Route("/img/data/{nom}", name="image_download", methods={"GET"})
     */
    public function affiche(string $nom): Response
    {
        $fullPath = $this->getPath().$nom;

        if (!file_exists($fullPath)) {
            $response = new Response('Fichier non trouvé !', 404);
        } else {
            $response = $this->file($fullPath);
        }
       
        return $response;
    }
}