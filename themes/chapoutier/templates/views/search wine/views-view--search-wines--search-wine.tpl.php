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
<?php //dpm($exposed); ?>
    <?php $view = views_get_current_view();
    //dpm($view);
    global $language;
    $langue = $language->language; ?>
<div id="search-wines" class="<?php print $classes; ?>">
<?php print render($title_prefix); ?>
<?php if ($title): ?>
    <?php print $title; ?>
<?php endif; ?>
<?php print render($title_suffix); ?>
<?php if ($header): ?>
    <div class="col-md-12 view-header">
        <?php print $header; ?>
    </div>
<?php endif; ?>
    <div class="col-sm-12 col-md-12 view-content-wines">
        <div class="row">
            <?php //if ($exposed): ?>
                <a href="javascript:void(0);" class="filter-mosaique"></a>
                <div class="col-xs-12 col-sm-12 col-md-2 col-left view-filters" id="view-filters">
                    <?php print $exposed; ?>
                </div>
                <div class="col-xs-12 col-md-10 col-right">
                    <?php $view = views_get_current_view(); ?>
                    <?php //dpm($view); ?>

                    <?php
                        $filters = $view->exposed_raw_input;
                        $isOnlyOneFilter = TRUE;
                        $fieldtaxo = '';
                        foreach($filters as $key => $value){
                            if(!in_array($key, array("price", "sort_by", "sort_order"))){
                                if ($fieldtaxo != '' && count($value) > 0) {
                                    $isOnlyOneFilter = FALSE;
                                }

                                if(count($value) == 1 && $fieldtaxo == ''){
                                    $fieldtaxo = $key;
                                }else if ((!empty($value) || count($value) > 1) && $fieldtaxo != '' ) {
                                    $fieldtaxo = '';
                                }
                            }
                        }
                    //dpm($fieldtaxo);
                    if($fieldtaxo != '' && $isOnlyOneFilter){
                            //dpm($view->exposed_raw_input[$fieldtaxo]);
                            $input = array_values($view->exposed_raw_input[$fieldtaxo])[0];
                            $tid = taxonomy_term_load($input);
                            $translated_tid = i18n_taxonomy_localize_terms($tid);
                            //dpm($translated_tid);
                            //dpm($langue);
                            print '<div class="col-xs-12 col-md-12 header-filter"><div class="row">';
                            if(!empty($translated_tid->field_image['und'][0]['uri'])){
                                $uri = $translated_tid->field_image['und'][0]['uri'];
                                //$image = file_create_url($uri);
                                print '<div class="col-md-10 col-md-offset-1"><img class="img-responsive" src="' . image_style_url("filter_mosaique_shop", $uri) . '" /></div>';
                            }

                            $title = $translated_tid->name;
                            print '<div class="col-xs-12 col-md-12"><h1 class="title text-center">' . $title . '</h1></div>';

                            if($translated_tid->description !== ''){
                                $description = $translated_tid->description;
                                print '<div class="col-xs-12 col-md-12"><p>' . $description . '</p></div>';
                            }
                            print '</div></div>';
                    }else{
                        print '<div class="col-xs-12 col-md-12 header-filter no-filter mobile"><h1 class="title text-center">' . t('Our wines') .'</h1></div>';
                    } ?>

                    <div class="col-xs-12 view-list">

                        <?php if ($exposed): ?>
                            <div class="col-xs-12 col-md-12 view-sort-order">
                                <?php print $exposed; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($rows): ?>
                            <div class="col-xs-12 col-md-12 view-content" id="view-content">
                                <?php print $rows; ?>
                            </div>
                        <?php elseif ($empty): ?>
                            <div class="col-xs-12 col-md-12 view-empty">
                                <?php print $empty; ?>
                            </div>
                        <?php endif; ?>


                    </div>
                </div>
            <?php //endif; ?>
            <div class="col-xs-12 col-md-12 view-pager">
                <div class="pagerer-pager">
                    <ul id="pagination" class="pagination-sm text-center"></ul>
                </div>
            </div>
        </div>
    </div>
<?php if ($footer): ?>
    <div class="view-footer">
        <?php print $footer; ?>
    </div>
<?php endif; ?>

    </div><?php /* class view */ ?>

<script>
    jQuery('a.filter-mosaique').on('click', function(e) {
        // Clear the mosaique on close.
        if (jQuery(this).hasClass('opened')) {
            jQuery('#view-filters').val('');
        }
        jQuery(this).toggleClass('opened');
        jQuery('#view-filters').toggleClass('opened');

    });
</script>

<?php drupal_add_js('/sites/all/themes/chapoutier/js/jquery.twbsPagination.js'); ?>
<?php drupal_add_js('/sites/all/themes/chapoutier/js/custom.pager.js'); ?>
