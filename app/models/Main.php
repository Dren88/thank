<?php

namespace app\models;

use RedBeanPHP\R;
use System\Model;

class Main extends Model
{
    protected static string $tableName = 'user';

    public function getAll()
    {

       return R::getAssoc("SELECT id, name FROM " . self::$tableName);
    }

    public function getCount($field_name = 'user_from_id')
    {
        $options = self::getOptions();
        return count(R::getALL("SELECT u.*, t.count, ud.department_id
        FROM user AS u
        LEFT JOIN (SELECT {$field_name}, COUNT(*) as count FROM `thank` {$options['date']} GROUP BY {$field_name}) AS t
        on u.id = t.{$field_name}
        LEFT JOIN user_department ud on u.id = ud.user_id
        {$options['department']}
        ORDER BY count DESC;"));
    }

    public function getCountThank($field_name = 'user_from_id')
    {
        $options = self::getOptions();
        $limit = 'LIMIT ' . PER_PAGE;
        if (isset($_GET['page'])){
            $offset = PER_PAGE * ($_GET['page'] - 1);
            $limit = "LIMIT " . PER_PAGE ." OFFSET {$offset}";
        }
        return R::getALL("SELECT u.*, t.count, ud.department_id
        FROM user AS u
        LEFT JOIN (SELECT {$field_name}, COUNT(*) as count FROM `thank` {$options['date']} GROUP BY {$field_name}) AS t
        on u.id = t.{$field_name}
        LEFT JOIN user_department ud on u.id = ud.user_id
        {$options['department']}
        ORDER BY count DESC {$limit}");
    }

    public static function getOptions() {
        $arParams = [];
        // по департаменту
        $arParams['department'] = (isset($_GET['department']) && $_GET['department']) ? " WHERE `department_id`='{$_GET['department']}'" : '';
        // по диапазону дат
        if (isset($_GET['start_date']) && $_GET['start_date']) $arParams['date'][] =  " `date`>='{$_GET['start_date']}'";
        if(isset($_GET['finish_date']) && $_GET['finish_date']) $arParams['date'][] = " `date`<='{$_GET['finish_date']}'";
        if(!empty($arParams['date'])){
            $arParams['date'] = " WHERE" . implode(' AND ', $arParams['date']);
        }else{
            $arParams['date'] = "";
        }
        return $arParams;
    }

}