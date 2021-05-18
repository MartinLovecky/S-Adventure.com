<?php

namespace starproject\tools;

use starproject\tools\Sanitazorx;

class Selector
{
    private $_sanitazor;
    public $message;
    public $action;
    public $article;
    public $page = null;
    public $url = [];
    public $allowedAction = [];
    public $allowedPages = [];
    public $queryAction;
    public $allowedAricles = [];
    public $resetPWD;
    
    public function __construct(Sanitazorx $sanitazor)
    {
        $this->_sanitazor = $sanitazor;
        $this->url = explode('/', trim(str_replace(['-','_','#','<','(','{','!',','], ' ', urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)))));
        $this->action = lcfirst($sanitazor->sanitaze($this->url[1])); // this is set all time
        $this->article = (isset($this->url[2])) ? lcfirst($sanitazor->sanitaze($this->url[2])) : null;
        $this->page = (isset($this->url[3])) ? $this->url[3]: null;
        $this->allowedAction = include(DIR . '/core/app/allowedAction.php'); // array of pages
        $this->allowedAricles = ['allwin','samuel','isama','isamanh','isamanw','angel','mry','star','terror','demoni','hyperion'];
        $this->allowedPages = [range(1, 300)];
        $this->queryAction = $sanitazor->sanitaze_GET('action');
        $this->resetPWD = $sanitazor->sanitaze_GET('x');
    }

    public function title()
    {
        if ($this->action === '' || $this->action === 'index') {
            return 'SA | Home';
        } elseif ($this->action === 'show') {
            return $this->article.'-'.$this->page;
        }
        return 'SA | '.ucfirst($this->action);
    }

    public function allowedView()
    {
        // return true false
        if (in_array($this->action, $this->allowedAction)) {
            return true;
        }
        return false;
    }

    public function viewName()
    {
        if ($this->allowedView()) {
            if ($this->action == '') {
                return 'index';
            }
            if ($this->action == 'show' && isset($this->article)) {
                return 'article';
            }
            if ($this->action == 'show' && !isset($this->article)) {
                return 'roster';
            }
            if ($this->action == 'create' || $this->action == 'update' || $this->action == 'delete') {
                return 'editor';
            }
            if ($this->action == 'member') {
                return 'members';
            }
            if ($this->action == 'member' && isset($this->article)) {
                return 'profile';
            }
            return $this->action;
        }
        return '404';
    }
}
