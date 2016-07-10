<?php

namespace ZfcUser\Factory\Form;

use Interop\Container\ContainerInterface;
use Zend\Form\FormElementManager;
use Zend\ServiceManager\Factory\FactoryInterface;
use ZfcUser\Form;
use ZfcUser\Validator;

class ChangeEmail implements FactoryInterface
{
    
    /**
     * Create service
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     * @return Form\ChangeEmail
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $fem = $container->get('FormElementManager');

        $options = $container->get('zfcuser_module_options');
        $form = new Form\ChangeEmail(null, $options);
        // Inject the FormElementManager to support custom FormElements
        $form->getFormFactory()->setFormElementManager($fem);

        $form->setInputFilter(new Form\ChangeEmailFilter(
            $options,
            new Validator\NoRecordExists(array(
                'mapper' => $container->get('zfcuser_user_mapper'),
                'key'    => 'email'
            ))
        ));

        return $form;
    }
}
