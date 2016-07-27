<div class="row">
    <div id="node-<?php print $node->nid; ?>" class="col-xs-12 col-md-8 col-md-offset-2 <?php print $classes; ?> clearfix"<?php print $attributes; ?>>
        <div class="header-surmesure">
            <div class=""><?php print render($content['field_image']); ?></div>
            <div class="row">
                <h2 class="col-xs-12 col-md-10 col-md-offset-1 surmesure-title"><?php print render($content['field_subtitle']); ?></h2>
                <div class="col-xs-12 col-md-10 col-md-offset-1 surmesure-intro"><?php print render($content['field_description']); ?></div>
            </div>
        </div>
        <div class="webform-subtitle"><?php print t('Contact information')?></div>
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1 container-webform">
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
