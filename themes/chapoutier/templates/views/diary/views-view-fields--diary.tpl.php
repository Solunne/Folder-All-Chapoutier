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
    global $language;
    $langue = $language->language;
    $nid = $fields['nid']->content;
    $node_urlalias =  drupal_get_path_alias( 'node/' . $nid );
?>
    <div class="col-xs-12 col-md-6 main-picture">
        <?php print $fields['field_image']->content; ?>
        <div class="triangle"></div>
    </div>
    <div class="col-xs-12 col-md-6 text">
        <p class="date text-center"><time datetime="<?php print $fields['field_publication_date']->content; ?>"><?php print $fields['field_publication_date']->content; ?></time></p>
        <p class="category underline text-center"><?php print $fields['field_category']->content ?></p>
        <h2 class="title text-center"><?php print $fields['title']->content; ?></h2>
        <p class="description text-left"><?php print $fields['field_description']->content; ?></p>
        <p class="text-center"><a class="more chapoutier-btn" href="/<?php print $langue; ?>/<?php print $node_urlalias; ?>"><?php print t('Read more') ?></a></p>
        <div class="line"><span></span></div>
    </div>