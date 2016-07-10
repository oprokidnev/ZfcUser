<?php

namespace ZfcUser\Factory\Form;

use Interop\Container\ContainerInterface;
use Zend\Form\FormElementManager;
use Zend\ServiceManager\Factory\FactoryInterface;
use ZfcUser\Form;

class Login implements FactoryInterface
{
    /**
     * Create service
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     * @return Form\LoginFilter
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $fem = $container->get('FormElementManager');

        /** @var FormElementManager $formElementManager */
        $options = $container->get('zfcuser_module_options');
        $form = new Form\Login(null, $options);
        // Inject the FormElementManager to support custom FormElements
        $form->getFormFactory()->setFormElementManager($fem);

        $form->setInputFilter(new Form\LoginFilter($options));

        return $form;
    }
}
