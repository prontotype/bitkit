<?php namespace BitKit\Pipeline\Pipe\Template;

use BitKit\Pipeline\Pipe\PipeInterface;
use BitKit\Support\Collection;

abstract class AbstractTemplateParserPipe implements PipeInterface
{
    /** @var array */
    protected $accept = [];

    /** @var array */
    protected $globals;

    public function __construct($globals = [])
    {
        $this->globals = $globals;
    }

    abstract protected function parse($content, $item, $context);

    public function process(Collection &$data)
    {
        $data->each(function($item, $key) use ($data) {
            if ($this->filter($item)) {
                $item->set('content', $this->parse($item->get('content'), $item, $data));
            }
        });
    }

    protected function data($item, $context)
    {
        $data = array_merge([], $this->globals, $item->toArray());
        // $data['context'] = $context->toArray();
        $data['self'] = $item->toArray();
        return $data;
    }

    protected function filter($item)
    {
        return in_array($item->get('extension'), $this->accept);
    }
}