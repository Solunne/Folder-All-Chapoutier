<?php $count = 0; ?>
<?php foreach ($items as $delta => $item) {?>
    <div data-slide-up="<?php print $count; ?>" class="row slide-house <?php print $delta % 2 ? 'flex image-right' : 'flex image-left'; ?>" id="slide<?php print $count++; ?>" data-slide-down="<?php print $count; ?>">
            <?php print render($item); ?>
    </div>
<?php } ?>