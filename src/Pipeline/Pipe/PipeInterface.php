<?php namespace BitKit\Pipeline\Pipe;

use BitKit\Support\Collection;

interface PipeInterface
{
    public function process(Collection &$data);
}