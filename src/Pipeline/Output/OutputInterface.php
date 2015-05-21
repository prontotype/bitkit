<?php namespace BitKit\Pipeline\Output;

use BitKit\Support\Collection;

interface OutputInterface
{
    public function data(Collection $data);
}