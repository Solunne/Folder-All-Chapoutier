<?php
/**
 * Rule set and rules overrides for the "Commerce Giftcard by Mail" module.
 */

require_once('commerce_gc_by_mail.constants.inc');

/**
 * <p>Implements <code>hook_default_rules_configuration()</code>.</p>
 *
 * <p>Defines a rule set for handling the following three cases for giftcard
 * notifications:</p>
 *
 * <dl>
 *   <dt>Electronically, via e-mail (<code>emailed</code>)</dt>
 *   <dd>Notifies the recipient and adds it to his or her existing or new account (similar to stock Commerce Giftcard functionality)</dd>
 *
 *   <dt>Physically, shipped with my order (<code>printed</code>)</dt>
 *   <dd>Notifies the site admin to print a giftcard and include it with the order, and adds it to the admin's account.</dd>
 *
 *   <dt>Neither; send it to me (<code>self</code>)</dt>
 *   <dd>Notifies the buyer, but does not add it it to his or her account.</dd>
 * </dl>
 */
function commerce_gc_by_mail_default_rules_configuration() {
  $items[CGBM_RULE_SET_ISSUE_APPROPRIATE_GC] =
    entity_import(
      'rules_config',
      '{ "generate_giftcard_for_appropriate_type_of_recipient" : {
          "LABEL" : "Generate giftcard for appropriate type of recipient",
          "PLUGIN" : "rule set",
          "OWNER" : "rules",
          "TAGS" : [ "commerce_gc_by_mail" ],
          "REQUIRES" : [ "rules", "commerce_gc_product" ],
          "USES VARIABLES" : {
            "commerce_line_item" : { "label" : "Line item", "type" : "commerce_line_item" },
            "giftcard_coupon" : { "label" : "Giftcard coupon", "type" : "commerce_coupon" }
          },
          "RULES" : [
            { "RULE" : {
                "PROVIDE" : {
                  "giftcard_mail" : { "giftcard_mail" : "Giftcard email" },
                  "user_recipient" : { "user_recipient" : "User recipient" }
                },
                "IF" : [
                  { "entity_is_of_bundle" : {
                      "entity" : [ "commerce-line-item" ],
                      "type" : "commerce_line_item",
                      "bundle" : { "value" : { "giftcard_purchase" : "giftcard_purchase" } }
                    }
                  },
                  { "data_is" : {
                      "data" : [ "commerce-line-item:commerce-gc-fulfillment-type" ],
                      "value" : "email"
                    }
                  }
                ],
                "DO" : [
                  { "commerce_gc_product_giftcard_email_variables" : {
                      "USING" : { "commerce_line_item" : [ "commerce-line-item" ] },
                      "PROVIDE" : { "giftcard_mail" : { "giftcard_mail" : "Giftcard email" } }
                    }
                  },
                  { "commerce_gc_product_attach_giftcard_to_user_recipient" : {
                      "USING" : {
                        "mail" : [ "giftcard-mail" ],
                        "commerce_coupon" : [ "giftcard-coupon" ],
                        "email_type" : "register_admin_created"
                      },
                      "PROVIDE" : { "user_recipient" : { "user_recipient" : "User recipient" } }
                    }
                  },
                  { "mail" : {
                      "to" : [ "giftcard-mail" ],
                      "subject" : "You have received a gift card at [site:name]",
                      "message" : "You have received a gift card to use at [site:url]. Please use the following code to redeem your gift: [giftcard-coupon:code].\n\n[commerce-line-item:giftcard-message-text]The balance of your gift card is [giftcard-coupon:giftcard-balance]. When logged in, you can track your balance here: [user-recipient:giftcards-url].",
                      "from" : ""
                    }
                  }
                ],
                "LABEL" : "If `send via e-mail`, notify recipient"
              }
            },
            { "RULE" : {
                "PROVIDE" : {
                  "variable_added" : { "order" : "Order" },
                  "giftcard_mail" : { "giftcard_mail" : "Giftcard email" },
                  "user_recipient" : { "user_recipient" : "User recipient" }
                },
                "IF" : [
                  { "entity_is_of_bundle" : {
                      "entity" : [ "commerce-line-item" ],
                      "type" : "commerce_line_item",
                      "bundle" : { "value" : { "giftcard_purchase" : "giftcard_purchase" } }
                    }
                  },
                  { "data_is" : {
                      "data" : [ "commerce-line-item:commerce-gc-fulfillment-type" ],
                      "value" : "printed"
                    }
                  }
                ],
                "DO" : [
                  { "variable_add" : {
                      "USING" : { "type" : "commerce_order", "value" : [ "commerce-line-item:order" ] },
                      "PROVIDE" : { "variable_added" : { "order" : "Order" } }
                    }
                  },
                  { "commerce_gc_product_giftcard_email_variables" : {
                      "USING" : { "commerce_line_item" : [ "commerce-line-item" ] },
                      "PROVIDE" : { "giftcard_mail" : { "giftcard_mail" : "Giftcard email" } }
                    }
                  },
                  { "commerce_gc_product_attach_giftcard_to_user_recipient" : {
                      "USING" : {
                        "mail" : [ "site:mail" ],
                        "commerce_coupon" : [ "giftcard-coupon" ],
                        "email_type" : "register_admin_created"
                      },
                      "PROVIDE" : { "user_recipient" : { "user_recipient" : "User recipient" } }
                    }
                  },
                  { "mail" : {
                      "to" : [ "site:mail" ],
                      "subject" : "Printed gift card requested for order #[order:order-number] at [site:name]",
                      "message" : "A customer has purchased a printed gift card to be included with order #[order:order-number] at [site:url]. The code to include on the printed card is \u0022[giftcard-coupon:code]\u0022.\r\n\r\nThe balance of the giftcard is [giftcard-coupon:giftcard-balance]. When logged in, you can track the balance of all printed gift cards here: [user-recipient:giftcards-url].",
                      "language" : [ "" ]
                    }
                  }
                ],
                "LABEL" : "If `include with order`, notify site admin"
              }
            },
            { "RULE" : {
                "PROVIDE" : {
                  "variable_added" : { "order" : "Order" },
                  "variable_added" : { "buyer" : "Buyer" },
                  "user_recipient" : { "buyer_recipient" : "User recipient" }
                },
                "IF" : [
                  { "entity_is_of_bundle" : {
                      "entity" : [ "commerce-line-item" ],
                      "type" : "commerce_line_item",
                      "bundle" : { "value" : { "giftcard_purchase" : "giftcard_purchase" } }
                    }
                  },
                  { "data_is" : {
                      "data" : [ "commerce-line-item:commerce-gc-fulfillment-type" ],
                      "value" : "self"
                    }
                  }
                ],
                "DO" : [
                  { "variable_add" : {
                      "USING" : { "type" : "commerce_order", "value" : [ "commerce-line-item:order" ] },
                      "PROVIDE" : { "variable_added" : { "order" : "Order" } }
                    }
                  },
                  { "variable_add" : {
                      "USING" : { "type" : "user", "value" : [ "order:owner" ] },
                      "PROVIDE" : { "variable_added" : { "buyer" : "Buyer" } }
                    }
                  },
                  { "mail" : {
                      "to" : [ "buyer:mail" ],
                      "subject" : "Gift card generated for use at [site:name]",
                      "message" : "The gift card you purchased is available for use at [site:url]. Either you or the recipient can redeem the card using the following code during checkout: [giftcard-coupon:code].\r\n\r\nThe balance of your gift card is [giftcard-coupon:giftcard-balance].\r\n\r\nIf you will be sending the gift card to another person, be sure not to spend it on orders for yourself!",
                      "language" : [ "" ]
                    }
                  }
                ],
                "LABEL" : "If `for myself`, notify buyer"
              }
            }
          ]
        }
      }');

  return $items;
}

