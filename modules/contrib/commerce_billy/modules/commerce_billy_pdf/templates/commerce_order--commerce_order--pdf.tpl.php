<?php

/**
 * @file
 * Template for invoiced orders.
 */
//var_dump($content);
?>

<div class="row header">
    <div class="col-xs-6 invoice-invoiced style="width: 50%;"">
        <div class="branding">
            <img src="<?php print $content['invoice_logo']['#value']; ?>" style="display: block; width: 50%;"/>
            <?php print render($content['invoice_header']); ?>
        </div>
        <div class="invoice">
            <?php print t('Invoice'); ?>
        </div>
    </div>
    <div class="col-xs-6 style="width: 50%;"">
        <div class="invoice">
            <?php print t('Domiciliation'); ?>
        </div>
        <div class="customer">
            <?php print render($content['commerce_customer_billing']); ?>
        </div>
    </div>
</div>
<div class="row content">

      <div class="invoice-header-date"><?php print render($content['invoice_header_date']); ?></div>

      <div class="invoice-number"><?php print render($content['order_number']); ?></div>
      <div class="order-id"><?php print render($content['order_id']); ?></div>

      <div class="line-items">
        <div class="line-items-view"><?php print render($content['commerce_line_items']); ?></div>
        <div class="order-total"><?php print render($content['commerce_order_total']); ?></div>
      </div>
      <div class="invoice-text"><?php print render($content['invoice_text']); ?></div>

      <div class="invoice-footer"><?php print render($content['invoice_footer']); ?></div>
</div>
