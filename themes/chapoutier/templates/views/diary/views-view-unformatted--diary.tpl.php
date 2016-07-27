<?php foreach ($rows as $id => $row) {?>
    <div class="row vert-offset-bottom-4 <?php print $id % 2 ? 'flex image-right' : 'flex image-left'; ?>">
        <?php print $row; ?>
    </div>
<?php } ?>
