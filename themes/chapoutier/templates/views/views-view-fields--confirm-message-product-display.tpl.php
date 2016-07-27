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
$nodeProduct = node_load($fields['nid']->raw);
?>
<div class="row">
    <div class="col-sm-3 product-image">
        <?php print $fields['field_images']->content; ?>
    </div>
    <div class="col-sm-6 product-description">
        <div class="desc title vintage">
            <?php print $nodeProduct->title; ?>
            <?php print ($fields['title_field']->content != '<div></div>' && $fields['field_millesime']->content != '<div></div>') ? ' - ' : ''; ?>
            <?php print $fields['field_millesime']->content; ?>
        </div>
        <div class="desc location"><?php print $fields['field_aoc_igp']->content; ?></div>
        <div class="desc wine_type size">
        <?php print $fields['field_size']->content; ?>
        <?php print ($fields['field_size']->content != '<div></div>' && $fields['field_wine_type']->content != '<div></div>') ? ' - ' : ''; ?>
        <?php print $fields['field_wine_type']->content; ?>
        </div>
        <div class="desc vineyard"><?php print $fields['field_vineyard']->content; ?></div>
    </div>
    <div class="col-sm-3 product-quantity">
        <div class="quantity"><?php print $fields['quantity']->label_html ?> <?php print $fields['quantity']->content; ?></div>
        <div class="commerce_total"><?php print $fields['commerce_total']->label_html ?> <?php print $fields['commerce_total']->content; ?></div>
    </div>
</div>