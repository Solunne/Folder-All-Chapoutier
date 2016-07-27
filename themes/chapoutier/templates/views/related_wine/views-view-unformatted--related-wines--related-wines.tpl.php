<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php foreach ($rows as $id => $row): ?>
    <div class="col-xs-12 col-md-4 related-wines-product">
        <?php print $row; ?>
    </div>
<?php endforeach; ?>