<?php

/**
 * Implements hook_panels_layouts().
 */
function chapoutier_megamenu_panels_layouts() {

    $items['megamenu'] = array(
        'title' => t('Megamenu Chapoutier'),
        'category' => t('Chapoutier'),
        'icon' => 'megamenu.png',
        'theme' => 'megamenu',
        'css' => 'megamenu.css',
        'regions' => array(
            'col1' => t('col1'),
            'col2' => t('col2'),
            'col3' => t('col3'),
            'col4' => t('col4'),
            'col5' => t('col5'),
        ),
    );

    return $items;
}