<?php


namespace System;


class App
{
    public static $app;

    /**
     * App constructor.
     * @throws \Exception
     * Ищем подходящий маршрут для выод
     */
    public function __construct()
    {
        $query = trim(urldecode($_SERVER['QUERY_STRING']), '/');
        Router::dispatch($query);
    }
}