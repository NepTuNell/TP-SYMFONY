<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class NouveauClientController extends AbstractController
{
    /**
     * @Route("/info/{prenom}", name="nouveau_client_info", methods={"GET"}, requirements={"prenom": "^[a-zA-Z][a-zA-Z|-]+[a-zA-Z]$"})
     */
    public function info(string $prenom): Response
    {
        $response = new Response(
            'Le nom est: '.$prenom,
            200,
            [
                'Content-type' => 'text/plain'
            ]
        );

        return $response;
    }

    public function info1(string $prenom): Response
    {
        $response = new Response(
            'Le nom est: '.$prenom,
            200,
            [
                'Content-type' => 'text/plain'
            ]
        );

        return $response;
    }

    public function info2(string $prenom): Response
    {
        $response = new Response(
            'Le nom est: '.$prenom,
            200,
            [
                'Content-type' => 'text/plain'
            ]
        );

        return $response;
    }
}