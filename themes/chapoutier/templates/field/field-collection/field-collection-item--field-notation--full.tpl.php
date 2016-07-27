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
<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading-<?php print $classes; ?>">
        <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php print sanitized($title); ?>" aria-expanded="true" aria-controls="collapse-<?php print sanitized($title); ?>">
                <?php print render($content['field_magazine']);?> <span class="note"><?php print render($content['field_note']); ?></span>
                    <span class="glyphicon glyphicon-plus text-right" aria-hidden="true"></span>
            </a>
        </h4>
    </div>
    <div id="collapse-<?php print sanitized($title); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-<?php print sanitized($title); ?>">
        <div class="panel-body">
                <?php print render($content['field_description']); ?>
        </div>
    </div>
</div>
