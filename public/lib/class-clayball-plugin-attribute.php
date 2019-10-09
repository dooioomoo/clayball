<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 2019/6/12
 * Time: 14:58
 */

class ClassClayballPluginAttribute
{
    public $option;

    public function __construct()
    {
        $clayballsetting_attribute_posttype = (array)get_option('clayballsetting_attribute_posttype' , []);
        $clayballsetting_attribute_value    = (array)get_option('clayballsetting_attribute_value' , []);

        var_dump($clayballsetting_attribute_posttype);
        var_dump($clayballsetting_attribute_value);
    }


}