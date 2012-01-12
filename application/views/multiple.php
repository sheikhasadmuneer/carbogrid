<h1>Advanced usage</h1>
<p>
    This example demonstrates more advanced features, like how to place multiple grids on one page (with ajax history tracking of course),
    and how to implement interactions between grids.
</p>

<h2>Grid interaction</h2>
<p>
    By default Carbogrid renders a separate html form for each grid. But if you want to implement interaction between grids,
    or post grid values with an external custom submit button (e.g. access selected values of the grid), you have to create the form manually,
    render the grids and other content you want between the form tags and set the <i>'nested'</i> option of the grids to <b>FALSE</b>.
</p>
<p>
    The below example demonstrates this behaviour. The left grid filters the <i>`user`</i> table for inactive users (<i>`active`</i> = FALSE),
    the right grid filters the <i>`user`</i> table for active users (<i>`active`</i> = TRUE). The 'Activate' button sets the <i>`active`</i>
    field TRUE for all selected users in the left grid, and the 'Unactivate' button sets the <i>`active`</i>
    field FALSE for all selected users in the right grid.
</p>
<p>
    For both grids add/edit/delete, filtering, changing page size and show/hide columns is disabled, and the left grid has an initial ordering
    on the <i>`username`</i> column.
</p>

<?php echo form_open(); ?>

<table width="100%">
    <tr>
        <td style="vertical-align:top;"><?php echo $grid1; ?></td>
        <td style="text-align:center;">
            <input style="width:100px;" type="submit" name="activate" value="Activate &gt;" /><br/>
            <input style="width:100px;" type="submit" name="unactivate" value="&lt; Unactivate" />
        </td>
        <td style="vertical-align:top;"><?php echo $grid2; ?></td>
    </tr>
</table>
<?php echo form_close(); ?>

<h2>Grid with no ajax history</h2>

<p>
    This grid has ajax history disabled, and has an initial filter on the <i>`username`</i> column.
</p>

<?php echo $grid3; ?>

<a href="#" id="source_toggle"><span class="ui-icon ui-icon-triangle-1-e"></span>View source code</a>

