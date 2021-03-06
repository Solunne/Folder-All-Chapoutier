<?php

/**
 * @file
 * Field handler to present an order's operations links.
 */

class commerce_socolissimo_handler_field_rate_operations extends views_handler_field {
  /**
   * Class constructor.
   */
  function construct() {
    parent::construct();

    $this->additional_fields['rate_id'] = 'rate_id';
    $this->additional_fields['name'] = 'name';
  }

  /**
   * Provides default options for the handler.
   *
   * @return array
   *   The options array.
   */
  function option_definition() {
    $options = parent::option_definition();

    $options['add_destination'] = TRUE;

    return $options;
  }

  /**
   * Exposes a form for the handler options.
   *
   * @param array $form
   *   The form array.
   * @param array $form_state
   *   The form state array.
   */
  function options_form(&$form, &$form_state) {
    parent::options_form($form, $form_state);

    $form['add_destination'] = array(
      '#type' => 'checkbox',
      '#title' => t('Add a destination parameter to edit and delete operation links so users return to this View on form submission.'),
      '#default_value' => $this->options['add_destination'],
    );
  }

  /**
   * Query method.
   */
  function query() {
    $this->ensure_my_table();
    $this->add_additional_fields();
  }

  /**
   * Display links to manage the commerce_socolissimo_rate entity type.
   *
   * @param array $values
   *   View's values.
   *
   * @return bool|string
   *   Operations links.
   */
  function render($values) {
    $rate_id = $this->get_value($values, 'rate_id');
    $name = $this->get_value($values, 'name');

    $service_name_url = 'socolissimo-flexibility' . '-' . strtr($name, '_', '-');

    // Get the operations links.
    $links = menu_contextual_links('commerce_socolissimo', 'admin/commerce/config/shipping/services/' . $service_name_url . '/rate', array($rate_id));

    if (!empty($links)) {
      // Add the destination to the links if specified.
      if ($this->options['add_destination']) {
        foreach ($links as $id => &$link) {
          // Only include the destination for the edit and delete forms.
          if (in_array(
            $id, array(
              'commerce-socolissimo-flexibility-rate-edit',
              'commerce-socolissimo-flexibility-rate-delete',
            )
          )
          ) {
            $link['query'] = drupal_get_destination();
          }
        }
      }

      return theme(
        'links', array(
          'links' => $links,
          'attributes' => array(
            'class' => array(
              'links',
              'inline',
              'operations',
            ),
          ),
        )
      );
    }

    return FALSE;
  }
}
