<?php

namespace starproject\database;

class DBcon{

    public $config =[
    'localhost' =>[
        'DB_Name' => 'test',
        'DB_User'=> 'root',
        'DB_Password' => null,
        'DB_Host' => 'localhost' 
    ],
    'development' => [
        'DB_Name' => null,
        'DB_User'=> null,
        'DB_Password' => 'password',
        'DB_Host' => 'sql2.webzdarma.cz' 
    ],
    'public' => [
        'DB_Name' => 'staradventur5548',
        'DB_User'=> 'staradventur5548',
        'DB_Password' => 'd0TIkMY',
        'DB_Host' => 'sql2.webzdarma.cz' 
    ],
    'other' => [
        'Mail' => 'sa.suport@seznam.cz',
        'Char_Set' => 'utf8mb4']];

    public $stateMode = 'public';
    public $version = 'dev';
}