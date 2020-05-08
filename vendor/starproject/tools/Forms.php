<?php

namespace starproject\tools;

use eftec\bladeone\BladeOne;

class Forms{

    private $_blade;

    public function __construct(BladeOne $blade){
        $this->_blade = $blade;
    }

    public function create(array $options){
        $clases = (isset($options['class'])) ? 'class="'.$options['class'].'"' :'class="text-center"';
        $method = (isset($options['method'])) ? 'method="'.$options['method'].'"': 'method="GET"';
        $target =  (isset($options['target'])) ? $options['target']  : ' target="_self"'; 
        $autocomplete = (isset($options['autocomplete'])) ? 'autocomplete="'.$options['autocomplete'].'"'  : 'autocomplete="off"';
        $enctype = (isset($options['enctype'])) ? 'enctype="'.$options['enctype'].'"'  : 'enctype="url-encoded"';
        return '<form '.$method.' target="'.$this->_blade->run($target[0],$target[1]).'" '.$clases.' '.$autocomplete.' '.$enctype.'>';
    }

    public function close(){
            return '</form>';
    }
}