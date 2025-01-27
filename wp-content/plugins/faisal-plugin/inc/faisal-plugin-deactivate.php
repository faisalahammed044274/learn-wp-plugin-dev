<?php

/*
* Trigger this file on Plugin uninstall
*
* @package Faisalplugin
*/

class FaisalPluginDeactivate{
    public static function deactivate(){
        flush_rewrite_rules();
    }

}