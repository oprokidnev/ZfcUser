<?php

namespace ZfcUser\Factory;

use Interop\Container\ContainerInterface;
use Zend\Hydrator\ClassMethods;
use Zend\ServiceManager\Factory\FactoryInterface;

class UserHydrator implements FactoryInterface
{

    /**
     * Create service
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     * @return ClassMethods
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new ClassMethods();
    }
}
