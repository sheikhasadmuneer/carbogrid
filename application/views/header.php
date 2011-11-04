<div id="header">
    <div style="position:absolute;top:0;right:0;margin: 20px;text-align:right;">
        <select name="change_theme" id="change_theme">
            <option value="<?php echo base_url(); ?>css/carbo/jquery-ui-1.8.13.custom.css" selected="selected">Original CarboGrid Theme</option>
            <option value="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/base/jquery-ui.css">Smoothness</option>
            <option value="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/ui-lightness/jquery-ui.css">UI Lightness</option>
            <option value="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/ui-darkness/jquery-ui.css">UI Darkness</option>
            <option value="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/start/jquery-ui.css">Start</option>
            <option value="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/redmond/jquery-ui.css">Redmond</option>
            <option value="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/sunny/jquery-ui.css">Sunny</option>
            <option value="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/humanity/jquery-ui.css">Humanity</option>
        </select>
    </div>
    <div id="logo">
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td><div class="b"></div></td>
                <td><div class="c"></div></td>
                <td><div class="c"></div></td>
                <td><div class="c"></div></td>
                <td><div class="b"></div></td>
                <td><div class="b"></div></td>
                <td><div class="b"></div></td>
                <td><div class="b"></div></td>
            </tr>
            <tr>
                <td><div class="c"></div></td>
                <td><div class="b"></div></td>
                <td><div class="b"></div></td>
                <td><div class="b"></div></td>
                <td><div class="b"></div></td>
                <td><div class="g"></div></td>
                <td><div class="g"></div></td>
                <td><div class="g"></div></td>
            </tr>
            <tr>
                <td><div class="c"></div></td>
                <td><div class="b"></div></td>
                <td><div class="b"></div></td>
                <td><div class="b"></div></td>
                <td><div class="g"></div></td>
                <td><div class="b"></div></td>
                <td><div class="b"></div></td>
                <td><div class="b"></div></td>
            </tr>
            <tr>
                <td><div class="c"></div></td>
                <td><div class="b"></div></td>
                <td><div class="b"></div></td>
                <td><div class="b"></div></td>
                <td><div class="g"></div></td>
                <td><div class="b"></div></td>
                <td><div class="g"></div></td>
                <td><div class="g"></div></td>
            </tr>
            <tr>
                <td><div class="b"></div></td>
                <td><div class="c"></div></td>
                <td><div class="c"></div></td>
                <td><div class="c"></div></td>
                <td><div class="g"></div></td>
                <td><div class="b"></div></td>
                <td><div class="b"></div></td>
                <td><div class="g"></div></td>
            </tr>
            <tr>
                <td><div class="b"></div></td>
                <td><div class="b"></div></td>
                <td><div class="b"></div></td>
                <td><div class="b"></div></td>
                <td><div class="b"></div></td>
                <td><div class="g"></div></td>
                <td><div class="g"></div></td>
                <td><div class="g"></div></td>
            </tr>
        </table>
    </div>
    <div id="slogan">
        Light as a Feather, Solid as Steel
    </div>
    <div id="menu">
        <ul>
            <li><?php echo anchor('home', 'Home', preg_match('/(^\/home)|(^$)/i', $this->uri->uri_string()) ? 'class="active"' : ''); ?></li>
            <li><?php echo anchor('sample/single', 'Single grid', preg_match('/(^\/sample\/single)/i', $this->uri->uri_string()) ? 'class="active"' : ''); ?></li>
            <li><?php echo anchor('sample/multiple', 'Multiple grids', preg_match('/(^\/sample\/multiple)/i', $this->uri->uri_string()) ? 'class="active"' : ''); ?></li>
        </ul>
        <div class="cg-clear"></div>
    </div>
    <div class="cg-clear"></div>

    <div id="menu-bottom"></div>
</div>
