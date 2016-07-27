<?php foreach ($items as $delta => $item): ?>
    <?php // print render($item); ?>
    <?php
    $img = $item['#item']['uri'];
    $urlimg = file_create_url($img); ?>
    <img class="img-product" src="<?php print $urlimg; ?>" />
<?php endforeach; ?>