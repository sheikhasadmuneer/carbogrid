<div id="content">

<?php if (isset($title)): ?>
    <div class="title"><?php echo $title; ?></div>
<?php endif ?>

<?php if (isset($page)) $this->load->view($page); ?>

<?php if (isset($page_grid)) echo $page_grid; ?>

</div>
