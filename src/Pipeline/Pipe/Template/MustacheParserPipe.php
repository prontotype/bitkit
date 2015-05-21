<?php namespace BitKit\Pipeline\Pipe\Template;

use Mustache_Engine as Mustache;
use BitKit\Support\Collection;

class MustacheParserPipe extends AbstractTemplateParserPipe
{
    protected $accept = ['mustache','html'];

    protected function parse($content, $item, $context)
    {
        $m = new Mustache;
        return $m->render($content, $this->data($item, $context));
    }
}