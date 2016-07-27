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
global $base_url;   // Will point to http://www.chapoutier.com
global $base_path;  // Will point to at least "/" or the subdirectory where the drupal in installed.
$order_id = $fields['order_id']->content;
$product_id = $fields['product_id']->content;
$title = $fields['line_item_title']->content;
$img = $fields['field_images_et']->content;
$urlproduct = $fields['commerce_display_path']->content;
$link = $base_url . $base_path . $urlproduct;
$cleanurl = drupal_get_path_alias($link);
?>

<?php if($order_id == arg(1) && !$product_id == ''){ ?>
    <li role="presentation">
        <a href="#<?php print $product_id; ?>" aria-controls="<?php print $product_id; ?>" role="tab" data-toggle="tab"><?php print $title; ?></a>
    </li>
<?php }?>

<?php // print theme('sharethis', array('data_options' => sharethis_get_options_array(), 'm_path' => 'your_path', 'm_title' => 'your_title')); ?>

