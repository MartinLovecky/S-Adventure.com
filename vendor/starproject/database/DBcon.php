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
        'DB_Name' => 'sadventurexf1329',
        'DB_User'=> 'sadventurexf1329',
        'DB_Password' => 'S#ie933z81g)Cs1#i-3d',
        'DB_Host' => 'sql5.webzdarma.cz' 
    ],
    'other' => [
        'Mail' => 'sa.suport@seznam.cz',
        'Char_Set' => 'utf8mb4']];
}