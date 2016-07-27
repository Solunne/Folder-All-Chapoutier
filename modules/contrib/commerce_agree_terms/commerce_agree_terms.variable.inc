<?php
/**
 * @file
 * Definition of Commerce Agree terms variables for the Variable API
 * Allows e-mail subject and body to be localized using the i18n_variable module
 */

/**
 * Implements hook_variable_info().
 */
function commerce_agree_terms_variable_info($options) {
  $variables['commerce_agree_terms_pane_title'] = array(
    'title' => t('Pane title/link text', array(), $options),
    'description' => t('Pane title that will be used as the link text. <a href="@link">Configure</a>.', array('@link' => url('admin/commerce/config/checkout/terms_conditions')), $options),
    'default' => 'Terms and Conditions',
    'type' => 'string',
    'localize' => TRUE,
    'access' => 'administer checkout',
    'group' => 'commerce_agree_terms',
  );
  $variables['commerce_agree_terms_checkbox_label'] = array(
    'title' => t('Checkbox label', array(), $options),
    'description' => t('Checkbox label where %terms is the link with the pane title as the link text. <a href="@link">Configure</a>.', array('@link' => url('admin/commerce/config/checkout/terms_conditions')), $options),
    'default' => 'I agree with the %terms',
    'type' => 'string',
    'localize' => TRUE,
    'access' => 'administer checkout',
    'group' => 'commerce_agree_terms',
  );
  $variables['commerce_agree_terms_checkbox_error'] = array(
    'title' => t('Error message', array(), $options),
    'description' => t('User friendly message to show if the customer fails to check the checkbox. <a href="@link">Configure</a>.', array('@link' => url('admin/commerce/config/checkout/terms_conditions')), $options),
    'default' => 'You must agree with the %terms before continuing',
    'type' => 'string',
    'localize' => TRUE,
    'access' => 'administer checkout',
    'group' => 'commerce_agree_terms',
  );
  $variables['commerce_agree_terms_pane_node'] = array(
    'title' => t('Terms and conditions page path', array(), $options),
    'description' => t('The internal Drupal path to your terms and conditions node (or an external URL)', array(), $options),
    'default' => '',
    'type' => 'string',
    'localize' => FALSE,
    'access' => 'administer checkout',
    'group' => 'commerce_agree_terms',
  );
  $variables['commerce_agree_terms_new_window'] = array(
    'title' => t('Open the link in a new window', array(), $options),
    'description' => t('If checked, the terms and conditions page will be opened in a new window/tab', array(), $options),
    'default' => 1,
    'type' => 'boolean',
    'localize' => FALSE,
    'access' => 'administer checkout',
    'group' => 'commerce_agree_terms',
  );

  return $variables;
}

/**
* Implements hook_variable_group_info().
*/
function commerce_agree_terms_variable_group_info() {
  $groups['commerce_agree_terms'] = array(
    'title' => t('Commerce Agree Terms'),
    'access' => 'administer checkout',
    'path' => array('admin/commerce/config/checkout'),
 );

  return $groups;
}