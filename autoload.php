<?php

//自动加载
spl_autoload_register(function ($class_name) {

    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);

    $file_name  = __DIR__ . '/src/' . $path . '.php';

    if (file_exists($file_name)) {
        require_once $file_name;
    }

});
