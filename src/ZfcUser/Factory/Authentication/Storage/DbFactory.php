<?php

namespace ZfcUser\Factory\Authentication\Storage;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use ZfcUser\Authentication\Storage\Db;

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
