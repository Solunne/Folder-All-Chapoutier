<?php 
/**
 * @file
 * Commerce shipping jump rules references
 */

/**
 * Implements hook_default_rules_configuration().
 */
function commerce_shipping_jump_default_rules_configuration() {
  $rules = array();


  // If no physical product in an order, go from the checkout pane to the 
  // review pane instead of shipping one.
  $rule = rules_reaction_rule();
  $rule->label = t('(Commerce Shipping) Jump forward over shipping step');
  $rule->active = TRUE;
  $rule->event('commerce_order_update')
    ->condition('data_is', array(
      'data:select' => 'commerce-order:status',
      'value' => 'checkout_shipping',
    ))
    ->condition(
      rules_or()
        ->condition('data_is', array(
          'data:select' => 'commerce-order-unchanged:status',
          'op' => '==',
          'value' => 'checkout_shipping',
        ))
        ->condition('data_is', array(
          'data:select' => 'commerce-order-unchanged:status',
          'op' => '==',
          'value' => 'checkout_review',
        ))
        ->negate()
    )
    ->condition(rules_condition('commerce_physical_rules_order_is_shippable', array(
      'commerce_order:select' => 'commerce_order',
    ))->negate())
    ->action('commerce_order_update_status', array(
      'commerce_order:select' => 'commerce_order',
      'order_status' => 'checkout_review',
    ))
    ->action('redirect', array(
      'url' => 'checkout/[commerce-order:order-id]/review',
    ));
  $rules['commerce_shipping_jump_forward_shipping'] = $rule;


  // If no physical product in an order, go from the review pane to the 
  // checkout pane instead of shipping one.
  $rule = rules_reaction_rule();
  $rule->label = t('(Commerce Shipping) Jump backward over shipping step');
  $rule->active = TRUE;
  $rule->event('commerce_order_update')
    ->condition('data_is', array(
      'data:select' => 'commerce-order:status',
      'value' => 'checkout_shipping',
    ))
    ->condition('data_is', array(
      'data:select' => 'commerce-order-unchanged:status',
      'op' => '==',
      'value' => 'checkout_review',
    ))
    ->condition(rules_condition('commerce_physical_rules_order_is_shippable', array(
      'commerce_order:select' => 'commerce_order',
    ))->negate())
    ->action('commerce_order_update_status', array(
      'commerce_order:select' => 'commerce_order',
      'order_status' => 'checkout_checkout',
    ))
    ->action('redirect', array(
      'url' => 'checkout/[commerce-order:order-id]',
    ));
  $rules['commerce_shipping_jump_backward_shipping'] = $rule;


  return $rules;
}
