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
$nid = $fields['nid']->content;
$url = drupal_get_path_alias('node/'. $nid);
global $language;
$langue= $language->language;
?>
<?php //dpm($fields); ?>
<div class="row" xmlns="http://www.w3.org/1999/html">
    <div class="col-xs-12 col-md-10 col-md-offset-1 informations">
        <div class="pull-left bio-color">
            <?php if(!empty($fields['field_bio']->content)){ ?>
                <span class="pull-left bio">
                    <img src="<?php print $fields['field_extractor_field_bio']->content; ?>" class="bio" data-placement="top" data-trigger="hover" data-toggle="popover" title="<?php print $fields['field_bio']->content; ?>" data-content="<?php print $fields['field_extractor_field_bio_1']->content; ?>"/>
                </span>
            <?php } ?>
            <?php if(!empty($fields['field_wine_type']->content)){ ?>
                <span class="pull-left color <?php print $fields['field_wine_type']->content; ?>" data-placement="top" data-trigger="hover" data-toggle="popover" title="<?php print t('Wine color'); ?>" data-content="<?php print $fields['field_wine_type']->content; ?>"></span>
            <?php } ?>
        </div>
        <?php if(!empty($fields['commerce_price']->content)){ ?>
            <div class="pull-right price-sale-price">
                <a href="/<?php print $langue; ?>/<?php print $url; ?>">
                    <?php if(empty($fields['field_commerce_saleprice']->content)){ ?>
                        <span class="price no-sale text-right"><?php print $fields['commerce_price']->content; ?></span>
                    <?php }else{ ?>
                        <span class="sale-price with-sale text-right"><?php print $fields['field_commerce_saleprice']->content; ?></span>
                        <span class="price with-sale text-right"><?php print $fields['commerce_price']->content; ?></span>
                    <?php } ?>
                </a>
            </div>
        <?php } ?>
    </div>
    <div class="col-xs-12 col-md-10 col-md-offset-1 image">
        <a href="/<?php print $langue; ?>/<?php print $url; ?>">
            <img src="<?php print $fields['field_images']->content; ?>" class="product-image" />
        </a>
    </div>
    <?php if(!empty($fields['title']->content)){ ?>
        <div class="col-xs-12 col-md-10 col-md-offset-1 text-center title">
            <a href="/<?php print $langue; ?>/<?php print $url; ?>">
                <h2><?php print $fields['title']->content; ?></h2>
            </a>
        </div>
    <?php } ?>
    <?php if(!empty($fields['field_aoc_igp']->content)){ ?>
    <div class="col-xs-12 col-md-10 col-md-offset-1 text-center aoc">
        <p><?php print $fields['field_aoc_igp']->content; ?></p>
    </div>
    <?php } ?>
    <?php if(!empty($fields['field_vineyard']->content)){ ?>
    <div class="col-xs-12 col-md-10 col-md-offset-1 text-center producteur">
        <p><?php print $fields['field_vineyard']->content; ?></p>
    </div>
    <?php } ?>
    <div class="col-xs-12 col-md-10 col-md-offset-1 add-to-cart">
        <?php print $fields['field_product']->content; ?>
    </div>
</div>