<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
?>
<?php //dpm($fields); ?>

<?php
$order_id = $fields['order_id']->content;
$product_id = $fields['product_id']->content;
$payment = $fields['payment_method']->content;
$shipping = $fields['commerce_shipping_service']->content;
?>

<?php if($order_id == arg(1) && !$product_id == ''){ ?>
    <?php
    switch ($payment) {
        case 'commerce_cheque':?>
            <p><?php print t('You have just made a payment by check, thank you send it to the following address not forgetting to include your order number') . ' (' . $order_id . '):'; ?></p>
            <p>Chapoutier S.A.<br>18 Avenue du Docteur Paul Durand<br>26600 Tain l’Hermitage<br>FRANCE</p>
            <p><?php print t('Upon receipt of it we will send your order as soon as possible'); ?>.</p>
            <?php break;
        case 'wassa_payline_payment':?>
            <p><?php print t('You have just made a payment by credit card');?>.</p>
            <?php break;
        case 'bank_transfer':?>
            <p><?php print t('You have just made a payment by bank transfer, thank you to make the transfer to the following bank account, not forgetting to include your order number') . ' (' . $order_id . '):'; ?></p>
            <p><strong><?php print t('Account owner'); ?>:</strong> SA M.CHAPOUTIER<br/>
                <strong><?php print t('Account number');?>:</strong> 00020489070<br/>
                <strong><?php print t('IBAN');?>:</strong> FR76 3000 4006 6400 0204 8907 029<br/>
                <strong><?php print t('Bank code');?>:</strong> 30004<br/>
                <strong><?php print t('SWIFT');?>:</strong> BNPAFRPPAAE<br/>
                <strong><?php print t('Banking institution');?>:</strong> BNP Paribas<br/>
                <strong><?php print t('Branch office');?>:</strong> BNP PARIBAS ARC ALPIN ENTREP</p>
            <p><?php print t('Upon receipt of it we will send your order as soon as possible'); ?>.</p>
            <?php break;
    }
    ?>
<?php }?>

<?php if($order_id == arg(1) && !$product_id == ''){ ?>
    <?php
    switch ($shipping) {
        case 'mazet_shipping':?>
            <p><?php print t('You have chosen to send your order by our carrier Mazet, you will be informed of the shipment of your order by email');?>.</p>
            <?php break;
        case 'retrait_boutique':?>
            <p><?php print t('You chose to withdraw your order at the cellar Chapoutier, you will be informed of the availability of your order by e-mail');?>.</p>
            <p><?php print t('The mailing address of our cellar');?>:</p>
            <p>Chapoutier S.A.<br>18 Avenue du Docteur Paul Durand<br>26600 Tain l’Hermitage<br>FRANCE</p>
            <?php break;
    }
    ?>
<?php }?>

