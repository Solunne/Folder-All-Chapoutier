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
<?php //dpm($content); ?>

<?php if(isset($content['field_video'])){ ?>
    <div class="col-xs-12 col-md-6 media image video embed-responsive embed-responsive-4by3" style="background: url('<?php print render($content['field_image']); ?>');">
        <?php
            $uri = $content['field_video']['#items'][0]['uri'];
            $realuri = file_create_url($uri);
        ?>
        <video id="home-chapoutier" class="video-js embed-responsive-item" controls preload="auto"
               poster="<?php print render($content['field_image']); ?>" data-setup="{}">
            <source src="<?php print $realuri; ?>" type='video/mp4'>
        </video>
    </div>
<?php }else{ ?>
    <div class="col-xs-12 col-md-6 media image" style="background: url('<?php print render($content['field_image']); ?>');">
    </div>
<?php } ?>

<div class="col-xs-12 col-md-6 description">
	<a class="btn_up" href="#slide<?php $arr = explode('-', sanitized($title)); echo $arr[0] - 2; ?>"></a>
    <?php print render($content['title_field']); ?>
    <?php print render($content['field_subtitle']); ?>
    <?php if(isset($content['field_related_content'])){ ?>
    <?php
    $id = $content['field_related_content']['#items'][0]['nid'];
    $alias = drupal_get_path_alias('node/' . $id); ?>
        <a class="range-btn" href="/<?php print $alias; ?>" /><?php print t('Discover the range'); ?></a>
    <?php } ?>

    <?php print render($content['field_description']); ?>
    <a class="btn_down" href="#slide<?php $arr = explode('-', sanitized($title)); echo $arr[0]; ?>"></a>
</div>