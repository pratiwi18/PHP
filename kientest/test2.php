<?php

function my_autoloader($class)
{
    include 'lib/' . $class . '.php';
}

spl_autoload_register('my_autoloader');

echo Model::show() . "<br/>";
echo View::show() . "<br/>";
echo Controller::show() . "<br/>";

$pwd = password_hash("kien",PASSWORD_BCRYPT);

echo $pwd ."<br/>";

echo var_dump(password_verify("kien", '$2y$10$eAeoMHKdWfcUHMMClhleBebQOSpX2hjF1DYtIkQC98F6zPez1Cyty' ));

/*
include("../includes/path_generator.php");

$obj = new path_generator();
echo $obj->test();*/