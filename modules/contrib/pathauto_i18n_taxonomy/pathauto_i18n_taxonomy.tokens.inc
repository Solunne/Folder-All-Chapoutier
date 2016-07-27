<?php

/**
 * @file
 * Builds placeholder replacement tokens for taxonomy terms and vocabularies.
 */

/**
 * Implements hook_token_info().
 */
function pathauto_i18n_taxonomy_token_info() {

  // Taxonomy term related variables.
  $term['i18n-parents'] = array(
    'name' => t('Parents (localized)'),
    'description' => t("An array of all the term's parents, starting with the root."),
    'type' => 'array',
  );

  return array(
    'tokens' => array(
      'term' => $term,
    ),
  );
}

/**
 * Implements hook_tokens().
 */
function pathauto_i18n_taxonomy_tokens($type, $tokens, array $data = array(), array $options = array()) {
  $replacements = array();
  $sanitize = !empty($options['sanitize']);
  $langcode = isset($options['language']) ? $options['language']->language : i18n_langcode();

  if ($type == 'term' && !empty($data['term'])) {
    $term = $data['term'];

    // Chained tokens
    // [term:i18n-parents:*] chained tokens.
    if ($parents_tokens = token_find_with_prefix($tokens, 'i18n-parents')) {
      if ($parents = token_taxonomy_term_load_all_parents($term->tid)) {

        //translate terms to language
        foreach($parents as $tid => $term) {
          $term = taxonomy_term_load($tid);
          $translated_parents[$tid] = check_plain(i18n_taxonomy_term_name($term, $langcode));
        }
        $replacements += token_generate('array', $parents_tokens, array('array' => $translated_parents), $options);
      }
    }
  }

  return $replacements;
}
