<?php
/*
 * PSR-0 Autoload
 */

function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
    if (!file_exists(ABSPATH . DIRECTORY_SEPARATOR . $fileName))
        die("<h1>Unable to load $className</h1>");

    require_once($fileName);
}

/*
 * Register PSR-0 Autoload
 */
spl_autoload_register('autoload');