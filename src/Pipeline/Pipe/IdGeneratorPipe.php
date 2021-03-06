<?php namespace BitKit\Pipeline\Pipe;

use BitKit\Support\Collection;

class IdGeneratorPipe implements PipeInterface
{
    public function process(Collection &$data)
    {
        $data->each(function($item){
            $item['id'] = $item->get('id', function() use ($item) {
                return $item['rel_pathname'];
            });
        });
    }
}