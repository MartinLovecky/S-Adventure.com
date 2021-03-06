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
        'DB_Name' => 'sadventurexf3912',
        'DB_User'=> 'sadventurexf3912',
        'DB_Password' => 'RwVhYnnJGrT^Ax,fH60V',
        'DB_Host' => 'sql5.webzdarma.cz' 
    ],
    'other' => [
        'Mail' => 'sa.suport@seznam.cz',
        'Char_Set' => 'utf8mb4']];
}