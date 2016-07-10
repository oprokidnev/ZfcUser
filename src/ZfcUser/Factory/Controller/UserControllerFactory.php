<?php
/**
 * Created by PhpStorm.
 * User: Clayton Daley
 * Date: 5/6/2015
 * Time: 6:50 PM
 */

namespace ZfcUser\Factory\Controller;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Stdlib\DispatchableInterface;
use ZfcUser\Controller\RedirectCallback;
use ZfcUser\Controller\UserController;

class UserControllerFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     * @return DispatchableInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        /* @var RedirectCallback $redirectCallback */
        $redirectCallback = $container->get('zfcuser_redirect_callback');

        /* @var UserController $controller */
        $controller = new UserController($redirectCallback);
        $controller->setPluginManager($container->get(\Zend\Mvc\Controller\PluginManager::class));

        $controller->setChangeEmailForm($container->get('zfcuser_change_email_form'));
        $controller->setOptions($container->get('zfcuser_module_options'));
        $controller->setChangePasswordForm($container->get('zfcuser_change_password_form'));
        $controller->setLoginForm($container->get('zfcuser_login_form'));
        $controller->setRegisterForm($container->get('zfcuser_register_form'));
        $controller->setUserService($container->get('zfcuser_user_service'));

        return $controller;
    }
}
