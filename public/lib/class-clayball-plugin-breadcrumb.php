<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 2019/6/12
 * Time: 14:58
 */

class ClassClayballPluginBreadcrumb
{
    public $option;

    public function __construct()
    {
        $this->option = array(
            'wrap_before' => $this->getNormalWrapbeforeTemplate(),
            'wrap_after' => $this->getNormalWrapafterTemplate(),
        );
    }

    static public function getNormalWrapbeforeTemplate()
    {
        $warpbefore_default = '<nav aria-label="breadcrumb" typeof="Breadcrumb"><ol class="breadcrumb">';
        $warpbefore_default = (get_option('clayballsetting_breadcrumb_warpbefore')==FALSE)?$warpbefore_default:esc_attr(get_option('clayballsetting_breadcrumb_warpbefore'));

        return $warpbefore_default;
    }

    static public function getNormalWrapafterTemplate()
    {
        $warpafter_default  = '</ol></nav>';
        $warpafter_default  = (get_option('clayballsetting_breadcrumb_warpafter')==FALSE)?$warpafter_default:esc_attr(get_option('clayballsetting_breadcrumb_warpafter'));
        return $warpafter_default;
    }


}