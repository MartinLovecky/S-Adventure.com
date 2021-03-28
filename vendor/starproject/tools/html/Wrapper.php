<?php

namespace starproject\tools\html;

use starproject\tools\Selector;

class Wrapper {
    public $status;
    private $_selector;

    public function __construct(Selector $selector){
        $this->_selector = $selector;
 
    }
    public function prev_page(){
        $prev = $this->_selector->page - 1;
        if($this->_selector->page <= 1 || $this->_selector->page >= 300){
            return '<li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>';
        }
            return '<li class="page-item"><a class="page-link" href="/'.$this->_selector->action.'/'.$this->_selector->article.'/'.$prev.'#wp_pagnation" aria-label="Previous"><span aria-hidden="true">«</span></a></li>';
    }
    public function main_pagnation(){
        $range = 5;
        $totalpages = 300;
        for ($x = ($this->_selector->page - $range); $x < (($this->_selector->page + $range) + 1); $x++) {
            if (($x > 0) && ($x <= $totalpages)) {
                $active = ($this->_selector->page == $x) ? 'active': null;
                    echo '<li class="page-item '.$active.' "><a class="page-link" href="/'.$this->_selector->action.'/'.$this->_selector->article.'/'.$x.'#wp_pagnation">'.$x.'</a></li>';
            }
         } 

    }
    public function next_page(){
        $next = $this->_selector->page + 1;
        if($this->_selector->page < 1 || $this->_selector->page >= 300){
            return '<li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">»</span></a></li>';
        }
            return '<li class="page-item"><a class="page-link" href="/'.$this->_selector->action.'/'.$this->_selector->article.'/'.$next.'#wp_pagnation" aria-label="Previous"><span aria-hidden="true">»</span></a></li>';
    }
}