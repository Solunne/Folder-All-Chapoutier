<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>

<?php //dpm($rows); ?>

    <?php foreach ($rows as $id => $row): ?>
        <?php print $row; ?>
    <?php endforeach; ?>
