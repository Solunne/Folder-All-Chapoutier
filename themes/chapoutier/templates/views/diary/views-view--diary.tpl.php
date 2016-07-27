<div class="row flex">
    <div class="col-xs-12 col-md-8 col-md-offset-2 vert-offset-top-2 vert-offset-bottom-2 content top">
        <?php if ($rows): ?>
            <?php print $rows; ?>
        <?php elseif ($empty): ?>
            <?php print $empty; ?>
        <?php endif; ?>

        <?php if ($pager): ?>
            <?php print $pager; ?>
        <?php endif; ?>
    </div>
    <div class="col-xs-12 col-md-1 col-md-offset-1 glossary-sidebar">
        <h3 class="title"><?php print t('Lexicon'); ?></h3>
        <?php
        $blockObject = block_load('views', 'glossary_display-glossary');
        $block = _block_get_renderable_array(_block_render_blocks(array($blockObject)));
        $output = drupal_render($block);
        print $output;
        ?>
    </div>
</div>