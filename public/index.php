<?php

/**
 * Подключаем системные файлы
 */
require_once dirname(__DIR__) . '/config/init.php';
require_once CONFIG . '/routes.php';

/**
 * Подключаем класс ядра проекта
 */
new \System\App();