<div id="source" class="php"><ol><li class="li1"><div class="de1"><span class="kw2">function</span> multiple<span class="br0">(</span><span class="re0">$grid1</span> <span class="sy0">=</span> <span class="st_h">'none'</span><span class="sy0">,</span> <span class="re0">$grid2</span> <span class="sy0">=</span> <span class="st_h">'none'</span><span class="sy0">,</span> <span class="re0">$grid3</span> <span class="sy0">=</span> <span class="st_h">'none'</span><span class="br0">)</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; <span class="br0">{</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">if</span> <span class="br0">(</span><span class="re0">$this</span><span class="sy0">-&gt;</span><span class="me1">input</span><span class="sy0">-&gt;</span><span class="me1">post</span><span class="br0">(</span><span class="st_h">'activate'</span><span class="br0">)</span><span class="br0">)</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">{</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="re0">$ids</span> <span class="sy0">=</span> <span class="re0">$this</span><span class="sy0">-&gt;</span><span class="me1">input</span><span class="sy0">-&gt;</span><span class="me1">post</span><span class="br0">(</span><span class="st_h">'cg_users1_item_ids'</span><span class="br0">)</span><span class="sy0">;</span></div></li>
<li class="li1"><div class="de1">&nbsp;</div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">if</span> <span class="br0">(</span><span class="kw3">count</span><span class="br0">(</span><span class="re0">$ids</span><span class="br0">)</span><span class="br0">)</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">{</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">// This should be in a model of course</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="re0">$this</span><span class="sy0">-&gt;</span><span class="me1">db</span><span class="sy0">-&gt;</span><span class="me1">set</span><span class="br0">(</span><span class="st_h">'active'</span><span class="sy0">,</span> <span class="nu0">1</span><span class="br0">)</span><span class="sy0">-&gt;</span><span class="me1">where_in</span><span class="br0">(</span><span class="st_h">'id'</span><span class="sy0">,</span> <span class="re0">$ids</span><span class="br0">)</span><span class="sy0">-&gt;</span><span class="me1">update</span><span class="br0">(</span><span class="st_h">'user'</span><span class="br0">)</span><span class="sy0">;</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">}</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">}</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">if</span> <span class="br0">(</span><span class="re0">$this</span><span class="sy0">-&gt;</span><span class="me1">input</span><span class="sy0">-&gt;</span><span class="me1">post</span><span class="br0">(</span><span class="st_h">'unactivate'</span><span class="br0">)</span><span class="br0">)</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">{</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="re0">$ids</span> <span class="sy0">=</span> <span class="re0">$this</span><span class="sy0">-&gt;</span><span class="me1">input</span><span class="sy0">-&gt;</span><span class="me1">post</span><span class="br0">(</span><span class="st_h">'cg_users2_item_ids'</span><span class="br0">)</span><span class="sy0">;</span></div></li>
<li class="li1"><div class="de1">&nbsp;</div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">if</span> <span class="br0">(</span><span class="kw3">count</span><span class="br0">(</span><span class="re0">$ids</span><span class="br0">)</span><span class="br0">)</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">{</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">// This should be in a model of course</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="re0">$this</span><span class="sy0">-&gt;</span><span class="me1">db</span><span class="sy0">-&gt;</span><span class="me1">set</span><span class="br0">(</span><span class="st_h">'active'</span><span class="sy0">,</span> <span class="nu0">0</span><span class="br0">)</span><span class="sy0">-&gt;</span><span class="me1">where_in</span><span class="br0">(</span><span class="st_h">'id'</span><span class="sy0">,</span> <span class="re0">$ids</span><span class="br0">)</span><span class="sy0">-&gt;</span><span class="me1">update</span><span class="br0">(</span><span class="st_h">'user'</span><span class="br0">)</span><span class="sy0">;</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">}</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">}</span></div></li>
<li class="li1"><div class="de1">&nbsp;</div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">// Grid 1</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; <span class="re0">$columns</span> <span class="sy0">=</span> <span class="kw3">array</span><span class="br0">(</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="nu0">0</span> <span class="sy0">=&gt;</span> <span class="kw3">array</span><span class="br0">(</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'Username'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'db_name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'username'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'header'</span> <span class="sy0">=&gt;</span> <span class="st_h">'Username'</span><span class="sy0">,</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'group'</span> <span class="sy0">=&gt;</span> <span class="st_h">'User'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'form_control'</span> <span class="sy0">=&gt;</span> <span class="st_h">'text_long'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'type'</span> <span class="sy0">=&gt;</span> <span class="st_h">'string'</span><span class="br0">)</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="nu0">1</span> <span class="sy0">=&gt;</span> <span class="kw3">array</span><span class="br0">(</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'Active'</span><span class="sy0">,</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'db_name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'active'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'header'</span> <span class="sy0">=&gt;</span> <span class="st_h">'Active'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'group'</span> <span class="sy0">=&gt;</span> <span class="st_h">'User'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'allow_filter'</span> <span class="sy0">=&gt;</span> <span class="kw4">FALSE</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'form_visible'</span> <span class="sy0">=&gt;</span> <span class="kw4">FALSE</span><span class="sy0">,</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'form_control'</span> <span class="sy0">=&gt;</span> <span class="st_h">'checkbox'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'type'</span> <span class="sy0">=&gt;</span> <span class="st_h">'boolean'</span><span class="br0">)</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="nu0">2</span> <span class="sy0">=&gt;</span> <span class="kw3">array</span><span class="br0">(</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'Start Time'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'db_name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'start_time'</span><span class="sy0">,</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'header'</span> <span class="sy0">=&gt;</span> <span class="st_h">'Start Time'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'group'</span> <span class="sy0">=&gt;</span> <span class="st_h">'Period'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'date_format'</span> <span class="sy0">=&gt;</span> <span class="st_h">'m/d/Y'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'form_default'</span> <span class="sy0">=&gt;</span> <span class="kw3">date</span><span class="br0">(</span><span class="st_h">'m/d/Y H:i'</span><span class="br0">)</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'form_control'</span> <span class="sy0">=&gt;</span> <span class="st_h">'datetimepicker'</span><span class="sy0">,</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'type'</span> <span class="sy0">=&gt;</span> <span class="st_h">'date'</span><span class="br0">)</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="nu0">3</span> <span class="sy0">=&gt;</span> <span class="kw3">array</span><span class="br0">(</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'End Time'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'db_name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'end_time'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'header'</span> <span class="sy0">=&gt;</span> <span class="st_h">'End Time'</span><span class="sy0">,</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'group'</span> <span class="sy0">=&gt;</span> <span class="st_h">'Period'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'date_format'</span> <span class="sy0">=&gt;</span> <span class="st_h">'m/d/Y'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'form_control'</span> <span class="sy0">=&gt;</span> <span class="st_h">'datetimepicker'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'type'</span> <span class="sy0">=&gt;</span> <span class="st_h">'date'</span><span class="br0">)</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">)</span><span class="sy0">;</span></div></li>
<li class="li2"><div class="de2">&nbsp;</div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="re0">$params</span> <span class="sy0">=</span> <span class="kw3">array</span><span class="br0">(</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'id'</span> <span class="sy0">=&gt;</span> <span class="st_h">'users1'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'table'</span> <span class="sy0">=&gt;</span> <span class="st_h">'user'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'url'</span> <span class="sy0">=&gt;</span> <span class="st_h">'sample/multiple'</span><span class="sy0">,</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'uri_param'</span> <span class="sy0">=&gt;</span> <span class="re0">$grid1</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'params_after'</span> <span class="sy0">=&gt;</span> <span class="re0">$grid2</span> <span class="sy0">.</span> <span class="st_h">'/'</span> <span class="sy0">.</span> <span class="re0">$grid3</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'columns'</span> <span class="sy0">=&gt;</span> <span class="re0">$columns</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'order'</span> <span class="sy0">=&gt;</span> <span class="kw3">array</span><span class="br0">(</span><span class="nu0">0</span> <span class="sy0">=&gt;</span> <span class="st_h">'desc'</span><span class="br0">)</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'hard_filters'</span> <span class="sy0">=&gt;</span> <span class="kw3">array</span><span class="br0">(</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="nu0">1</span> <span class="sy0">=&gt;</span> <span class="kw3">array</span><span class="br0">(</span><span class="st_h">'value'</span> <span class="sy0">=&gt;</span> <span class="kw4">FALSE</span><span class="br0">)</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">)</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'allow_add'</span> <span class="sy0">=&gt;</span> <span class="kw4">FALSE</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'allow_edit'</span> <span class="sy0">=&gt;</span> <span class="kw4">FALSE</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'allow_delete'</span> <span class="sy0">=&gt;</span> <span class="kw4">FALSE</span><span class="sy0">,</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'allow_filter'</span> <span class="sy0">=&gt;</span> <span class="kw4">FALSE</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'allow_columns'</span> <span class="sy0">=&gt;</span> <span class="kw4">FALSE</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'allow_page_size'</span> <span class="sy0">=&gt;</span> <span class="kw4">FALSE</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'nested'</span> <span class="sy0">=&gt;</span> <span class="kw4">TRUE</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'ajax'</span> <span class="sy0">=&gt;</span> <span class="kw4">TRUE</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">)</span><span class="sy0">;</span></div></li>
<li class="li1"><div class="de1">&nbsp;</div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="re0">$this</span><span class="sy0">-&gt;</span><span class="me1">load</span><span class="sy0">-&gt;</span><span class="me1">library</span><span class="br0">(</span><span class="st_h">'carbogrid'</span><span class="sy0">,</span> <span class="re0">$params</span><span class="sy0">,</span> <span class="st_h">'grid1'</span><span class="br0">)</span><span class="sy0">;</span></div></li>
<li class="li1"><div class="de1">&nbsp;</div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">if</span> <span class="br0">(</span><span class="re0">$this</span><span class="sy0">-&gt;</span><span class="me1">grid1</span><span class="sy0">-&gt;</span><span class="me1">is_ajax</span><span class="br0">)</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">{</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="re0">$this</span><span class="sy0">-&gt;</span><span class="me1">grid1</span><span class="sy0">-&gt;</span><span class="me1">render</span><span class="br0">(</span><span class="br0">)</span><span class="sy0">;</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">return</span> <span class="kw4">FALSE</span><span class="sy0">;</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">}</span></div></li>
<li class="li1"><div class="de1">&nbsp;</div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">// Grid 2</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="re0">$columns</span> <span class="sy0">=</span> <span class="kw3">array</span><span class="br0">(</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="nu0">0</span> <span class="sy0">=&gt;</span> <span class="kw3">array</span><span class="br0">(</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'Username'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'db_name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'username'</span><span class="sy0">,</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'header'</span> <span class="sy0">=&gt;</span> <span class="st_h">'Username'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'group'</span> <span class="sy0">=&gt;</span> <span class="st_h">'User'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'form_control'</span> <span class="sy0">=&gt;</span> <span class="st_h">'text_long'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'type'</span> <span class="sy0">=&gt;</span> <span class="st_h">'string'</span><span class="br0">)</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="nu0">1</span> <span class="sy0">=&gt;</span> <span class="kw3">array</span><span class="br0">(</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'Age'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'db_name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'age'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'header'</span> <span class="sy0">=&gt;</span> <span class="st_h">'Age'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'group'</span> <span class="sy0">=&gt;</span> <span class="st_h">'User'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'form_control'</span> <span class="sy0">=&gt;</span> <span class="st_h">'text_short'</span><span class="sy0">,</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'type'</span> <span class="sy0">=&gt;</span> <span class="st_h">'integer'</span><span class="br0">)</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="nu0">2</span> <span class="sy0">=&gt;</span> <span class="kw3">array</span><span class="br0">(</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'Active'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'db_name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'active'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'header'</span> <span class="sy0">=&gt;</span> <span class="st_h">'Active'</span><span class="sy0">,</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'group'</span> <span class="sy0">=&gt;</span> <span class="st_h">'User'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'allow_filter'</span> <span class="sy0">=&gt;</span> <span class="kw4">FALSE</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'form_control'</span> <span class="sy0">=&gt;</span> <span class="st_h">'checkbox'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'type'</span> <span class="sy0">=&gt;</span> <span class="st_h">'boolean'</span><span class="br0">)</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">)</span><span class="sy0">;</span></div></li>
<li class="li2"><div class="de2">&nbsp;</div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="re0">$params</span> <span class="sy0">=</span> <span class="kw3">array</span><span class="br0">(</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'id'</span> <span class="sy0">=&gt;</span> <span class="st_h">'users2'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'table'</span> <span class="sy0">=&gt;</span> <span class="st_h">'user'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'url'</span> <span class="sy0">=&gt;</span> <span class="st_h">'sample/multiple'</span><span class="sy0">,</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'uri_param'</span> <span class="sy0">=&gt;</span> <span class="re0">$grid2</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'params_before'</span> <span class="sy0">=&gt;</span> <span class="re0">$grid1</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'params_after'</span> <span class="sy0">=&gt;</span> <span class="re0">$grid3</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'columns'</span> <span class="sy0">=&gt;</span> <span class="re0">$columns</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'hard_filters'</span> <span class="sy0">=&gt;</span> <span class="kw3">array</span><span class="br0">(</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="nu0">2</span> <span class="sy0">=&gt;</span> <span class="kw3">array</span><span class="br0">(</span><span class="st_h">'value'</span> <span class="sy0">=&gt;</span> <span class="kw4">TRUE</span><span class="br0">)</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">)</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'allow_add'</span> <span class="sy0">=&gt;</span> <span class="kw4">FALSE</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'allow_edit'</span> <span class="sy0">=&gt;</span> <span class="kw4">FALSE</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'allow_delete'</span> <span class="sy0">=&gt;</span> <span class="kw4">FALSE</span><span class="sy0">,</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'allow_filter'</span> <span class="sy0">=&gt;</span> <span class="kw4">FALSE</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'allow_columns'</span> <span class="sy0">=&gt;</span> <span class="kw4">FALSE</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'allow_page_size'</span> <span class="sy0">=&gt;</span> <span class="kw4">FALSE</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'nested'</span> <span class="sy0">=&gt;</span> <span class="kw4">TRUE</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'ajax'</span> <span class="sy0">=&gt;</span> <span class="kw4">TRUE</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">)</span><span class="sy0">;</span></div></li>
<li class="li1"><div class="de1">&nbsp;</div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="re0">$this</span><span class="sy0">-&gt;</span><span class="me1">load</span><span class="sy0">-&gt;</span><span class="me1">library</span><span class="br0">(</span><span class="st_h">'carbogrid'</span><span class="sy0">,</span> <span class="re0">$params</span><span class="sy0">,</span> <span class="st_h">'grid2'</span><span class="br0">)</span><span class="sy0">;</span></div></li>
<li class="li1"><div class="de1">&nbsp;</div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">if</span> <span class="br0">(</span><span class="re0">$this</span><span class="sy0">-&gt;</span><span class="me1">grid2</span><span class="sy0">-&gt;</span><span class="me1">is_ajax</span><span class="br0">)</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">{</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="re0">$this</span><span class="sy0">-&gt;</span><span class="me1">grid2</span><span class="sy0">-&gt;</span><span class="me1">render</span><span class="br0">(</span><span class="br0">)</span><span class="sy0">;</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">return</span> <span class="kw4">FALSE</span><span class="sy0">;</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">}</span></div></li>
<li class="li1"><div class="de1">&nbsp;</div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">// Grid 3</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="re0">$columns</span> <span class="sy0">=</span> <span class="kw3">array</span><span class="br0">(</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="nu0">0</span> <span class="sy0">=&gt;</span> <span class="kw3">array</span><span class="br0">(</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'Username'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'db_name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'username'</span><span class="sy0">,</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'header'</span> <span class="sy0">=&gt;</span> <span class="st_h">'Username'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'group'</span> <span class="sy0">=&gt;</span> <span class="st_h">'User'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'required'</span> <span class="sy0">=&gt;</span> <span class="kw4">TRUE</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'unique'</span> <span class="sy0">=&gt;</span> <span class="kw4">TRUE</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'form_control'</span> <span class="sy0">=&gt;</span> <span class="st_h">'text_long'</span><span class="sy0">,</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'type'</span> <span class="sy0">=&gt;</span> <span class="st_h">'string'</span><span class="br0">)</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="nu0">1</span> <span class="sy0">=&gt;</span> <span class="kw3">array</span><span class="br0">(</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'Active'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'db_name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'active'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'header'</span> <span class="sy0">=&gt;</span> <span class="st_h">'Active'</span><span class="sy0">,</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'group'</span> <span class="sy0">=&gt;</span> <span class="st_h">'User'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'allow_filter'</span> <span class="sy0">=&gt;</span> <span class="kw4">FALSE</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'form_control'</span> <span class="sy0">=&gt;</span> <span class="st_h">'checkbox'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'type'</span> <span class="sy0">=&gt;</span> <span class="st_h">'boolean'</span><span class="br0">)</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="nu0">2</span> <span class="sy0">=&gt;</span> <span class="kw3">array</span><span class="br0">(</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'City'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'db_name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'city'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'header'</span> <span class="sy0">=&gt;</span> <span class="st_h">'City'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'group'</span> <span class="sy0">=&gt;</span> <span class="st_h">'User'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'allow_filter'</span> <span class="sy0">=&gt;</span> <span class="kw4">FALSE</span><span class="sy0">,</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'ref_table_db_name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'city'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'ref_field_db_name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'name'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'ref_field_type'</span> <span class="sy0">=&gt;</span> <span class="st_h">'string'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'form_control'</span> <span class="sy0">=&gt;</span> <span class="st_h">'dropdown'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'type'</span> <span class="sy0">=&gt;</span> <span class="st_h">'1-n'</span><span class="br0">)</span><span class="sy0">,</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="nu0">3</span> <span class="sy0">=&gt;</span> <span class="kw3">array</span><span class="br0">(</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'Comment'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'db_name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'opinion'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'header'</span> <span class="sy0">=&gt;</span> <span class="st_h">'Comment'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'group'</span> <span class="sy0">=&gt;</span> <span class="st_h">'Comment'</span><span class="sy0">,</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'form_control'</span> <span class="sy0">=&gt;</span> <span class="st_h">'textarea'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'type'</span> <span class="sy0">=&gt;</span> <span class="st_h">'text'</span><span class="br0">)</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="nu0">4</span> <span class="sy0">=&gt;</span> <span class="kw3">array</span><span class="br0">(</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'IP'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'db_name'</span> <span class="sy0">=&gt;</span> <span class="st_h">'ip_address'</span><span class="sy0">,</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'header'</span> <span class="sy0">=&gt;</span> <span class="st_h">'IP'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'visible'</span> <span class="sy0">=&gt;</span> <span class="kw4">FALSE</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'form_default'</span> <span class="sy0">=&gt;</span> <span class="re0">$this</span><span class="sy0">-&gt;</span><span class="me1">input</span><span class="sy0">-&gt;</span><span class="me1">ip_address</span><span class="br0">(</span><span class="br0">)</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'form_visible'</span> <span class="sy0">=&gt;</span> <span class="kw4">FALSE</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'type'</span> <span class="sy0">=&gt;</span> <span class="st_h">'string'</span><span class="br0">)</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">)</span><span class="sy0">;</span></div></li>
<li class="li1"><div class="de1">&nbsp;</div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">// Allow edit/delete only for items with the current IP address</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="re0">$commands</span><span class="br0">[</span><span class="st_h">'delete'</span><span class="br0">]</span><span class="br0">[</span><span class="st_h">'filters'</span><span class="br0">]</span> <span class="sy0">=</span> <span class="kw3">array</span><span class="br0">(</span><span class="nu0">4</span> <span class="sy0">=&gt;</span> <span class="kw3">array</span><span class="br0">(</span><span class="st_h">'value'</span> <span class="sy0">=&gt;</span> <span class="re0">$this</span><span class="sy0">-&gt;</span><span class="me1">input</span><span class="sy0">-&gt;</span><span class="me1">ip_address</span><span class="br0">(</span><span class="br0">)</span><span class="br0">)</span><span class="br0">)</span><span class="sy0">;</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="re0">$commands</span><span class="br0">[</span><span class="st_h">'edit'</span><span class="br0">]</span><span class="br0">[</span><span class="st_h">'filters'</span><span class="br0">]</span> <span class="sy0">=</span> <span class="kw3">array</span><span class="br0">(</span><span class="nu0">4</span> <span class="sy0">=&gt;</span> <span class="kw3">array</span><span class="br0">(</span><span class="st_h">'value'</span> <span class="sy0">=&gt;</span> <span class="re0">$this</span><span class="sy0">-&gt;</span><span class="me1">input</span><span class="sy0">-&gt;</span><span class="me1">ip_address</span><span class="br0">(</span><span class="br0">)</span><span class="br0">)</span><span class="br0">)</span><span class="sy0">;</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">// Don't show multiple delete button</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="re0">$commands</span><span class="br0">[</span><span class="st_h">'delete'</span><span class="br0">]</span><span class="br0">[</span><span class="st_h">'toolbar'</span><span class="br0">]</span> <span class="sy0">=</span> <span class="kw4">FALSE</span><span class="sy0">;</span></div></li>
<li class="li1"><div class="de1">&nbsp;</div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="re0">$params</span> <span class="sy0">=</span> <span class="kw3">array</span><span class="br0">(</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'id'</span> <span class="sy0">=&gt;</span> <span class="st_h">'users'</span><span class="sy0">,</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'table'</span> <span class="sy0">=&gt;</span> <span class="st_h">'user'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'url'</span> <span class="sy0">=&gt;</span> <span class="st_h">'sample/multiple'</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'uri_param'</span> <span class="sy0">=&gt;</span> <span class="re0">$grid3</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'params_before'</span> <span class="sy0">=&gt;</span> <span class="re0">$grid1</span> <span class="sy0">.</span> <span class="st_h">'/'</span> <span class="sy0">.</span> <span class="re0">$grid2</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'columns'</span> <span class="sy0">=&gt;</span> <span class="re0">$columns</span><span class="sy0">,</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'commands'</span> <span class="sy0">=&gt;</span> <span class="re0">$commands</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'filters'</span> <span class="sy0">=&gt;</span> <span class="kw3">array</span><span class="br0">(</span><span class="nu0">0</span> <span class="sy0">=&gt;</span> <span class="kw3">array</span><span class="br0">(</span><span class="st_h">'value'</span> <span class="sy0">=&gt;</span> <span class="st_h">'la'</span><span class="sy0">,</span> <span class="st_h">'operator'</span> <span class="sy0">=&gt;</span> <span class="st_h">'like'</span><span class="br0">)</span><span class="br0">)</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'ajax'</span> <span class="sy0">=&gt;</span> <span class="kw4">TRUE</span><span class="sy0">,</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="st_h">'ajax_history'</span> <span class="sy0">=&gt;</span> <span class="kw4">FALSE</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">)</span><span class="sy0">;</span></div></li>
<li class="li2"><div class="de2">&nbsp;</div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="re0">$this</span><span class="sy0">-&gt;</span><span class="me1">load</span><span class="sy0">-&gt;</span><span class="me1">library</span><span class="br0">(</span><span class="st_h">'carbogrid'</span><span class="sy0">,</span> <span class="re0">$params</span><span class="sy0">,</span> <span class="st_h">'grid3'</span><span class="br0">)</span><span class="sy0">;</span></div></li>
<li class="li1"><div class="de1">&nbsp;</div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">if</span> <span class="br0">(</span><span class="re0">$this</span><span class="sy0">-&gt;</span><span class="me1">grid3</span><span class="sy0">-&gt;</span><span class="me1">is_ajax</span><span class="br0">)</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">{</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="re0">$this</span><span class="sy0">-&gt;</span><span class="me1">grid3</span><span class="sy0">-&gt;</span><span class="me1">render</span><span class="br0">(</span><span class="br0">)</span><span class="sy0">;</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">return</span> <span class="kw4">FALSE</span><span class="sy0">;</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">}</span></div></li>
<li class="li1"><div class="de1">&nbsp;</div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">// Pass grid to the view</span></div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; <span class="re0">$data</span><span class="sy0">-&gt;</span><span class="me1">page</span> <span class="sy0">=</span> <span class="st_h">'multiple'</span><span class="sy0">;</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="re0">$data</span><span class="sy0">-&gt;</span><span class="me1">grid1</span> <span class="sy0">=</span> <span class="re0">$this</span><span class="sy0">-&gt;</span><span class="me1">grid1</span><span class="sy0">-&gt;</span><span class="me1">render</span><span class="br0">(</span><span class="br0">)</span><span class="sy0">;</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="re0">$data</span><span class="sy0">-&gt;</span><span class="me1">grid2</span> <span class="sy0">=</span> <span class="re0">$this</span><span class="sy0">-&gt;</span><span class="me1">grid2</span><span class="sy0">-&gt;</span><span class="me1">render</span><span class="br0">(</span><span class="br0">)</span><span class="sy0">;</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="re0">$data</span><span class="sy0">-&gt;</span><span class="me1">grid3</span> <span class="sy0">=</span> <span class="re0">$this</span><span class="sy0">-&gt;</span><span class="me1">grid3</span><span class="sy0">-&gt;</span><span class="me1">render</span><span class="br0">(</span><span class="br0">)</span><span class="sy0">;</span></div></li>
<li class="li1"><div class="de1">&nbsp;</div></li>
<li class="li2"><div class="de2">&nbsp; &nbsp; &nbsp; &nbsp; <span class="re0">$this</span><span class="sy0">-&gt;</span><span class="me1">load</span><span class="sy0">-&gt;</span><span class="me1">view</span><span class="br0">(</span><span class="st_h">'container'</span><span class="sy0">,</span> <span class="re0">$data</span><span class="br0">)</span><span class="sy0">;</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; <span class="br0">}</span></div></li>
</ol></div>
