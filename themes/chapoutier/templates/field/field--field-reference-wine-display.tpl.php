<?php foreach ($items as $delta => $item): ?>
    <a href="<?php print render($item); ?>"><?php print t('Find Out more'); ?></a>
<?php endforeach; ?>