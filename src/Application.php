<?php namespace BitKit;

use League\Container\Container;
use League\Container\ServiceProvider;
use BitKit\Providers;

class Application
{
    protected $container;

    protected $corePath;

    protected $instancePath;

    protected $providers = [];

    public function __construct($instancePath)
    {
        $this->container = new Container();
        $this->instancePath = realpath($instancePath);
        $this->corePath = realpath(__DIR__ . '/..');

        $this->container['paths.commands'] = path($this->corePath, 'src/Core/Console/Commands');

        $this->registerServices();
    }

    protected function registerServices()
    {
        $this->register(new Providers\ConsoleProvider());
    }

    public function run()
    {
        // run the appropriate handler
        try {
            $handler = $this->isRunningInConsole() ? $this->container->make('prontotype.console') : $this->container->make('prontotype.http');
            return $handler->run();
        } catch (\Exception $e) {
            echo 'An application error has occured: ' . $e->getMessage();
        }
    }

    public function register(ServiceProvider $provider)
    {
        $container->addServiceProvider($provider);
    }

    public function isRunningInConsole()
    {
        return php_sapi_name() == 'cli';
    }

}