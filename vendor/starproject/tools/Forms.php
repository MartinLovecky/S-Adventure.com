<?php

namespace starproject\tools;

use eftec\bladeone\BladeOne;

class Forms{

    public  $clases,$method,$target,$autocomplete,$enctype;

    public function options(array $options){
        $this->clases = (isset($options['class'])) ? 'class="'.$options['class'].'"' :'class="text-center"';
        $this->method = (isset($options['method'])) ? 'method="'.$options['method'].'"': 'method="GET"';
        $this->target = (isset($options['target'])) ? $options['target']  : ' target="_self"'; 
        $this->autocomplete = (isset($options['autocomplete'])) ? 'autocomplete="'.$options['autocomplete'].'"'  : 'autocomplete="off"';
        $this->enctype = (isset($options['enctype'])) ? 'enctype="'.$options['enctype'].'"'  : 'enctype="url-encoded"';
            return $this;
    }
    public function open(BladeOne $blade){
        if(isset($this->target)){
            return trim('<form '.$this->method.' target="'.$blade->run($this->target[0],$this->target[1]).'" '.$this->clases.' '.$this->autocomplete.' '.$this->enctype.'>');
        }
            return 'Target must be set : \'target\' => [folder.file,[POST DATA]]';
    }
    public function close(){
            return '</form>';
    }
}