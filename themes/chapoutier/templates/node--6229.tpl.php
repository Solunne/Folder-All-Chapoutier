<div class="row">
    <div id="node-<?php print $node->nid; ?>" class="col-xs-12 col-md-8 col-md-offset-2 <?php print $classes; ?> clearfix"<?php print $attributes; ?>>
        <div class="header-surmesure">
            <div class=""><?php print render($content['field_image']); ?></div>
            <h2 class="surmesure-title"><?php print render($content['field_subtitle']); ?></h2>
            <div class="surmesure-intro"><?php print render($content['field_description']); ?></div>
        </div>
        <div class="webform-subtitle"><?php print t('Your contact information')?></div>
        <div class="row">
            <div class="container-webform col-xs-12 col-md-10 col-md-offset-1">
                <?php if ($display_submitted): ?>
                    <div class="submitted">
                        <?php print $submitted; ?>
                    </div>
                <?php endif; ?>
                <?php hide($content['field_infos_cgv']); ?>
                <?php print render($content); ?>
                <div class="footer-surmesure"><?php print render($content['field_infos_cgv']); ?></div>
            </div>
        </div>
    </div>
</div>