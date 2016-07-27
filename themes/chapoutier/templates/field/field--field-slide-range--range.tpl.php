<?php $count = 0; ?>
<?php foreach ($items as $delta => $item) {?>
    <div class="row item-slide-range" id="slide<?php print $count++; ?>">
        <?php print render($item); ?>
    </div>
<?php } ?>