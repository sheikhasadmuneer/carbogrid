<h2>Two grids with one form</h2>

<?php echo form_open(); ?>
<table width="100%">
    <tr>
        <td style="vertical-align:top;"><?php echo $grid1; ?></td>
        <td>
            <input type="submit" name="activate" value="Activate &gt;" /><br/>
            <input type="submit" name="unactivate" value="&lt; Unactivate" />
        </td>
        <td style="vertical-align:top;"><?php echo $grid2; ?></td>
    </tr>
</table>
<?php echo form_close(); ?>
