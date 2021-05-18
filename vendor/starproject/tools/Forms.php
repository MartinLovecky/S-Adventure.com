<?php

namespace starproject\tools;

use eftec\bladeone\BladeOne;

class Forms
{
    public $clases;
    public $method;
    public $target;
    public $autocomplete;
    public $enctype;

    public function create(array $options)
    {
        $this->clases = (isset($options['class'])) ? 'class="'.$options['class'].'"' :'class="text-center"';
        $this->method = (isset($options['method'])) ? 'method="'.$options['method'].'"': 'method="GET"';
        $this->target =  (isset($options['target'])) ? $options['target']  : [];
        $this->autocomplete = (isset($options['autocomplete'])) ? 'autocomplete="'.$options['autocomplete'].'"'  : 'autocomplete="off"';
        $this->enctype = (isset($options['enctype'])) ? 'enctype="'.$options['enctype'].'"'  : 'enctype="url-encoded"';
        return $this;
    }

    public function run(BladeOne $blade)
    {
        if (!empty($this->target)) {
            return '<form '.$this->method.' target="'.$blade->run($this->target[0], $this->target[1]).'" '.$this->clases.' '.$this->autocomplete.' '.$this->enctype.'>';
        }
        return null;
    }
}
