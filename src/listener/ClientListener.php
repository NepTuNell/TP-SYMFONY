<?php

namespace App\EventListener;
 
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;


class ClientListener
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(
        RouterInterface $router,
        ContainerInterface $container
    ) {
        $this->router = $router;
        $this->container = $container;
    }

    public function getRouter(): RouterInterface
    {
        return $this->router;
    }

    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }

    public function onKernelController(ControllerEvent $event)
    {
        if (!$event->isMasterRequest()) {
            // don't do anything if it's not the master request
            return;
        } 
        
        $request  = $event->getRequest();
        $routeName = $request->get('_route');
        
        if ("open" === $routeName) {
            $router = $this->getRouter();
            $options = $router->getRouteCollection()->get($routeName)->getOption('ouverture');
            $hours = explode('-', $options);
            
            if (date('G') < $hours[0] || date('G') > $hours[1]) {
                $controller = $this->getContainer()->get('App\Controller\CloseController');
                $event->setController([
                    $controller,
                    'close'
                ]);  
            }

        }
    }
}