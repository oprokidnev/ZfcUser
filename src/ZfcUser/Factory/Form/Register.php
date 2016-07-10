<?php

namespace ZfcUser\Factory\Form;

use Interop\Container\ContainerInterface;
use Zend\Form\FormElementManager;
use Zend\ServiceManager\Factory\FactoryInterface;
use ZfcUser\Form;
use ZfcUser\Validator;

class Register implements FactoryInterface
{
    
    /**
     * Create service
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     * @return Form\RegisterFilter
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $fem = $container->get('FormElementManager');

        $options = $container->get('zfcuser_module_options');
        $form = new Form\Register(null, $options);
        // Inject the FormElementManager to support custom FormElements
        $form->getFormFactory()->setFormElementManager($fem);

        //$form->setCaptchaElement($sm->get('zfcuser_captcha_element'));
        $form->setHydrator($container->get('zfcuser_register_form_hydrator'));
        $form->setInputFilter(new Form\RegisterFilter(
            new Validator\NoRecordExists(array(
                'mapper' => $container->get('zfcuser_user_mapper'),
                'key'    => 'email'
            )),
            new Validator\NoRecordExists(array(
                'mapper' => $container->get('zfcuser_user_mapper'),
                'key'    => 'username'
            )),
            $options
        ));

        return $form;
    }
}
