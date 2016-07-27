<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
?>
<?php //dpm($fields); ?>
<?php
    $saleprice = $fields['field_commerce_saleprice']->content;
    $nid = $fields['nid']->content;
    $urlnid = drupal_get_path_alias('node/' . $nid);
?>
<div class="col-md-3 vert-offset-bottom-2 product">
    <figcaption>
        <a href="<?php print $urlnid; ?>"><?php print t('more info') ?></a>
    </figcaption>
    <figure>
        <a href="<?php print $urlnid; ?>"><?php print $fields['field_images_1']->content; ?></a>
    </figure>
    <figcaption>
        <h2 class="title"><?php print $fields['title']->content; ?></h2>
        <p class="description"><?php print $fields['field_description_et']->content; ?></p>

        <h3 class="price<?php if($saleprice !== ''){ ?> line-trought<?php } ?>"><?php print $fields['commerce_price']->content; ?></h3>
        <?php if($saleprice !== ''){ ?><h3 class="sale_price"><?php print $fields['field_commerce_saleprice']->content; ?></h3><?php } ?>

        <div><?php print $fields['field_product']->content; ?></div>
    </figcaption>
</div>
