<?php

namespace starproject\fundemation;

class Config{

// Setup by Selector class 
public $action = '';
public $article = '';
public $page = int;
public $url = [];
public $allowedAction = [];
public $allowedPages = [];
public $queryAction = '';

//User vars
public $memberID = '';
public $member = '';
public $logged = null;
public $userName = '';
public $userSurname = '';
public $avatar = ''; //String to storage location (url)
public $age  = ''; //can be string ?
public $location = null;

}