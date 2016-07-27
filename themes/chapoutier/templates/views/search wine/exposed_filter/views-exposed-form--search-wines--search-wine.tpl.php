<?php

/**
 * @file
 * This template handles the layout of the views exposed filter form.
 *
 * Variables available:
 * - $widgets: An array of exposed form widgets. Each widget contains:
 * - $widget->label: The visible label to print. May be optional.
 * - $widget->operator: The operator for the widget. May be optional.
 * - $widget->widget: The widget itself.
 * - $sort_by: The select box to sort the view using an exposed form.
 * - $sort_order: The select box with the ASC, DESC options to define order. May be optional.
 * - $items_per_page: The select box with the available items per page. May be optional.
 * - $offset: A textfield to define the offset of the view. May be optional.
 * - $reset_button: A button to reset the exposed filter applied. May be optional.
 * - $button: The submit button for the form.
 * - $region_widgets: An array contains form widgets by regions.
 *
 * @ingroup views_templates
 */
?>

<?php if (!empty($q)): ?>
    <?php
    // This ensures that, if clean URLs are off, the 'q' is added first so that
    // it shows up first in the URL.
    print $q;
    ?>
<?php endif; ?>
<div class="flex">
    <h2 class="title"><?php print t('My selection'); ?></h2>
        <?php if (!empty($reset_button)): ?>
            <span class="reset-button">
                <?php print $reset_button; ?>
            </span>
        <?php endif; ?>
