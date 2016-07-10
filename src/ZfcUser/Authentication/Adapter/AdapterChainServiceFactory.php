<?php
namespace ZfcUser\Authentication\Adapter;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use ZfcUser\Authentication\Adapter\AdapterChain;
use ZfcUser\Authentication\Adapter\Exception\OptionsNotFoundException;
use ZfcUser\Options\ModuleOptions;

class AdapterChainServiceFactory implements FactoryInterface
{

    /**
     * @var ModuleOptions
     */
    protected $options;

    /**
     * Create service
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     * @return AdapterChain
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $chain = new AdapterChain();

        $options = $this->getOptions($container);

        //iterate and attach multiple adapters and events if offered
        foreach ($options->getAuthAdapters() as $priority => $adapterName) {
            $adapter = $container->get($adapterName);

            if (is_callable(array($adapter, 'authenticate'))) {
                $chain->getEventManager()->attach('authenticate', array($adapter, 'authenticate'), $priority);
            }

            if (is_callable(array($adapter, 'logout'))) {
                $chain->getEventManager()->attach('logout', array($adapter, 'logout'), $priority);
            }
        }

        return $chain;
    }


    /**
     * set options
     *
     * @param ModuleOptions $options
     * @return AdapterChainServiceFactory
     */
    public function setOptions(ModuleOptions $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * get options
     *
     * @param ContainerInterface $serviceLocator (optional) Service Locator
     * @return ModuleOptions $options
     * @throws OptionsNotFoundException If options tried to retrieve without being set but no SL was provided
     */
    public function getOptions(ContainerInterface $container = null)
    {
        if (!$this->options) {
            if (!$container) {
                throw new OptionsNotFoundException(
                    'Options were tried to retrieve but not set ' .
                    'and no service locator was provided'
                );
            }

            $this->setOptions($container->get('zfcuser_module_options'));
        }

        return $this->options;
    }
}
