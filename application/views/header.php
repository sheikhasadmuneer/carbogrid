<div id="header">
    <div class="container_12">
        <div id="logo">
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="c">&nbsp;</div></td>
                    <td><div class="c">&nbsp;</div></td>
                    <td><div class="c">&nbsp;</div></td>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="b">&nbsp;</div></td>
                </tr>
                <tr>
                    <td><div class="c">&nbsp;</div></td>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="g">&nbsp;</div></td>
                    <td><div class="g">&nbsp;</div></td>
                    <td><div class="g">&nbsp;</div></td>
                </tr>
                <tr>
                    <td><div class="c">&nbsp;</div></td>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="g">&nbsp;</div></td>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="b">&nbsp;</div></td>
                </tr>
                <tr>
                    <td><div class="c">&nbsp;</div></td>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="g">&nbsp;</div></td>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="g">&nbsp;</div></td>
                    <td><div class="g">&nbsp;</div></td>
                </tr>
                <tr>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="c">&nbsp;</div></td>
                    <td><div class="c">&nbsp;</div></td>
                    <td><div class="c">&nbsp;</div></td>
                    <td><div class="g">&nbsp;</div></td>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="g">&nbsp;</div></td>
                </tr>
                <tr>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="b">&nbsp;</div></td>
                    <td><div class="g">&nbsp;</div></td>
                    <td><div class="g">&nbsp;</div></td>
                    <td><div class="g">&nbsp;</div></td>
                </tr>
            </table>
        </div>
        <div id="slogan">
            Light as a Feather.<br/> Solid as Steel.
        </div>

        <div class="cg-right">
            <div style="height:40px;padding:20px 20px 0 0;float:right;">
                <select name="change_theme" id="change_theme">
                    <option value="<?php echo base_url(); ?>css/carbo/jquery-ui-1.8.16.custom.css" selected="selected">Original CarboGrid Theme</option>
                    <option value="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/base/jquery-ui.css">Smoothness</option>
                    <option value="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/ui-lightness/jquery-ui.css">UI Lightness</option>
                    <option value="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/ui-darkness/jquery-ui.css">UI Darkness</option>
                    <option value="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/start/jquery-ui.css">Start</option>
                    <option value="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/redmond/jquery-ui.css">Redmond</option>
                    <option value="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/sunny/jquery-ui.css">Sunny</option>
                    <option value="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/humanity/jquery-ui.css">Humanity</option>
                </select>
            </div>
            <div class="cg-clear"></div>
            <div id="menu">
                <ul>
                    <li><?php echo anchor('sample/home', 'Home', preg_match('/(^\/sample\/home)|(^$)/i', $this->uri->uri_string()) ? 'class="active"' : ''); ?></li>
                    <li><?php echo anchor('sample/single', 'Single grid', preg_match('/(^\/sample\/single)/i', $this->uri->uri_string()) ? 'class="active"' : ''); ?></li>
                    <li><?php echo anchor('sample/multiple', 'Multiple grids', preg_match('/(^\/sample\/multiple)/i', $this->uri->uri_string()) ? 'class="active"' : ''); ?></li>
                    <li><?php echo anchor('http://code.google.com/p/carbogrid/wiki/Documentation', 'Documentation', preg_match('/(^\/sample\/docs)/i', $this->uri->uri_string()) ? 'class="active"' : ''); ?></li>
                </ul>
                <div class="cg-clear"></div>
            </div>
        </div>
        <div class="cg-clear"></div>
    </div>
    <div id="menu-bottom"></div>
</div>
