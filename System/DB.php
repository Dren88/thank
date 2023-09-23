<?php

namespace System;
use RedBeanPHP\R;

class DB
{
    private static ?self $instance = null;

    public static function getInstance(): static
    {
        return static::$instance ?? static::$instance = new static();
    }

    private function __construct()
    {
        $db = require_once CONFIG . '/confg_db.php';
        R::setup($db['dsn'], $db['user'], $db['password']);
        if(!R::testConnection()){
            throw new \Exception('No connection to DB', 500);
        }
        R::freeze(true);
        R::ext('xdispense', function( $type ){
            return R::getRedBean()->dispense( $type );
        });
    }
}