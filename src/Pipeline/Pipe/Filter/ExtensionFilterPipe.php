<?php namespace BitKit\Pipeline\Pipe\Filter;

use BitKit\Pipeline\Item\ItemInterface;
use BitKit\Pipeline\Pipe\PipeInterface;
use BitKit\Support\Collection;

class ExtensionFilterPipe extends AbstractFilterPipe
{
    /** @var array */
    protected $ext;

    public function __construct($ext)
    {
        $this->ext = $ext;
    }

    public function check(ItemInterface $item)
    {
        return $this->matches($item->get('extension'), $this->ext);
    }
}