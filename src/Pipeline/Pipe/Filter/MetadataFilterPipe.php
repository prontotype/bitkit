<?php namespace BitKit\Pipeline\Pipe\Filter;

use BitKit\Pipeline\Item\ItemInterface;
use BitKit\Pipeline\Pipe\PipeInterface;
use BitKit\Support\Collection;

class MetadataFilterPipe extends AbstractFilterPipe
{
    /** @var array */
    protected $value;

    protected $key;

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;    
    }

    public function check(ItemInterface $item)
    {
        return $this->matches($item->get('metadata.' . $this->key, false), $this->value);
    }
}