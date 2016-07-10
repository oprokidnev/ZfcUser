<?php

namespace ZfcUser\Factory\View\Helper;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use ZfcUser\View;

class ZfcUserDisplayName implements FactoryInterface
{

    /**
     * Create service
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     * @return View\Helper\ZfcUserDisplayName
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $viewHelper = new View\Helper\ZfcUserDisplayName;
        $viewHelper->setAuthService($container->get('zfcuser_auth_service'));
        return $viewHelper;
    }
}
