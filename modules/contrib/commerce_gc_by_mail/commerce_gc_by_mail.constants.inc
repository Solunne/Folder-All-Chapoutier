<?php
/**
 * @file
 *   Constants for the "Commerce Giftcard by Mail" module.
 */

/**
 * The machine name of this module.
 *
 * @var string
 */
define('CGBM_MODULE_NAME', 'commerce_gc_by_mail');

/**
 * The name of the "Giftcard Fulfillment Type" field added by this module.
 *
 * @var string
 */
define('CGBM_FULFILLMENT_TYPE_FIELD_NAME', 'commerce_gc_fulfillment_type');

/**
 * The name of the "Giftcard Recipient Email" field added by this module.
 *
 * @var string
 */
define('CGBM_RECIPIENT_MAIL_FIELD_NAME', 'commerce_gc_mail');

/**
 * The name of the "Giftcard Recipient Message" field added by this module.
 *
 * @var string
 */
define('CGBM_RECIPIENT_MESSAGE_FIELD_NAME', 'commerce_gc_message');



/**
 * The machine name of the Commerce Line Item entity.
 *
 * @var string
 */
define('CGBM_LINE_ITEM_ENTITY_TYPE', 'commerce_line_item');

/**
 * The machine name of the bundle for Gift Card Purchase Line Items.
 *
 * @var string
 */
define('CGBM_GIFT_CARD_PURCHASE_BUNDLE', 'giftcard_purchase');

/**
 * The name of the fieldset that contains line item forms in product displays.
 *
 * @var string
 */
define('CGBM_LINE_ITEM_FIELDS_ELEMENT', 'line_item_fields');


/**
 * The name of the checkout pane that contains all of the Giftcard line items.
 *
 * @var string
 */
define('CGBM_GC_PRODUCT_PANE_ELEMENT', 'commerce_gc_product');

/**
 * The option value for having a giftcard emailed to the recipient.
 *
 * @var string
 */
define('CGBM_FULFILLMENT_TYPE_EMAIL', 'email');

/**
 * The option value for having a giftcard sent on a printed certificate in the
 * order.
 *
 * @var string
 */
define('CGBM_FULFILLMENT_TYPE_PRINTED', 'printed');

/**
 * The option value for having a giftcard issued to the purchaser.
 *
 * @var string
 */
define('CGBM_FULFILLMENT_TYPE_SELF',  'self');

/**
 * Machine name of the rule that is invoked when giftcards are generated during checkout.
 *
 * @var string
 */
define('CGBM_RULE_GC_LINE_ITEM', 'commerce_gc_product_default_process_gift_card_line_item');

/**
 * Machine name of the rule set that is invoked to notify recipients when giftcards are generated during checkout.
 *
 * @var string
 */
define('CGBM_RULE_SET_ISSUE_APPROPRIATE_GC', 'generate_giftcard_for_appropriate_type_of_recipient');