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
//dpm($content);

if(isset($content['field_background'])) {
    $uribackground = $content['field_background']['#items'][0]['uri'];
    $background = file_create_url($uribackground);
}

if(isset($content['field_related_content'])) {
    $nid = $content['field_related_content']['#items'][0]['nid'];
    $url = drupal_get_path_alias('node/' . $nid);
}

if(isset($content['field_country'])) {
    $country = $content['field_country']['#items'][0]['value'];
    $languages = array();

    $items = $content['field_country']['#items'];
    foreach ($items as $delta => $item) {
        //var_dump($item['iso2']);
        $languages[$item['iso2']] = $item['iso2'];

    }
}

//dpm($languages);
//dpm($_COOKIE["shipping_country"]);
$shipping_country = $_COOKIE["shipping_country"];
//dpm($content['field_excluded']['#items'][0]['value']);

if(isset($content['field_excluded']) && $content['field_excluded']['#items'][0]['value'] == '0'){ ?>
    <?php if(in_array($shipping_country, $languages)){ ?>
        <?php if($content['field_block_display']['#items'][0]['value'] == 'zone1'){ ?>
            <div class="col-xs-12 vert-offset-bottom-1 bloc-homepage-shop top" style="background: url('<?php print $background; ?>') no-repeat;">
                <div class="row flex">
                    <h2 class="col-xs-8 text-center title" style="color: <?php print $content['field_text_color']['#items'][0]['rgb']; ?>!important"><?php print $node->title; ?></h2>
                    <div class="col-xs-8 text-center description" style="color: <?php print $content['field_text_color']['#items'][0]['rgb']; ?>!important">
                        <?php print $content['field_description']['#items'][0]['value']; ?>
                    </div>
                    <?php if(isset($content['field_related_content_free'])){?>
                        <div class="col-xs-12 text-center link">
                            <?php print '<a href="/' . $content['field_related_content_free']['#items'][0]['value'] . '">' . t('I discover') . '</a>'; ?>
                        </div>
                    <?php }else{ ?>
                        <?php if(isset($content['field_related_content'])){?>
                            <div class="col-xs-12 text-center link">
                                <?php if(isset($content['field_title_button']) && isset($content['field_related_content'])){
                                    print '<a href="/' . $url . '">' . $content['field_title_button']['#items'][0]['value'] . '</a>';
                                }elseif(isset($content['field_related_content'])){
                                    print '<a href="/' . $url . '">' . t('I discover') . '</a>';
                                } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        <?php }elseif($content['field_block_display']['#items'][0]['value'] == 'zone2'){?>
            <div class="col-xs-12 vert-offset-bottom-1 col-md-6 bloc-homepage-shop middle" style="background: url('<?php print $background; ?>') no-repeat;">
                <div class="row flex">
                    <h2 class="col-xs-8 text-center title" style="color: <?php print $content['field_text_color']['#items'][0]['rgb']; ?>!important"><?php print $node->title; ?></h2>
                    <div class="col-xs-8 text-center description" style="color: <?php print $content['field_text_color']['#items'][0]['rgb']; ?>!important">
                        <?php print $content['field_description']['#items'][0]['value']; ?>
                    </div>
                    <?php if(isset($content['field_related_content_free'])){?>
                        <div class="col-xs-12 text-center link">
                            <?php print '<a href="/' . $content['field_related_content_free']['#items'][0]['value'] . '">' . t('I discover') . '</a>'; ?>
                        </div>
                    <?php }else{ ?>
                        <?php if(isset($content['field_related_content'])){?>
                            <div class="col-xs-12 text-center link">
                                <?php if(isset($content['field_title_button']) && isset($content['field_related_content'])){
                                    print '<a href="/' . $url . '">' . $content['field_title_button']['#items'][0]['value'] . '</a>';
                                }elseif(isset($content['field_related_content'])){
                                    print '<a href="/' . $url . '">' . t('I discover') . '</a>';
                                } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        <?php }elseif($content['field_block_display']['#items'][0]['value'] == 'zone3'){?>
            <div class="col-xs-6 col-md-2 vert-offset-bottom-1 bloc-homepage-shop bottom" style="background: url('<?php print $background; ?>') no-repeat;">
                <a href="<?php print $url ?>">
                    <div class="row flex">
                        <h2 class="col-xs-12 text-center title"><?php print $node->title; ?></h2>
                    </div>
                </a>
            </div>
        <?php } ?>
    <?php } ?>
<?php }else{ ?>
    <?php if(!in_array($shipping_country, $languages)){ ?>
        <?php if($content['field_block_display']['#items'][0]['value'] == 'zone1'){ ?>
            <div class="col-xs-12 vert-offset-bottom-1 bloc-homepage-shop top" style="background: url('<?php print $background; ?>') no-repeat;">
                <div class="row flex">
                    <h2 class="col-xs-8 text-center title" style="color: <?php print $content['field_text_color']['#items'][0]['rgb']; ?>!important"><?php print $node->title; ?></h2>
                    <div class="col-xs-8 text-center description" style="color: <?php print $content['field_text_color']['#items'][0]['rgb']; ?>!important">
                        <?php print $content['field_description']['#items'][0]['value']; ?>
                    </div>
                    <?php if(isset($content['field_related_content_free'])){?>
                        <div class="col-xs-12 text-center link">
                            <?php print '<a href="/' . $content['field_related_content_free']['#items'][0]['value'] . '">' . t('I discover') . '</a>'; ?>
                        </div>
                    <?php }else{ ?>
                        <?php if(isset($content['field_related_content'])){?>
                            <div class="col-xs-12 text-center link">
                                <?php if(isset($content['field_title_button']) && isset($content['field_related_content'])){
                                    print '<a href="/' . $url . '">' . $content['field_title_button']['#items'][0]['value'] . '</a>';
                                }elseif(isset($content['field_related_content'])){
                                    print '<a href="/' . $url . '">' . t('I discover') . '</a>';
                                } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        <?php }elseif($content['field_block_display']['#items'][0]['value'] == 'zone2'){?>
            <div class="col-xs-12 vert-offset-bottom-1 col-md-6 bloc-homepage-shop middle" style="background: url('<?php print $background; ?>') no-repeat;">
                <div class="row flex">
                    <h2 class="col-xs-8 text-center title" style="color: <?php print $content['field_text_color']['#items'][0]['rgb']; ?>!important"><?php print $node->title; ?></h2>
                    <div class="col-xs-8 text-center description" style="color: <?php print $content['field_text_color']['#items'][0]['rgb']; ?>!important">
                        <?php print $content['field_description']['#items'][0]['value']; ?>
                    </div>
                    <?php if(isset($content['field_related_content_free'])){?>
                        <div class="col-xs-12 text-center link">
                            <?php print '<a href="/' . $content['field_related_content_free']['#items'][0]['value'] . '">' . t('I discover') . '</a>'; ?>
                        </div>
                    <?php }else{ ?>
                        <?php if(isset($content['field_related_content'])){?>
                            <div class="col-xs-12 text-center link">
                                <?php if(isset($content['field_title_button']) && isset($content['field_related_content'])){
                                    print '<a href="/' . $url . '">' . $content['field_title_button']['#items'][0]['value'] . '</a>';
                                }elseif(isset($content['field_related_content'])){
                                    print '<a href="/' . $url . '">' . t('I discover') . '</a>';
                                } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        <?php }elseif($content['field_block_display']['#items'][0]['value'] == 'zone3'){?>
            <div class="col-xs-6 col-md-2 vert-offset-bottom-1 bloc-homepage-shop bottom" style="background: url('<?php print $background; ?>') no-repeat;">
                <a href="<?php print $url ?>">
                    <div class="row flex">
                        <h2 class="col-xs-12 text-center title"><?php print $node->title; ?></h2>
                    </div>
                </a>
            </div>
        <?php } ?>
    <?php } ?>
<?php } ?>
