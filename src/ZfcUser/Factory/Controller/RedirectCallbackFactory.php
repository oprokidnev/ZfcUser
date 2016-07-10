<?php

namespace ZfcUser\Factory\Controller;

use Interop\Container\ContainerInterface;
use Zend\Mvc\Application;
use Zend\Router\RouteInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use ZfcUser\Controller\RedirectCallback;
use ZfcUser\Options\ModuleOptions;

class RedirectCallbackFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     * @return RedirectCallback
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /* @var RouteInterface $router */
        $router = $container->get('Router');

        /* @var Application $application */
        $application = $container->get('Application');

        /* @var ModuleOptions $options */
        $options = $container->get('zfcuser_module_options');

        return new RedirectCallback($application, $router, $options);
    }
}
