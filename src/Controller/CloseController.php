<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CloseController extends AbstractController
{
    public function close(): Response
    {
        $response = new Response(
            'Fermé',
            200,
            [
                'Content-type' => 'text/plain'
            ]
        );

        return $response;
    }
}