<?php

namespace starproject\fundemation;

class Config{

// Setup by Selector class 
public $action = '';
public $article = '';
public $page = null;
public $url = [];
public $allowedAction = [];
public $allowedPages = [];
public $queryAction = '';
public $allowedAricles = [];

//User vars
public $memberID = '';
public $member = '';
public $logged = null;
public $userName = '';
public $userSurname = '';
public $avatar = ''; //String to storage location (url)
public $age  = ''; //can be string ?
public $location = null;

// Request AKA ROUTER
public $request = [];
public $viewData = [];
public $urlName = '';
public $subURL = '';

//Others vars used in application
public $AllBags = [];
public $title = '';

}