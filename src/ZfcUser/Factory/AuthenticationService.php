<?php

namespace ZfcUser\Factory;

use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Factory\FactoryInterface;

class AuthenticationService implements FactoryInterface
{

    /**
     * Create service
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     * @return AuthenticationService
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new AuthenticationService(
            $container->get('ZfcUser\Authentication\Storage\Db'),
            $container->get('ZfcUser\Authentication\Adapter\AdapterChain')
        );
    }
}
