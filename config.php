<?php

if (! defined('_ROOT_DIR_')) {
    define('_ROOT_DIR_', __DIR__);
}
if (! defined('_VIEW_DIR_')) {
    define('_VIEW_DIR_', _ROOT_DIR_ . '/views/');
}
if (! defined('_MIGRATION_DIR_')) {
    define('_MIGRATION_DIR_', _ROOT_DIR_ . '/migrations/');
}
if (! defined('UrlPrefix')) {
    define('UrlPrefix', '/php-exe');
}
if (! defined('DB_USER')) {
    define('DB_USER', 'root');
}
if (! defined('DB_NAME')) {
    define('DB_NAME', 'php_exe');
}
if (! defined('DB_PWD')) {
    define('DB_PWD', '');
}
if (! defined('DB_HOST')) {
    define('DB_HOST', 'localhost');
}
if (! defined('DB_TYPE')) {
    define('DB_TYPE', 'mysql');
}
