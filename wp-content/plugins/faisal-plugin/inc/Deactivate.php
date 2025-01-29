<?php

/*
* Trigger this file on Plugin uninstall
*
* @package Faisalplugin
*/
namespace Inc;

class Deactivate{
    public static function deactivate(){
        flush_rewrite_rules();
    }

}