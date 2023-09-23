<?php

namespace app\models;

use RedBeanPHP\R;
use System\Model;

class Department extends Model
{
    protected static string $tableName = 'department';

    public function getAll()
    {
       return R::getAll("SELECT * FROM " . self::$tableName);
    }

}