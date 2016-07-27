<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
$counter = 0;
?>
<?php if (!empty($title)): ?>
    <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php foreach ($rows as $id => $row): ?>
    <?php $page = $counter/12+1; ?>
    <?php if($counter % 12 == 0){ ?>
        <div class="page-product page-product-<?php print $page; ?><?php if($page > 1){?> hidden<?php } ?>">
    <?php } ?>
<?php
        if ($counter % 3 == 0) { ?>
        <div class="row">
        <?php
        } ?>
    <div<?php if ($classes_array[$id]) { print ' class="col-md-4 vert-offset-bottom-2 product ' . $classes_array[$id] .'"';  } ?>>
        <?php //echo $counter; ?>
        <?php print $row; ?>
    </div>
    <?php
        if ($counter % 3 == 2 || $counter == count($rows)){ ?>
            </div>
        <?php
        }

    ?>
    <?php if ($counter % 12 == 11 || $counter == count($rows)){ ?>
        </div>
    <?php } ?>

    <?php $counter++; ?>

<?php endforeach; ?>