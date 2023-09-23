<?php
use \System\Router;
Router::add('^/$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^user_to_id/$', ['controller' => 'Main', 'action' => 'getThanks']);

Router::add('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$');