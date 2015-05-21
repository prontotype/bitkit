<?php namespace BitKit\Pipeline;

use BitKit\Pipeline\Input\DirectoryInput;
use BitKit\Pipeline\Input\InputInterface;
use BitKit\Pipeline\Output\DirectoryOutput;
use BitKit\Pipeline\Output\OutputInterface;
use BitKit\Pipeline\Pipe\PipeInterface;
use BitKit\Support\Collection;
use BitKit\Pipeline\Pipe;

class Pipeline implements \IteratorAggregate
{
    /** @var string */
    protected $input;

    /** @var array */
    protected $data;

    protected $defaultPipes = [
        'BitKit\Pipeline\Pipe\YamlFrontMatterPipe',
        'BitKit\Pipeline\Pipe\IdGeneratorPipe',
        'BitKit\Pipeline\Pipe\TitleGeneratorPipe'
    ];

    public function __construct($input)
    {
        $this->input = $input instanceof InputInterface ? $input : new DirectoryInput($input);
        $this->data = $this->input->data();
        $this->processDefaultPipes();
    }

    public function pipe($pipe)
    {
        if (! $pipe instanceof PipeInterface) {
            $pipe = new $pipe();
        }
        $pipe->process($this->data);
        return $this;
    }

    public function data()
    {
        return $this->data;
    }

    public function merge(Pipeline $pipeline)
    {
        $this->data->merge($pipeline->data());
        return $this;
    }

    public function output($output)
    {
        $output = $output instanceof OutputInterface ? $output : new DirectoryOutput($output);
        $output->data($this->data);
        return $this;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->data->toArray());
    }

    protected function processDefaultPipes()
    {
        foreach($this->defaultPipes as $pipe) {
            $this->pipe($pipe);
        }
    }

}