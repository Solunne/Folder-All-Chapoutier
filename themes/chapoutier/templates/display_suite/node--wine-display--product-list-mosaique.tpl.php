<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>
<?php //dpm($content);
//dpm($node);

$nid = $node->nid;
$url = drupal_get_path_alias('node/'. $nid);
global $language;
$langue= $language->language;

$tidaoc = $content['field_aoc_igp']['#items'][0]['tid'];
$aoc = taxonomy_term_load($tidaoc);

$tidvineyard = $content['field_vineyard']['#items'][0]['tid'];
$vineyard = taxonomy_term_load($tidvineyard);
?>

<div class="row" xmlns="http://www.w3.org/1999/html">
    <?php print render($title_suffix); ?>
    <div class="col-xs-12 col-md-10 col-md-offset-1 informations">
        <div class="pull-left bio-color">
            <?php if(isset($content['field_bio'])){ ?>
                <?php
                    $tidbio = $content['field_bio']['#items'][0]['tid'];
                    $bio = taxonomy_term_load($tidbio);
                    $translated_bio = i18n_taxonomy_localize_terms($bio);
                    //dpm($translated_bio);
                    $uritooltipimage = $bio->field_tooltip_image['und'][0]['uri'];
                    $tooltipimage = file_create_url($uritooltipimage);
                ?>
                <span class="pull-left bio">
                    <img src="<?php print $tooltipimage; ?>" class="bio" data-placement="top" data-trigger="hover" data-toggle="popover" title="<?php print $translated_bio->name; ?>" data-content="<?php print $translated_bio->field_tooltip; ?>"/>
                </span>
            <?php } ?>
            <?php if(isset($content['field_wine_type'])){ ?>
                <?php
                    $tidtype = $content['field_wine_type']['#items'][0]['tid'];
                    $type = taxonomy_term_load($tidtype);
                    $translated_type = i18n_taxonomy_localize_terms($type);
                    //dpm($translated_type);
                ?>
                <span class="pull-left color <?php print sanitized($type->name); ?>" data-placement="top" data-trigger="hover" data-toggle="popover" title="<?php print t('Wine color'); ?>" data-content="<?php print $translated_type->name; ?>"></span>
            <?php } ?>
        </div>
        <?php if(isset($content['product:commerce_price'])){ ?>
            <div class="pull-right price-sale-price">
                <a href="/<?php print $langue; ?>/<?php print $url; ?>">
                    <?php if(!isset($content['product:field_commerce_saleprice']['#items'])){ ?>
                        <div class="price no-sale text-right"><?php print render($content['product:commerce_price']); ?></div>
                    <?php }else{ ?>
                        <div class="sale-price with-sale text-right"><?php print render($content['product:commerce_price']); ?></div>
                        <div class="price with-sale text-right"><?php print render($content['product:field_commerce_saleprice']); ?></div>
                    <?php } ?>
                </a>
            </div>
        <?php } ?>
    </div>
    <div class="col-xs-12 col-md-10 col-md-offset-1 image">
        <a href="/<?php print $langue; ?>/<?php print $url; ?>">
            <?php print render($content['product:field_images']); ?>
        </a>
    </div>
    <?php if(!empty($content['title_field'])){ ?>
        <div class="col-xs-12 col-md-10 col-md-offset-1 text-center title">
            <a href="/<?php print $langue; ?>/<?php print $url; ?>">
                <h2><?php print $content['title_field']['#items'][0]['value']; ?></h2>
            </a>
        </div>
    <?php } ?>
    <?php if(!empty($content['field_aoc_igp'])){ ?>
        <div class="col-xs-12 col-md-10 col-md-offset-1 text-center aoc">
            <p><?php print $aoc->name; ?></p>
        </div>
    <?php } ?>
    <?php if(!empty($content['field_vineyard'])){ ?>
        <div class="col-xs-12 col-md-10 col-md-offset-1 text-center producteur">
            <p><?php print $vineyard->name; ?></p>
        </div>
    <?php } ?>
    <div class="col-xs-12 col-md-10 col-md-offset-1 add-to-cart">
        <?php print render($content['field_product']); ?>
    </div>
</div>
