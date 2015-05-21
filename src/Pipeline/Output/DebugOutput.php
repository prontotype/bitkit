<?php namespace BitKit\Pipeline\Output;

use BitKit\Support\Collection;

class DebugOutput implements OutputInterface
{
    public function data(Collection $data)
    {
        echo '<pre>';
        print_r($data->toArray());
        echo '</pre>';
    }
}
