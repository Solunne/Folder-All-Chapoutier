<?php

/**
 * @file
 * Default theme implementation for field collection items.
 *
 * Available variables:
 * - $content: An array of comment items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $title: The (sanitized) field collection item label.
 * - $url: Direct url of the current entity if specified.
 * - $page: Flag for the full page state.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. By default the following classes are available, where
 *   the parts enclosed by {} are replaced by the appropriate values:
 *   - entity-field-collection-item
 *   - field-collection-item-{field_name}
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess()
 * @see template_preprocess_entity()
 * @see template_process()
 */
?>
<?php
	global $language;
	//dpm($content['field_reference_wine_display']['#items'][0]['node']->field_description); ?>

<div class="range-description-big">
    <div class="col-xs-12 col-md-6 range-description">
        <h2 class="range-content-title"><?php //print render($content['field_reference_wine_display']['#items'][0]['node']['title']); ?> <?php print render($content['title_field']); ?></h2>
        <div><span class="range-content-aoc"><?php print render($content['field_aoc_igp']); ?></span><span class="range-content-wine-color"> - <?php print render($content['field_wine_color']); ?></span></div>
        <div class="range-content-location"><?php print render($content['field_location']); ?></div>
        <div class="range-content-description"><?php print render($content['field_reference_wine_display']['#items'][0]['node']->field_description[$language->language][0]['value']/*$content['field_description']*/); ?></div>
        <div class="range-content-ref"><?php print render($content['field_reference_wine_display']); ?></div>
    </div>
    <div class="col-xs-12 col-md-6 range-wine-pic">
        <?php print render($content['field_image']); ?>
    </div>
</div>
<div class="range-description-small">
    <div class="range-description-aoc-color"><span class="range-content-aoc"><?php print render($content['field_aoc_igp']); ?></span><span class="range-content-wine-color"> - <?php print render($content['field_wine_color']); ?></span></div>
    <div class="range-content-location"><?php print render($content['field_location']); ?></div>
    <div class="range-wine-pic"><?php print render($content['field_image']); ?></div>
    <div class="container-range-content-description">
        <div class="range-content-description">
            <?php print render($content['field_description']); ?>
        </div>
    </div>
    <div class="range-content-ref" style="background-color:<?php print $content['field_description_color']['#items'][0]['rgb']; ?>"><?php print render($content['field_reference_wine_display']); ?></div>
</div>