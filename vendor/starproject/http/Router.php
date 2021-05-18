<?php

namespace starproject\http;

class Router
{
    private object $_selector;
    private object $_blade;

    public function __construct(public $data)
    {
        $this->data;
        $this->_selector = $this?->data['selector'];
        $this->_blade = $this?->data['blade'];
    }

    public function runApp()
    {
        if ($this->_selector->allowedView()) {
            return $this->_blade->run('pages.'.$this->_selector->viewName(), $this->data);
        }
        return $this->_blade->run('pages.404', $this->data);
    }

    public static function redirect($location = null)
    {
        if ($location) {
            if (is_numeric($location)) {
                switch ($location) {
                case 404:
                    header('HTTP/1.0 404 Not Found');
                    include(DIR.'/views/pages/404.balde.php');
                    die();
                break;
            }
            }
            header('Location: http://sadventure.com/'.$location.'');
        }
    }
}