/**
 * <p>Implements <code>hook_default_rules_configuration_alter()</code>.</p>
 *
 * <p>Alters the stock GC notification rule provided by Commerce Giftcard to
 * instead dispatch notifications to the new rule set provided by this
 * module.</p>
 */
function commerce_gc_by_mail_default_rules_configuration_alter(array &$configs) {
  if (isset($configs[CGBM_RULE_GC_LINE_ITEM])) {
    $configs[CGBM_RULE_GC_LINE_ITEM] =
      entity_import(
        'rules_config',
        '{ "commerce_gc_product_default_process_gift_card_line_item" : {
          "LABEL" : "Generate giftcard for purchased giftcard product",
          "PLUGIN" : "reaction rule",
          "WEIGHT" : "10",
          "OWNER" : "rules",
          "TAGS" : [ "Commerce Giftcard" ],
          "REQUIRES" : [ "commerce_gc_product", "rules" ],
          "ON" : { "commerce_gc_product_process_giftcard_line_item" : [] },
          "DO" : [
            { "commerce_gc_product_line_item_generate_giftcard" : {
                "USING" : { "commerce_line_item" : [ "commerce-line-item" ] },
                "PROVIDE" : { "giftcard_coupon" : { "giftcard_coupon" : "Giftcard coupon" } }
              }
            },
            { "component_generate_giftcard_for_appropriate_type_of_recipient" : {
                "commerce_line_item" : [ "commerce_line_item" ],
                "giftcard_coupon" : [ "giftcard_coupon" ]
              }
            }
          ]
        }
      }');
  }
}