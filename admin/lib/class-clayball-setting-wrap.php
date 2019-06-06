<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 2019/6/5
 * Time: 16:45
 */

class ClassClayballSettingWrap
{
    public $menuitem;
    public $currentItem;

    public function __construct($menuitem = array())
    {
        $this->menuitem = $menuitem;
        $this->regSection = 'ClayballSetting';
    }
    public function ReturnRegSection(){
        return $this->regSection;
    }
    public function ReturnMenu()
    {
        return $this->menuitem;
    }

    public function HeaderInit()
    {
        echo '<div class="wrap"><h1 id="clayball-setting-title" style="padding: 20px;
    background: #fff;
    border-radius:10px;
    font-weight: 900;
    box-shadow: 1px 1px 10px rgba(0,0,0,.1);
    /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#ffffff+0,f3f3f3+50,ededed+51,ffffff+100;White+Gloss+%232 */
background: rgb(255,255,255); /* Old browsers */
background: -moz-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(243,243,243,1) 50%, rgba(237,237,237,1) 51%, rgba(255,255,255,1) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(243,243,243,1) 50%,rgba(237,237,237,1) 51%,rgba(255,255,255,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom, rgba(255,255,255,1) 0%,rgba(243,243,243,1) 50%,rgba(237,237,237,1) 51%,rgba(255,255,255,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'#ffffff\', endColorstr=\'#ffffff\',GradientType=0 ); /* IE6-9 */
    margin: 20px 0;">'.__('ClayBall', 'clayball-lang').'</h1><form method="post" action="options.php">';
    }

    public function NavInit()
    {
        $tabs    = $this->menuitem;
        $current = (!empty($_GET['page'])) ? esc_attr($_GET['page']) : '0';
        $html    = '<h2 class="nav-tab-wrapper">';
        foreach ($tabs as $tab => $name) {
            $class = ($tab == $current) ? 'nav-tab-active' : '';
            $html  .= '<a class="nav-tab ' . $class . '" href="?page=' . $tab . '">' . __($name,'clayball-lang') . '</a>';
        }
        $html .= '</h2>';
        echo $html;
    }

    public function FooterInit()
    {
        echo '<br/><br/>';
        submit_button();
        echo '</form>';
        echo '</div>';
    }

}
