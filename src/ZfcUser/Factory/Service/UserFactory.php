<?php

namespace ZfcUser\Factory\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use ZfcUser\Service\User;

class UserFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     * @return User
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $service = new User();
        $service->setServiceManager($container);
        return $service;
    }
}
