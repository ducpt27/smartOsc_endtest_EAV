<?php
spl_autoload_register(function ($className) {

    $root = 'app/';
    $prefix = 'Mvc\\';

    // Remove prefix
    $classWithoutPrefix = preg_replace('/^' . preg_quote($prefix) . '/', '', $className);
    #app/Controllers/PageController.php

    // Replace \ to /
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $classWithoutPrefix) . '.php';

    $filePath = $root . $file;
    if (file_exists($filePath)) {
        require_once $filePath;
    }
});
?>