</div>
<?php
$size = '';
$view = views_get_current_view();
//dpm($view);
//Filtre location (Région/pays)
if (isset ($view->exposed_input['location'])) {
    $locations = array_unique($view->exposed_input['location']);
    foreach ($locations as $id => $row) {
        $key = $row;
        $tidlocation  = taxonomy_term_load($row);
        $translated_tidlocation = i18n_taxonomy_localize_terms($tidlocation);
        //dpm($translated_tidlocation);
        $location = $translated_tidlocation->name . '<a href="#" class="reset" data-field="edit-location" data-field-value="' . $key . '"><span class="cross"></span></a>';
        print '<div class="col-xs-12 filter"><span>' . t('Region/Country') . ': </span>' . $location . '</div>';
    }
}
//Filtre AOC IGP (Gammes)
if (isset ($view->exposed_input['aocigp'])) {
    $aocs = array_unique($view->exposed_input['aocigp']);
    foreach ($aocs as $id => $row) {
        $key = $row;
        $tidaoc = taxonomy_term_load($row);
        $translated_tidaoc = i18n_taxonomy_localize_terms($tidaoc);
        $aoc = $translated_tidaoc->name . '<a href="#" class="reset" data-field="edit-aocigp" data-field-value="' . $key . '"><span class="cross"></span></a>';
        print '<div class="col-xs-12 filter"><span>' . t('Our appellations') . ': </span>' . $aoc . '</div>';
    }
}
//Filtre Range (Gammes)
if (isset ($view->exposed_input['gammes'])) {
    $gammes = array_unique($view->exposed_input['gammes']);
    foreach ($gammes as $id => $row) {
        $key = $row;
        $tidgamme = taxonomy_term_load($row);
        $translated_tidgamme = i18n_taxonomy_localize_terms($tidgamme);
        $gamme = $translated_tidgamme->name . '<a href="#" class="reset" data-field="edit-gammes" data-field-value="' . $key . '"><span class="cross"></span></a>';
        print '<div class="col-xs-12 filter"><span>' . t('Ranges') . ': </span>' . $gamme . '</div>';
    }
}
//Filtre Nos domaines (Nos domaines)
if (isset ($view->exposed_input['domaines'])) {
    $domaines = array_unique($view->exposed_input['domaines']);
    foreach ($domaines as $id => $row) {
        $key = $row;
        $tiddomaine = taxonomy_term_load($row);
        $translated_tiddomaine = i18n_taxonomy_localize_terms($tiddomaine);
        $domaine = $translated_tiddomaine->name . '<a href="#" class="reset" data-field="edit-domaines" data-field-value="' . $key . '"><span class="cross"></span></a>';
        print '<div class="col-xs-12 filter"><span>' . t('Our estates') . ': </span>' . $domaine . '</div>';
    }
}
//Filtre Vineyard (À découvrir)
if (isset ($view->exposed_input['vineyard'])) {
    $vineyards = array_unique($view->exposed_input['vineyard']);
    foreach ($vineyards as $id => $row) {
        $key = $row;
        $tidvineyard = taxonomy_term_load($row);
        $translated_tidvineyard = i18n_taxonomy_localize_terms($tidvineyard);
        $vineyard = $translated_tidvineyard->name . '<a href="#" class="reset" data-field="edit-vineyard" data-field-value="' . $key . '"><span class="cross"></span></a>';
        print '<div class="col-xs-12 filter"><span>' . t('Discover also') . ': </span>' . $vineyard . '</div>';
    }
}
//Filtre Couleur (Couleurs)
if (isset ($view->exposed_input['color'])) {
    $colors = array_unique($view->exposed_input['color']);
    foreach ($colors as $id => $row) {
        $key = $row;
        $tidcolor = taxonomy_term_load($row);
        $translated_tidcolor = i18n_taxonomy_localize_terms($tidcolor);
        $color = $translated_tidcolor->name . '<a href="#" class="reset" data-field="edit-color" data-field-value="' . $key . '"><span class="cross"></span></a>';
        print '<div class="col-xs-12 filter"><span>' . t('Colour') . ': </span>' . $color . '</div>';
    }
}
//Filtre taille (Format)
if (isset ($view->exposed_input['field_size_tid'])) {
    $sizes = array_unique($view->exposed_input['field_size_tid']);
    foreach ($sizes as $id => $row) {
        $key = $row;
        $tidsize = taxonomy_term_load($row);
        $translated_tidsize = i18n_taxonomy_localize_terms($tidsize);
        $size = $translated_tidsize->name . '<a href="#" class="reset" data-field="edit-field-size-tid" data-field-value="' . $key . '"><span class="cross"></span></a>';
        print '<div class="col-xs-12 filter"><span>' . t('Format') . ': </span>' . $size . '</div>';
    }
}
//Filtre vintage (Millésime)
if (isset ($view->exposed_input['field_millesime_tid'])) {
    $tidvintages = array_unique($view->exposed_input['field_millesime_tid']);
    foreach ($tidvintages as $id => $row) {
        $key = $row;
        $tidvintage = taxonomy_term_load($row);
        $translated_tidvintage = i18n_taxonomy_localize_terms($tidvintage);
        $vintage = $translated_tidvintage->name . '<a href="#" class="reset" data-field="edit-field-millesime-tid" data-field-value="' . $key . '"><span class="cross"></span></a>';
        print '<div class="col-xs-12 filter"><span>' . t('Vintage') . ': </span>' . $vintage . '</div>';
    }
}
//Filtre family accordance (Famille d'accord)
if (isset ($view->exposed_input['field_family_accordance_tid'])) {
    $familys = array_unique($view->exposed_input['field_family_accordance_tid']);
    foreach ($familys as $id => $row) {
        $key = $row;
        $tidfamily = taxonomy_term_load($row);
        $translated_tidfamily = i18n_taxonomy_localize_terms($tidfamily);
        $family = $translated_tidfamily->name . '<a href="#" class="reset" data-field="edit-field-family-accordance-tid" data-field-value="' . $key . '"><span class="cross"></span></a>';
        print '<div class="col-xs-12 filter"><span>' . t('Pairing categories') . ': </span>' . $family . '</div>';
    }
}
//Filtre bio (Bio)
if (isset ($view->exposed_input['field_bio_tid'])) {
    $bios = array_unique($view->exposed_input['field_bio_tid']);
    foreach ($bios as $id => $row) {
        $key = $row;
        $tidbio = taxonomy_term_load($row);
        $translated_tidbio = i18n_taxonomy_localize_terms($tidbio);
        $bio = $translated_tidbio->name . '<a href="#" class="reset" data-field="edit-field-bio-tid" data-field-value="' . $key . '"><span class="cross"></span></a>';
        print '<div class="col-xs-12 filter"><span>' . t('Organic') . ': </span>' . $bio . '</div>';
    }
}
//Filtre Catégorie produit
if (isset ($view->exposed_input['field_product_category_tid'])) {
    $categorys = array_unique($view->exposed_input['field_product_category_tid']);
    foreach ($categorys as $id => $row) {
        $key = $row;
        $tidcategory  = taxonomy_term_load($row);
        $translated_tidcategory = i18n_taxonomy_localize_terms($tidcategory);
        $category = $translated_tidcategory->name . '<a href="#" class="reset" data-field="edit-location" data-field-value="' . $key . '"><span class="cross"></span></a>';
        print '<div class="col-xs-12 filter"><span>' . t('Product categories') . ': </span>' . $category . '</div>';
    }
}
//Filtre Sélection parcellaire
if (isset ($view->exposed_input['single_vineyard_selection'])) {
    $primeurs = array_unique($view->exposed_input['single_vineyard_selection']);
    foreach ($primeurs as $id => $row) {
        $key = $row;
        $tidprimeur = taxonomy_term_load($row);
        $translated_tidprimeur = i18n_taxonomy_localize_terms($tidprimeur);
        $primeur = $translated_tidprimeur->name . '<a href="#" class="reset" data-field="single-vineyard-selection" data-field-value="' . $key . '"><span class="cross"></span></a>';
        print '<div class="col-xs-12 filter">' . $primeur . '</div>';
    }
}



