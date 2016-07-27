<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
    <h4 class="alphabet text-left <?php print $title; ?>"><?php print $title; ?></h4>
<?php endif; ?>
<?php foreach ($rows as $id => $row): ?>
    <ul class="list-definition text-left">
        <?php print $row; ?>
    </ul>
<?php endforeach; ?>

<div class="glossary modal fade" id="glossary" tabindex="-1" role="dialog" aria-labelledby="Glossary">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <p class="data-content"></p>
            </div>
        </div>
    </div>
</div>
