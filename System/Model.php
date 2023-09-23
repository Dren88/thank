<?php


namespace System;


use RedBeanPHP\R;

abstract class Model
{

    public function __construct()
    {
        Db::getInstance();
    }
}