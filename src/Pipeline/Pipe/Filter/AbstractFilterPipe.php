<?php namespace BitKit\Pipeline\Pipe\Filter;

use BitKit\Pipeline\Item\ItemInterface;
use BitKit\Pipeline\Pipe\PipeInterface;
use BitKit\Support\Collection;

abstract class AbstractFilterPipe implements PipeInterface
{
    public function process(Collection &$data)
    {
        $data = $data->get('files', new Collection())->filter(function($item){
            return $this->check($item);
        });
    }

    public function matches($value, $test)
    {
        $opts = array_map(function($val){
            return strtolower($val);
        }, explode('|', $test));
        return in_array($value, $opts);
    }

    abstract public function check(ItemInterface $item);
}