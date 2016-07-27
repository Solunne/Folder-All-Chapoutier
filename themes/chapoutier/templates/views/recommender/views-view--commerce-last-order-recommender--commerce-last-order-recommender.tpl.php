<?php

/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 *
 * @ingroup views_templates
 */
?>

<?php if ($header): ?>
    <div class="col-md-12 text-header">
        <h3><?php print t('You have just made a purchase on our site, feel free to share it with your loved ones !'); ?></h3>
    </div>
    <div class="col-md-4 tabs-share-last-order">
        <ul class="nav nav-tabs nav-stacked" id="tab_product_recommender" role="tablist">
            <?php print $header; ?>
        </ul>
    </div>
<?php endif; ?>
<?php if ($rows): ?>
    <div class="tab-content col-md-8" id="product_recommender">
        <?php print $rows; ?>
    </div>
<?php elseif ($empty): ?>
        <?php print $empty; ?>
<?php endif; ?>

