<?php 

/**
 * Trigger this file on Plugin uninstall
 * 
 * @package Faisalplugin
 */

class FaisalPluginActivate{
    public static function activate(){
        flush_rewrite_rules();
    }

}