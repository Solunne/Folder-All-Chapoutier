<?php

/**
 * @file
 * This template is used to print a single field in a view.
 *
 * It is not actually used in default Views, as this is registered as a theme
 * function which has better performance. For single overrides, the template is
 * perfectly okay.
 *
 * Variables available:
 * - $view: The view object
 * - $field: The field handler object that can process the input
 * - $row: The raw SQL result that can be used
 * - $output: The processed output that will normally be used.
 *
 * When fetching output from the $row, this construct should be used:
 * $data = $row->{$field->field_alias}
 *
 * The above will guarantee that you'll always get the correct data,
 * regardless of any changes in the aliasing that might happen if
 * the view is modified.
 */
?>
<?php //dpm($field); ?>
<?php
// Global language
    global $language;
    $langue= $language->language;
// Get Nid node
    $nid = $field->original_value;
// Recherche autre node dans d'autres langues
    $tnid = node_load($nid);
    $another_node = translation_node_get_translations($tnid->tnid);
//dpm($tnid);
//$coucou = admininal_get_translations_nids($tnid->tnid);
//dpm($coucou);

// Liste langues actives
    $languages = language_list('enabled');
?>
<?php if(!empty($another_node)){ ?>
    <ul class="list-node-translated">
        <?php foreach ($another_node as $delta => $item): ?>
            <?php $nidtranslated = $item->nid; ?>
            <li>
                <span><?php print $languages[1][$item->language]->native . ': '; ?>
                    <a href="<?php print '/' . $languages[1][$item->language]->language . '/' . drupal_get_path_alias('node/' . $nidtranslated .''); ?>" class="url-node-translated">
                        <?php print $item->title; ?>
                    </a>
                    <a href="<?php print '/' . $langue . '/node/' . $nidtranslated . '/edit'; ?>" class="edit-node-translated">
                        <?php print '(' .t('Edit') .')'; ?>
                    </a>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>
<?php } ?>
<?php //print $output; ?>