<?php
/**
 * @file node--wine-display.tpl.php
 * Override theme implementation to display a node.
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
 * @ingroup templates
 */
//dpm($content);
?>
<?php
    global $language;
    $langue= $language->language;
?>
<div class="row padding-lateral">
    <div class="col-xs-12 col-md-3 sidebar-left" style="position: inherit;">
        <div class="">
            <div class="col-xs-12 title color">
                <div class="flex">
                    <div class="col-xs-9 col-md-10 title">
                        <h1 class="title"><?php print $content['title_field']['#items'][0]['value']; ?></h1>
                    </div>
                    <div class="col-xs-3 col-md-2 pull-right color">
                        <?php
                            $winetype = $content['field_wine_type']['#items'][0]['tid'];
                            $tid_winetype  = taxonomy_term_load($winetype);
                            $translated_tid_winetype = i18n_taxonomy_localize_terms($tid_winetype);
                            $class = sanitized($tid_winetype->name);
                            //dpm($translated_tid_winetype);
                        ?>
                        <p class="<?php print $class; ?>"><?php print $translated_tid_winetype->name; ?></p>
                        <?php //print render($content['field_wine_type']); ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-9 col-md-12 product<?php if(isset($content['product:field_unavailable_online_purchas']) && ($content['product:field_unavailable_online_purchas']['#items'][0]['value'] == '1')){ print ' not-purchase-online'; } ?>" style="position: inherit;">
                <?php print render($content['field_product']); ?>
            </div>
            <div class="col-xs-3 price-bottle mobile<?php if(isset($content['product:field_unavailable_online_purchas']) && ($content['product:field_unavailable_online_purchas']['#items'][0]['value'] == '1')){ print ' not-purchase-online'; }?>">
                <div class="row">
                <div class="col-xs-12"><?php print render($content['product:commerce_price']); ?></div>
                    <div class="col-xs-12"><?php print render($content['product:field_commerce_saleprice']); ?></div>
                </div>
            </div>
            <div class="col-xs-12 vineyard">
                <?php if(isset($content['field_vineyard'])) { ?>
                    <?php $namevineyard = $content['field_vineyard']['#items'][0]['entity']->name; ?>
                    <?php
                        if(isset($content['field_vineyard']['#items'][0]['entity']->field_image['und'][0]['uri'])){
                        $urivineyard = $content['field_vineyard']['#items'][0]['entity']->field_image['und'][0]['uri'];
                        $realurivineyard = file_create_url($urivineyard);
                    ?>
                            <img alt="<?php print $namevineyard; ?>" src="<?php print $realurivineyard; ?>" />
                            <?php }else{ ?>
                                <p class="text-center"><?php print $namevineyard; ?></p>
                            <?php }?>
                        <?php }?>
            </div>
            <div class="col-xs-12 aoc-igp">
                <?php if(isset($content['field_aoc_igp'])) { ?>
                    <?php $items = $content['field_aoc_igp']['#items']; ?>
                    <?php foreach ($items as $delta => $item): ?>
                        <?php if($langue == 'fr'){ ?>
                            <p class="text-center"><a href="/<?php print $langue; ?>/boutique/nos-vins?aocigp[0]=<?php print $item['tid']; ?>"><?php print $item['taxonomy_term']->name; ?></a></p>
                        <?php }else if($langue == 'en'){ ?>
                            <p class="text-center"><a href="/<?php print $langue; ?>/shop/wines?aocigp[0]=<?php print $item['tid']; ?>"><?php print $item['taxonomy_term']->name; ?></a></p>
                        <?php } ?>
                    <?php endforeach; ?>
                <?php }?>
            </div>
            <?php if(isset($content['field_description'])){ ?>
                <div class="col-xs-12 description">
                    <?php print $content['field_description']['#items'][0]['value']; ?>
                </div>
            <?php } ?>
            <div class="col-xs-12 map">
                <?php if(isset($content['field_location'])) { ?>
                    <?php
                        $tid = $content['field_location']['#items'][0]['tid'];
                        $tid_location  = taxonomy_term_load($tid);
                        $translated_tid_location = i18n_taxonomy_localize_terms($tid_location);
                        //dpm($translated_tid_location);
                        $namelocation = $translated_tid_location->name;
                    ?>
                    <?php
                    if(isset($content['field_location']['#items'][0]['entity']->field_map_display['und'][0]['uri'])){
                        $urilocation = $content['field_location']['#items'][0]['entity']->field_map_display['und'][0]['uri'];
                        $realurilocation = file_create_url($urilocation);

                        $tidlocation = $content['field_location']['#items'][0]['tid'];
                        $parent_terms = taxonomy_get_parents_all($tidlocation);

                        ?>

                            <img class="img-responsive" alt="<?php print $namelocation; ?>" src="<?php print $realurilocation; ?>" />
                            <?php if($langue == 'fr'){ ?>
                                <p class="text-center"><a href="/<?php print $langue; ?>/boutique/nos-vins?location[0]=<?php print $content['field_location']['#items'][0]['tid']; ?>"><?php print $namelocation ?><?php if(!empty($parent_terms)){ ?> <?php print $parent_terms[1]->name; ?><?php } ?></a></p>
                            <?php }else if($langue == 'en'){ ?>
                                <p class="text-center"><a href="/<?php print $langue; ?>/shop/wines?location[0]=<?php print $content['field_location']['#items'][0]['tid']; ?>"><?php print $namelocation ?><?php if(!empty($parent_terms)){ ?> <?php print $parent_terms[1]->name; ?><?php } ?></a></p>
                            <?php } ?>
                        <?php }else{ ?>
                            <?php if($langue == 'fr'){ ?>
                                <p class="text-center"><a href="/<?php print $langue; ?>/boutique/nos-vins?location[0]=<?php print $content['field_location']['#items'][0]['tid']; ?>"><?php print $namelocation ?><?php if(!empty($parent_terms)){ ?> <?php print $parent_terms[1]->name; ?><?php } ?></a></p>
                            <?php }else if($langue == 'en'){ ?>
                                <p class="text-center"><a href="/<?php print $langue; ?>/shop/wines?location[0]=<?php print $content['field_location']['#items'][0]['tid']; ?>"><?php print $namelocation ?><?php if(!empty($parent_terms)){ ?> <?php print $parent_terms[1]->name; ?><?php } ?></a></p>
                            <?php } ?>
                    <?php }?>
                <?php }?>
            </div>
            <?php if(isset($content['field_video'])){ ?>
                <div class="col-xs-12 video">
                    <?php
                        $video = $content['field_video']['#items'][0]['uri'];
                        $realvideo = file_create_url($video);
                        $poster = $content['field_image']['#items'][0]['uri'];
                        $realposter = file_create_url($poster);
                    ?>
                    <video id="wine-video" style="width: 100%;" class="wine-video video-js embed-responsive-item" controls preload="auto" width="100%" height="264" poster="<?php print $realposter; ?>" data-setup="{}">
                        <source src="<?php print $realvideo; ?>" type='video/mp4'>
                    </video>
                </div>
            <?php } ?>
            <div class="col-xs-12 labels desktop">
                <ul class="list-labels">
                    <?php print render($content['field_labels']); ?>
                </ul>
            </div>
            <?php if(isset($content['field_sulfites'])){ ?>
                <div class="col-xs-12 sulfites desktop text-center">
                    <p class="text-center">
                        <?php
                        if($content['field_sulfites']['#items'][0]['value'] == '1'){
                            print t('Contains sulfites');
                        }
                        ?>
                    </p>
                </div>
            <?php } ?>
            <div class="col-xs-12 sharethis desktop text-center">
                <?php print render($content['sharethis']); ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-9 content-wine">
        <div class="">
            <div class="col-xs-12 col-md-12 bread-crumb">
                <a href="javascript:history.back();"><?php print t('Ours wines'); ?> > </a><span class="current-node"><?php print $title; ?></span>
            </div>
            <div class="col-xs-12 col-md-5">
                <div class="row">
                    <?php if(isset($content['field_bio'])){ ?>
                        <div class="col-xs-12 bio">

                                <?php
                                //dpm($content['field_bio']->tid);
                                $input = $content['field_bio']['#items'][0]['tid'];
                                $tid = taxonomy_term_load($input);
                                $translated_tid = i18n_taxonomy_localize_terms($tid);
                                //dpm($translated_tid);
                                $uri = $tid->field_tooltip_image['und'][0]['uri'];
                                $bioimg = file_create_url($uri);
                                $biotitle = $translated_tid->name;
                                $biotexte = $translated_tid->field_tooltip;
                                ?>

                                <img src="<?php print $bioimg; ?>" class="bio" data-trigger="hover" data-toggle="popover" data-title="<?php print $biotitle; ?>" data-content="<?php print $biotexte; ?>" />

                        </div>
                    <?php } ?>
                    <?php if(isset($content['product:field_images'])){ ?>
                        <div class="col-xs-12 image">
                            <?php print render($content['product:field_images']); ?>
                            <?php
    /*                            $img = $content['field_images']['#items'][0]['uri'];
                                $urlimg = file_create_url($img);
                            */?><!--
                            <img class="img-product" src="<?php /*print $urlimg; */?>" />-->
                        </div>
                    <?php } ?>
                    <!--<div class="col-xs-12 pdf-technical-sheet">
                        <?php
