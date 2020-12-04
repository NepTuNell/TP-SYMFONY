<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class OpenController extends AbstractController
{
    /**
     * @Route("/open", name="open", methods={"GET"}, Options={"ouverture":"8-17"})
     */
    public function open(): Response
    {
        $response = new Response(
            'Ouvert',
            200,
            [
                'Content-type' => 'text/plain'
            ]
        );

        return $response;
    }
}