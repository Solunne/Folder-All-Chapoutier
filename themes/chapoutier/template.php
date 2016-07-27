<?php
/**
 * @file
 * The primary PHP file for this theme.
 */


// Override date

function chapoutier_date_display_single($variables) {
    $date = $variables['date'];

    // Wrap the result with the attributes.
    return $date;
}

/*
 * Override Bootstrap menu dropdown
 */

function chapoutier_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
      // Prevent dropdown functions from being added to management menu so it
      // does not affect the navbar module.
      if (($element['#original_link']['menu_name'] == 'management') && (module_exists('navbar'))) {
          $sub_menu = drupal_render($element['#below']);
      }
      elseif ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] == 1)) {
          // Add our own wrapper.
          unset($element['#below']['#theme_wrappers']);
          $sub_menu = '<ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>';
          // Generate as standard dropdown.
          $element['#title'] .= '';
          $element['#attributes']['class'][] = 'dropdown';
          $element['#localized_options']['html'] = TRUE;

          // Set dropdown trigger element to # to prevent inadvertant page loading
          // when a submenu link is clicked.
          $element['#localized_options']['attributes']['data-target'] = '#';
          $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle disabled';
          $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';
      }
  }
  // On primary navigation menu, class 'active' is not set on active menu item.
  // @see https://drupal.org/node/1896674
  if (($element['#href'] == $_GET['q'] || ($element['#href'] == '<front>' && drupal_is_front_page())) && (empty($element['#localized_options']['language']))) {
      $element['#attributes']['class'][] = 'active';
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}


/*
 * Ajout template tpl.php pour taxonomie Journal
 */

function chapoutier_preprocess_page(&$variables) {

    if (arg(0) == 'taxonomy' && arg(1) == 'term' && is_numeric(arg(2))) {
        $tid = arg(2);
        $vid = db_query("SELECT vid FROM {taxonomy_term_data} WHERE tid = :tid", array(':tid' => $tid))->fetchField();

        $variables['theme_hook_suggestions'][] = 'page__vocabulary__'.$vid;
    }
}

//unset personnal form
function chapoutier_form_alter(&$form, &$form_state, $form_id) {
    if ($form_id == 'user_profile_form') {
        unset($form['contact']);
    }
}

//sanitized $title field collection
function sanitized($title){
    $z = strtolower($title);
    $z = preg_replace('/[^a-z0-9 -]+/', '', $z);
    $z = str_replace(' ', '-', $z);
    return trim($z, '-');
}

function chapoutier_theme(&$existing, $type, $theme, $path){
  $hooks = array();
   // Make user-register.tpl.php available
  $hooks['user_register_form'] = array (
     'render element' => 'form',
     'path' => drupal_get_path('theme','chapoutier'),
     'template' => 'user-register',
     'preprocess functions' => array('chapoutier_preprocess_user_register_form'),
  );
  return $hooks;
}

function chapoutier_preprocess_user_register_form(&$vars) {
  $args = func_get_args();
  array_shift($args);
  $form_state['build_info']['args'] = $args; 
  $vars['form'] = drupal_build_form('user_register_form', $form_state['build_info']['args']);
}