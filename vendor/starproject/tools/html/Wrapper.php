<?php

namespace starproject\tools\html;

use starproject\tools\Selector;

class Wrapper {

    //adds nav-link active if link is active to <a>
    public $status = null,
           $items = [];
    private $_selector;

    public function __construct(Selector $selector){
        $this->_selector = $selector;    
    }

    public function menuItem(array $items){
        foreach ($variable as $key => $value) {
            //$wrapper->menu(['name'=>'Angel & Eklips','status'=>'active']);
        /** Selector
         * $this->article
         * $this->page
         */
        # <a class="dropdown-item text-center" role="presentation" href="/show/aeg/1"><strong>Angel & Eklips</strong></a>
        }
    }
}