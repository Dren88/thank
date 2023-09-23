<?php

namespace System;

use RedBeanPHP\R;

class View
{
    public string $content = '';

    public function __construct(
        public $route,
        public $layout = '',
        public $view = '',
    )
    {
        if(false !== $this->layout){
            $this->layout = $this->layout ?: LAYOUT;
        }
    }

    public function render($data)
    {
        if(is_array($data)){
            extract($data);
        }
        $view_file = APP . "/views/{$this->route['controller']}/{$this->view}.php";
        if(is_file($view_file)){
            ob_start();
            require_once $view_file;
            $this->content = ob_get_clean();
        }
        else{
            throw new \Exception("Не найден вид {$view_file}", 500);
        }

        if(false !== $this->layout){
            $layout_file = APP . "/views/layouts/{$this->layout}.php";
            if(is_file($layout_file)){
                require_once $layout_file;
            }else{
                throw new \Exception("Не найден шаблон {$layout_file}", 500);
            }
        }
    }

    public function getPart($file, $data = null)
    {
        if(is_array($data)){
            extract($data);
        }
        $file = APP . "/views/{$file}.php";
        if(is_file($file)){
            require $file;
        }else{
            echo "File {$file} not found...";
        }
    }    
}
