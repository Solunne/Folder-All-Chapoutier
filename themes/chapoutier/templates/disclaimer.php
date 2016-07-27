<?php
/**
 * Created by PhpStorm.
 * User: adelannoy
 * Date: 13/07/16
 * Time: 19:01
 */
drupal_add_js(drupal_get_path('theme', 'chapoutier') . '/js/moment.js');
drupal_add_js(drupal_get_path('theme', 'chapoutier') . '/js/jquery-birthday-picker.min.js');
drupal_add_js(drupal_get_path('theme', 'chapoutier') . '/js/disclaimer.js');
?>

<div class="modal fade" id="modal-disclaimer" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php print t('Disclaimer'); ?></h4>
            </div>
            <div class="modal-body">
                <p class="disclaimer-buttons hidden"><?php print t('Have you the legal age in your home country to order ?'); ?></p>
                <p class="disclaimer-birthselect hidden"><?php print t('You must have the legal age to order in your home country. Please select your date of birth :'); ?></p>
            </div>
            <div class="modal-footer">
                <div class="hidden" id="disclaimer-birthselect">
                    <div id="minor-birthdate"></div>
                    <a href="" class="btn btn-primary" id="submit-btn"><?php print t('Validate'); ?></a>
                </div>
                <div class="hidden" id="disclaimer-buttons">
                    <a href="" class="btn btn-primary" id="major-btn" data-dismiss="modal"><?php print t('Yes'); ?></a>
                    <a href="" class="btn btn-default" id="minor-btn"><?php print t('No'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>