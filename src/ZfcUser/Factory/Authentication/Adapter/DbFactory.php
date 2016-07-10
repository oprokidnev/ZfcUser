<?php

namespace ZfcUser\Factory\Authentication\Adapter;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use ZfcUser\Authentication\Adapter\Db;

class DbFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     * @return Db
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $db = new Db();
        $db->setServiceManager($container);
        return $db;
    }
}
