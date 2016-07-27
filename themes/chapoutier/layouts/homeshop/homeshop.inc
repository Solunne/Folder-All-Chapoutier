<?php

/**
 * Implements hook_panels_layouts().
 */
function chapoutier_homeshop_panels_layouts() {

    $items['homeshop'] = array(
        'title' => t('Home Shop Chapoutier'),
        'category' => t('Chapoutier'),
        'icon' => 'homeshop.png',
        'theme' => 'homeshop',
        'css' => 'homeshop.css',
        'regions' => array(
            'first' => t('First'),
            'left' => t('Left'),
            'right' => t('Right'),
            'one' => t('One'),
            'two' => t('Two'),
            'three' => t('Three'),
            'four' => t('Four'),
            'five' => t('Five'),
        ),
    );

    return $items;
}