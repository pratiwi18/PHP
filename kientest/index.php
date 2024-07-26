<?php
ini_set('display_errors', 1);
error_reporting(-1);

function my_autoloader($class)
{
    include $_SERVER['DOCUMENT_ROOT'] . '/coach_assistant/kientest/lib/' . $class . '.php';
}

spl_autoload_register('my_autoloader');

echo model::show() . "<br/>";
echo view::show() . "<br/>";
echo controller::show() . "<br/>";
