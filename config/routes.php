<?php

use App\Controller\NouveauClientController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->add('nouveau_client_info_1', '/info1/{prenom}')
        ->controller([
            NouveauClientController::class, 'info1'
        ])
        ->requirements([
            'prenom' => '^[a-zA-Z][a-zA-Z|-]+[a-zA-Z]$'
        ])
        ->methods(['GET'])
    ;
};