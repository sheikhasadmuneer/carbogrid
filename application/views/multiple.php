<h2>Two grids with one form</h2>

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

<?php echo $grid3; ?>