/*if (isset ($view->exposed_input['primeur'])) {
    $primeurs = $view->exposed_input['primeur'];
    foreach ($primeurs as $id => $row) {
        $key = $row;
        $primeur = '<a href="#" class="reset" data-field="edit-primeur-1" data-field-value="' . $key . '">X</a>';
        print '<div class="col-xs-12 filter">' .  t('Primeur') . $primeur . '</div>';
    }
}

if (isset ($view->exposed_input['single_vineyard_selection'])) {
    $primeurs = $view->exposed_input['single_vineyard_selection'];
    foreach ($primeurs as $id => $row) {
        $key = $row;
        $primeur = '<a href="#" class="reset" data-field="edit-primeur-1" data-field-value="' . $key . '">X</a>';
        print '<div class="col-xs-12 filter">' .  t('Single Vineyard Selection') . $primeur . '</div>';
    }
}
*/?>


<div class="col-xs-12 views-exposed-form">
    <div class="row views-exposed-widgets clearfix">

        <?php foreach ($widgets as $id => $widget): ?>
            <?php //dpm($id); ?>
            <?php if($id == 'filter-field_single_vineyard_selection_tid' || $id == 'filter-field_en_primeur_tid'){ ?>
                <div id="<?php print $widget->id; ?>-wrapper" class="col-xs-12 col-md-12 views-exposed-widget views-widget-<?php print $id; ?>">
                    <?php if (!empty($widget->operator)): ?>
                        <div class="views-operator">
                            <?php print $widget->operator; ?>
                        </div>
                    <?php endif; ?>
                    <div class="views-widget">
                        <?php print $widget->widget; ?>
                    </div>
                    <?php if (!empty($widget->description)): ?>
                        <div class="description">
                            <?php print $widget->description; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php }else{ ?>
                <div id="<?php print $widget->id; ?>-wrapper" class="col-xs-12 col-md-12 views-exposed-widget views-widget-<?php print $id; ?>">
                    <?php if (!empty($widget->label)): ?>
                        <div class="collapsible-heading <?php print $widget->id; ?> collapsed" data-toggle="collapse" data-target="#<?php print $id; ?>" aria-expanded="true" aria-controls="<?php print $id; ?>">
                            <span class="caret-chapoutier"></span> <?php print $widget->label; ?>
                        </div>
                    <?php endif; ?>
                    <div class="collapse" id="<?php print $id; ?>">

                        <?php if (!empty($widget->operator)): ?>
                            <div class="views-operator">
                                <?php print $widget->operator; ?>
                            </div>
                        <?php endif; ?>
                        <div class="views-widget">
                            <?php print $widget->widget; ?>
                        </div>
                        <?php if (!empty($widget->description)): ?>
                            <div class="description">
                                <?php print $widget->description; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            <?php } ?>
        <?php endforeach; ?>

        <div class="col-md-12 views-exposed-widget views-widget views-widget-sort-by-order">
            <div class="">
                <?php if (!empty($sort_by)): ?>
                    <div class="views-exposed-widget views-widget-sort-by">
                        <?php print $sort_by; ?>
                    </div>
                    <div class="views-exposed-widget views-widget-sort-order">
                        <?php print $sort_order; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!empty($items_per_page)): ?>
            <div class="views-exposed-widget views-widget-per-page">
                <?php print $items_per_page; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($offset)): ?>
            <div class="views-exposed-widget views-widget-offset">
                <?php print $offset; ?>
            </div>
        <?php endif; ?>
        <div class="views-exposed-widget views-submit-button">
            <?php print $button; ?>
        </div>
    </div>
</div>

<script>
	//reset filter mosaique
        jQuery(document).ready(function(){
            jQuery('a.reset').on( 'click', function() {
                var datafield = jQuery(this).attr('data-field');
                var datafieldvalue = jQuery(this).attr('data-field-value');
                var fieldname = jQuery('#'+datafield).attr('name');
                var arrValues = jQuery('#'+datafield).val();
                // Remove the value in the original field.
                console.log(typeof arrValues, jQuery('#'+datafield).val());
                console.log(typeof datafieldvalue, datafieldvalue);
                if (jQuery.isArray(arrValues)) {
                    arrValues.splice(arrValues.indexOf(datafieldvalue), 1);
                }
                jQuery('#'+datafield).val(arrValues);
                // Remove the hidden BEF field.
                jQuery('input[type="hidden"][name="' + fieldname + '"][value="' + datafieldvalue + '"]').remove();

                console.log(jQuery('#views-exposed-form-search-wines-search-wine').serializeArray());
                jQuery('#views-exposed-form-search-wines-search-wine').submit();
            });
        });
</script>
