<?php namespace BitKit\Providers;

use RegexIterator;
use RecursiveIteratorIterator;
use RecursiveRegexIterator;
use RecursiveDirectoryIterator;
use Amu\Sup\Arr;
use Elf\Console;
use Elf\Output;
use League\Container\ServiceProvider;

class ConsoleProvider extends ServiceProvider
{
    protected $provides = [
        'console',
    ];

    public function register()
    {
        $c = $this->getContainer();
        $c->singleton('console', function () use ($c) {

            $console = new Console();
            $console->setOutputHandler(new Output());

            $files = new RegexIterator(
                new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($c['paths.commands'])
                ), '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);

            $commandFiles = Arr::pluck(iterator_to_array($files), 0);

            foreach ($commandFiles as $file) {
                $pathinfo = pathinfo($file);
                $className = 'BitKit\Console\Commands' . str_replace([$c['paths.commands'], '/'], ['', '\\'], $pathinfo['dirname']) . '\\' . $pathinfo['filename'];
                $console->addCommand(new $className($c));
            }

            return $console;
        });
    }
}
