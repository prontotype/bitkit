<?php namespace BitKit\Pipeline\Pipe;

use BitKit\Support\Collection;

class NullPipe implements PipeInterface
{
    public function process(Collection &$data)
    {
        // do nothing
    }
}