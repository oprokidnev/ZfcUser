<?php

namespace ZfcUser\Factory\Controller\Plugin;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use ZfcUser\Controller;
use ZfcUser\Controller\Plugin\ZfcUserAuthentication;

class ZfcUserAuthentication implements FactoryInterface
{

    /**
     * Create service
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     * @return ZfcUserAuthentication
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $authService = $container->get('zfcuser_auth_service');
        $authAdapter = $container->get('ZfcUser\Authentication\Adapter\AdapterChain');
        $controllerPlugin = new Controller\Plugin\ZfcUserAuthentication;
        $controllerPlugin->setAuthService($authService);
        $controllerPlugin->setAuthAdapter($authAdapter);
        return $controllerPlugin;
    }
}
