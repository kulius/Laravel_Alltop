<?php

namespace App\Alltop\TablePlugin;

class AcadSSP extends SSP{

    static function getDbInfo(){
        $sql_details = array(
            'user' => env('DB_USERNAME', 'forge'),
            'pass' => env('DB_PASSWORD', ''),
            'db'   => env('DB_DATABASE', 'forge'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
        );
        return $sql_details;
    }
    
}