/*                        $node = $node->nid;
                        $alias = drupal_get_path_alias('node/'. $node);
                        */?>
                        <p class="text-center">
                            <a target="_blank" href="/<?php /*print $langue; */?>/printpdf/<?php /*print $alias; */?>"><?php /*print t('Technical Sheet'); */?></a>
                        </p>
                    </div>-->
                </div>
                <?php if(isset($content['field_sulfites'])){ ?>
                    <div class="col-xs-12 sulfites mobile">
                        <p class="text-center">
                            <?php
                            if($content['field_sulfites']['#items'][0]['value'] == '1'){
                                print t('Contains sulfites');
                            }
                            ?>
                        </p>
                    </div>
                <?php } ?>
            </div>
            <div class="col-xs-12 col-md-7 informations">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-md-4 price-bottle desktop<?php if(isset($content['product:field_unavailable_online_purchas']) && ($content['product:field_unavailable_online_purchas']['#items'][0]['value'] == '1')){ print ' not-purchase-online'; }?>">
                                <?php
                                    print render($content['product:commerce_price']);
                                    print render($content['product:field_commerce_saleprice']);
                                ?>
                            </div>
                            <?php if(isset($content['product:field_unavailable_online_purchas']) && ($content['product:field_unavailable_online_purchas']['#items'][0]['value'] == '1')){ ?>
                                <div class="col-xs-12 col-md-12 text-info not-purchase-online">
                                    <p class="text-right"><?php print t('Unavailable on our site'); ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php if($content['field_treacly']['#items'][0]['value'] == '0'){ ?>
                        <?php if(isset($content['product:field_notation'])){ ?>
                            <div class="col-xs-12 notation">
                                <?php print render($content['product:field_notation']); ?>
                            </div>
                        <?php } ?>
                        <div class="col-xs-12 technical">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#technical_sheet" class="technical-sheet" aria-controls="technical_sheet" role="tab" data-toggle="tab"><?php print t('Technical information'); ?></a></li>
                            <li role="presentation"><a href="#tasting" class="tasting" aria-controls="tasting" role="tab" data-toggle="tab"><?php print t('Tasting notes'); ?></a></li>
                            <li role="presentation"><a href="#sommelier_advice" class="sommelier-advice" aria-controls="sommelier_advice" role="tab" data-toggle="tab"><?php print t('Sommelier\'s advice'); ?></a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="technical_sheet">
                                <div class="row">
                                    <?php if(isset($content['field_grape'])){ ?>
                                        <div class="col-xs-12 grape">
                                            <h3 class="vines"><?php print t('Grape variety'); ?></h3>
                                            <?php print render($content['field_grape']); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if(isset($content['field_grounds'])){ ?>
                                        <div class="col-xs-12 ground">
                                            <h3 class="grounds"><?php print t('Soil'); ?></h3>
                                            <?php print render($content['field_grounds']); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if(isset($content['field_harvest'])){ ?>
                                        <div class="col-xs-12 harvest">
                                            <h3 class="harvest"><?php print t('Harvest'); ?></h3>
                                            <?php print render($content['field_harvest']); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if(isset($content['field_winemaking'])){ ?>
                                        <div class="col-xs-12 maturing_wine">
                                            <h3 class="winemaking"><?php print t('Vinification'); ?></h3>
                                            <?php print render($content['field_winemaking']); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if(isset($content['field_maturing_wine'])){ ?>
                                        <div class="col-xs-12 livestock">
                                            <h3 class="maturing"><?php print t('Maturing'); ?></h3>
                                            <?php print render($content['field_maturing_wine']); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if(isset($content['product:field_alcohol_content']) && (!empty($content['product:field_alcohol_content']['#items'][0]['value'])) ){ ?>
                                        <div class="col-xs-12 alcohol">
                                            <h3 class="alcohol"><?php print t('Alcohol degree'); ?></h3>
                                            <p><?php print $content['product:field_alcohol_content']['#items'][0]['value']; ?>° <?php print t('of alcohol'); ?></p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="tasting">
                                <div class="row">
                                    <?php if(isset($content['field_eye'])){ ?>
                                        <div class="col-xs-12 eye">
                                            <h3 class="eye"><?php print t('Eye'); ?></h3>
                                            <?php print render($content['field_eye']); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if(isset($content['field_nose'])){ ?>
                                        <div class="col-xs-12 nose">
                                            <h3 class="nose"><?php print t('Nose'); ?></h3>
                                            <?php print render($content['field_nose']); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if(isset($content['field_mouth'])){ ?>
                                        <div class="col-xs-12 mouth">
                                            <h3 class="mouth"><?php print t('Mouth'); ?></h3>
                                            <?php print render($content['field_mouth']); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="sommelier_advice">
                                <div class="row">
                                    <?php if(isset($content['field_temperature'])){ ?>
                                        <div class="col-xs-12 temperature">
                                            <h3 class="temperature"><?php print t('Ideal temperature'); ?></h3>
                                            <?php print render($content['field_temperature']); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if(isset($content['field_family_accordance']) || isset($content['field_recipe_idea']) || isset($content['field_sommelier'])){ ?>
                                        <div class="col-xs-12 family_accordance">
                                            <h3 class="family"><?php print t('Food & wine pairing'); ?></h3>
                                            <?php if(isset($content['field_sommelier'])){ ?>
                                                <p><?php print $content['field_sommelier']['#items'][0]['value']; ?></p>
                                            <?php } ?>

                                            <?php if(isset($content['field_family_accordance'])) { ?>
                                                <?php $items = $content['field_family_accordance']['#items']; ?>
                                                <ul class="list_family_accordance">
                                                    <?php foreach ($items as $delta => $item): ?>
                                                        <?php //dpm($item); ?>
                                                        <?php if($langue == 'fr'){ ?>
                                                            <li><a href="/<?php print $langue; ?>/boutique/nos-vins?field_family_accordance_tid[0]=<?php print $item['tid']; ?>"><?php print $item['entity']->name; ?></a></li>
                                                        <?php }else if($langue == 'en'){ ?>
                                                            <li><a href="/<?php print $langue; ?>/shop/wines?field_family_accordance_tid[0]=<?php print $item['tid']; ?>"><?php print $item['entity']->name; ?></a></li>
                                                        <?php } ?>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php }?>

                                            <?php if(isset($content['field_recipe_idea'])){ ?>
                                                <ul class="list_recipe_idea">
                                                    <?php print render($content['field_recipe_idea']); ?>
                                                </ul>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                    <?php if(isset($content['field_guard_time'])){ ?>
                                        <div class="col-xs-12 guard_time">
                                            <h3 class="guard"><?php print t('How long can I keep this wine ?'); ?></h3>
                                            <?php print render($content['field_guard_time']); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }else{ ?>
                        <div class="col-xs-12 treacly technical">
                            <h3 class="origin"><?php print t('Origin and production'); ?></h3>
                            <?php print render($content['field_origin_and_development']); ?>

                            <h3 class="tasting"><?php print t('Tasting notes'); ?></h3>
                            <?php print render($content['field_tasting']); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="col-xs-12 labels mobile">
                <ul class="list-labels">
                    <?php print render($content['field_labels']); ?>
                </ul>
            </div>

            <div class="col-xs-12 sharethis mobile text-center">
                <?php print render($content['sharethis']); ?>
            </div>

            <?php if(isset($content['field_related_content']['#items'])){ ?>
                <div class="col-xs-12 col-md-12 related-wines">
                    <h3 class="title text-center"><span class="line"><?php print t('We also recommend :'); ?></span></h3>
                    <div class="row">
                        <div class="col-xs-12 col-md-4">
                            <?php $items = $content['field_related_content']['#items']; ?>
                            <?php foreach ($items as $delta => $item): ?>
                                <?php
                                    //dpm($item);
                                    $nid = $item['node']->nid;
                                    $node_urlalias =  drupal_get_path_alias( 'node/' . $nid );
                                ?>
                                <a href="/<?php print $node_urlalias; ?>">
                                    <div class="flex">
                                        <div class="col-xs-4">
                                            <?php
                                                $product_id = $item['node']->field_product[$langue][0]['product_id'];
                                                $product = commerce_product_load($product_id);
                                                $uri = $product->field_images[$langue][0]['uri'];
                                                $realuri = file_create_url($uri);

                                                $tidmillesime = $product->field_millesime['und'][0]['tid'];
                                                $millesime = taxonomy_term_load($tidmillesime);

                                                $tidtype = $item['node']->field_wine_type['und'][0]['tid'];
                                                $type = taxonomy_term_load($tidtype);
                                                //dpm($type);
                                            ?>
                                            <img class="img-responsive" src="<?php print $realuri; ?>" />
                                        </div>
                                        <div class="col-xs-8">
                                            <h3 class="title-related text-center"><?php print $item['node']->title; ?></h3>
                                            <p class="wine_vintage text-center"><?php print $millesime->name; ?></p>
                                            <p class="aoc-igp text-center"><?php print $item['node']->field_aoc_igp['und'][0]['taxonomy_term']->name; ?></p>

                                            <p class="wine-type <?php print $type->name; ?> text-center"><?php print $type->name; ?></p>
                                            <p class="link-product text-center" href="/<?php print $node_urlalias; ?>"><?php print t('Find out more'); ?></p>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php }else{ ?>
                <div class="col-xs-12 col-md-12 related-wines">
                    <h3 class="title text-center"><span class="line"><?php print t('We also recommend :'); ?></span></h3>
                    <?php
                        //$blockObject = block_load('views', 'b4853c503164aad632e0ac5369b4703a');
                        $blockObject = block_load('views', 'related_wines-related_wines');
                        //$blockObject->title = '';
                        //$blockObject->region = 'none';
                        $block = _block_get_renderable_array(_block_render_blocks(array($blockObject)));
                        $output = drupal_render($block);
                        print $output;
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>