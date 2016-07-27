<?php
/**
 * Created by PhpStorm.
 * User: adelannoy
 * Date: 05/07/16
 * Time: 18:41
 */

/**
 * Implements hook_rules_action_info().
 */
function wassa_chapoutier_rules_action_info()
{
    $actions = array();

    $actions['wassa_chapoutier_add_coeff_and_vat_to_product'] = array(
        'label' => t('Add multiplying coefficient to a product'),
        'group' => t('WASSA Chapoutier'),
        'parameter' => array(
            'commerce_line_item' => array(
                'type' => 'commerce_line_item',
                'label' => t('Line item'),
            ),
            'component_name' => array(
                'type' => 'text',
                'label' => t('Price component type'),
                'description' => t('Price components track changes to prices made during the price calculation process, and they are carried over from the unit price to the total price of a line item. When an order total is calculated, it combines all the components of every line item on the order. When the unit price is altered by this action, the selected type of price component will be added to its data array and reflected in the order total display when it is formatted with components showing. Defaults to base price, which displays as the order Subtotal.'),
                'options list' => 'commerce_line_item_price_component_options_list',
                'default value' => 'base_price',
            ),
            'round_mode' => array(
                'type' => 'integer',
                'label' => t('Price rounding mode'),
                'description' => t('Round the resulting price amount after performing this operation.'),
                'options list' => 'commerce_round_mode_options_list',
                'default value' => COMMERCE_ROUND_HALF_UP,
            ),
        ),
        'callbacks' => array(
            'execute' => 'wassa_chapoutier_unit_price_multiply',
        ),
    );

    return $actions;
}

/**
 * Rules action: multiply the unit price by some amount.
 */
function wassa_chapoutier_unit_price_multiply($line_item, $component_name, $round_mode) {

    $wrapper = entity_metadata_wrapper('commerce_line_item', $line_item);
    $unit_price = commerce_price_wrapper_value($wrapper, 'commerce_unit_price', TRUE);
    // Load the order with the line item order ID;
    $order = commerce_order_load($line_item->order_id);
    // Load the product with the line item product ID.
    $product = commerce_product_load($line_item->commerce_product[LANGUAGE_NONE][0]['product_id']);

    // Check if the true shipping country is filled in the checkout tunnel.
    if (!empty($order->commerce_customer_shipping)) {
        // Load the shipping address from the user's profile.
        $shippingAddress = commerce_customer_profile_load($order->commerce_customer_shipping[LANGUAGE_NONE][0]['profile_id']);

        // If the cookie shipping_country is different of selected shipping country in the checkout tunnel.
        if ($shippingAddress->commerce_customer_address[LANGUAGE_NONE][0]['country'] != $_COOKIE['shipping_country']) {
            // Set the new/good value for the shipping country.
            setcookie('shipping_country', $shippingAddress->commerce_customer_address[LANGUAGE_NONE][0]['country']);
        }
    }

    // Get the amount of the multiplying coefficient.
    $coeff = getMultiplyingCoefficient($product);


    // Calculate the updated amount and create a price array representing the
    // difference between it and the current amount.
    $current_amount = $unit_price['amount'];
    $updated_amount = commerce_round($round_mode, $current_amount * $coeff);

    $difference = array(
        'amount' => $updated_amount - $current_amount,
        'currency_code' => $unit_price['currency_code'],
        'data' => array(),
    );

    // Set the amount of the unit price and add the difference as a component.
    $wrapper->commerce_unit_price->amount = $updated_amount;

    $wrapper->commerce_unit_price->data = commerce_price_component_add(
        $wrapper->commerce_unit_price->value(),
        $component_name,
        $difference,
        TRUE
    );
}

/**
 * Implements hook_commerce_price_component_type_info().
 */
function wassa_chapoutier_commerce_price_component_type_info()
{
    return array(
        'country_coefficient_cost' => array(
            'title' => t('Country coefficient costs'),
            'weight' => -40,
        ),
    );
}
