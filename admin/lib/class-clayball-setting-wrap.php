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
        echo '<div class="wrap"><h1>'.__('ClayBall Options', 'clayball-lang').'</h1><form method="post" action="options.php">';
    }

    public function NavInit()
    {
        $tabs    = $this->menuitem;
        $current = (!empty($_GET['page'])) ? esc_attr($_GET['page']) : '0';
        $html    = '<h2 class="nav-tab-wrapper">';
        foreach ($tabs as $tab => $name) {
            $class = ($tab == $current) ? 'nav-tab-active' : '';
            $html  .= '<a class="nav-tab ' . $class . '" href="?page=' . $tab . '">' . $name . '</a>';
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
