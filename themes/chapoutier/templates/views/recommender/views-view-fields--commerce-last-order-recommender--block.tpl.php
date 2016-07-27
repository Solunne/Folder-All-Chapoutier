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
    //dpm($urlproduct);
    $realurl = drupal_get_path_alias($urlproduct);
    //dpm($realurl);
    $link = $base_url . $base_path . $realurl;
    $cleanurl = drupal_get_path_alias($link);
?>

<?php if($order_id == arg(1) && !$product_id == ''){ ?>
    <div role="tabpanel" class="tab-pane" id="<?php print $product_id; ?>">
        <div class="row">
            <div class="img-product col-md-6">
                <a class="link-product text-center" href="<?php print $cleanurl; ?>"><img src="<?php print $img; ?>" alt="<?php print $title; ?>" class="img-responsive" /></a>
            </div>
            <div class="description col-md-6">
                <div class="row">
                    <div class="product col-md-12">
                        <h3><a class="link-product" href="<?php print $cleanurl; ?>"><?php print $title; ?></a></h3>
                        <?php if(!empty($fields['field_product_included']->content)) {
                            print $fields['field_product_included']->content;
                        } ?>
                    </div>
                    <div class="share col-md-12">
                        <a class="facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php print $link; ?>&picture=<?php print $img; ?>&title=<?php print $title; ?>&description=<?php print t('I order this product'). ' ' . $title . ' ' . t('on') . ' ' . $base_url ; ?>"><?php print t('Facebook'); ?></a>
                        <a class="twitter" target="_blank" href="http://twitter.com/share?url=<?php print $link; ?>&text=<?php print t('I order this product'). ' ' . $title . ' ' . t('on') . '';?>&hashtags=chapoutier"><?php print t('Twitter'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }?>

<?php // print theme('sharethis', array('data_options' => sharethis_get_options_array(), 'm_path' => 'your_path', 'm_title' => 'your_title')); ?>