<?php

$test = "abc";

class TestCls
{
    public function get_things()
    {
        global $test;

        return $test;
    }
}

$obj = new TestCls();

//echo $obj->get_things();
?>