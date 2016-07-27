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
//dpm($node);
?>

<div class="row flex">
    <div class="col-md-11 col-xs-12 range-page">
        <div class="col-md-12 col-xs-12 range-presentation" style="background-image: url('<?php print render($content['field_background']); ?>');">
            <h1 class="range-presentation-title"><?php print render($content['title_field']); ?></h1>
            <h3 class="range-presentation-subtitle"><?php print render($content['field_subtitle']); ?></h3>
            <div class="range-presentation-body"><?php print render($content['body']); ?></div>
            <div class="range-presentation-go"><a href="#slide0"><?php print t('See the range'); ?></a></div>
            <div class="range-presentation-goimg"><a href="#slide0">go</a></div>
        </div>

        <div class="col-xs-12 col-md-12 range-content" style="background-image: url('<?php print render($content['field_background_slide']); ?>');">
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <nav class="list-range" id="range">
                        <ul class="list-range-big">
                            <?php
                            $liste = $content['field_slide_range']['#items'];
                            foreach ($liste as $id => $number) {
	                           
	                            
                                $id_slide = $number['value'];
                                if(isset($content['field_slide_range'][$id]['entity']['field_collection_item'][$id_slide]['title_field'])) {
                                    $title_slide = $content['field_slide_range'][$id]['entity']['field_collection_item'][$id_slide]['title_field']['#items'][0]['value'];
                                    $wine_color = $content['field_slide_range'][$id]['entity']['field_collection_item'][$id_slide]['field_wine_color']['#items'][0]['value'];
                                    $aoc = $content['field_slide_range'][$id]['entity']['field_collection_item'][$id_slide]['field_aoc_igp'][0]['#markup'];
                                    
									if(isset($content['field_slide_range'][$id]['entity']['field_collection_item'][$id_slide]['field_reference_wine_display'])){
										$param = $content['field_slide_range'][$id]['entity']['field_collection_item'][$id_slide]['field_reference_wine_display']['#items'][0]['nid'];
			                            $distant_node = node_load($param);
			                            //dpm($distant_node);
			                            //$vineyard = $distant_node->field_vineyard['und'][0]['tid'];
									}
                                }else{
                                    $title_slide = '';
                                    $wine_color = '';
                                    $aoc = '';
                                }
                                ?>
                                <li class="anchor-range">
                                    <a class="" data-slide="#slide<?php print $id; ?>"><?php if($content['field_puce_title']['#items'][0]['value'] == '1'){ ?>
                                    <?php 
	                                    /*
if($vineyard == '126'){
		                                	print $aoc;
		                                	print ' - '.$wine_color;
	                                    }
	                                    else{
		                                    
*/
											if (arg(0) == 'node' && is_numeric(arg(1))) {
											  $nid = arg(1);
											  if ($nid) {
											    $node = node_load($nid);
											    /** do something **/  
											  }
											}
											if($nid == '2205'){
												print $aoc.' - '.$wine_color;
											}
											else{
												print $title_slide.' - '.$wine_color;
											}
		                                    
		                                    //print $vineyard;
		                                    // print ' - '.$aoc;
		                                    //print ' - '.$aoc;
		                                    /*
if(isset($vineyard){
			                                	print ' - '.$vineyard;    
		                                    }
*/
		                                   
	                                    //}
                                    ?>
                                    <?php }else{} ?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <div class="list-range-small">
                            <select>
                                <?php
                                $liste = $content['field_slide_range']['#items'];
                                foreach ($liste as $id => $number) {
                                    $id_slide = $number['value'];
                                    if(isset($content['field_slide_range'][$id]['entity']['field_collection_item'][$id_slide]['title_field'])) {
                                        $title_slide = $content['field_slide_range'][$id]['entity']['field_collection_item'][$id_slide]['title_field']['#items'][0]['value'];
                                        $wine_color = $content['field_slide_range'][$id]['entity']['field_collection_item'][$id_slide]['field_wine_color']['#items'][0]['value'];
                                    }else{
                                        $title_slide = '';
                                        $wine_color = '';
                                    }
                                    ?>
                                    <option value="<?php print $title_slide; ?>" data-slide="#slide<?php print $id; ?>"><?php print $title_slide.' - '.$wine_color; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </nav>
                </div>
                <div class="col-md-8 col-xs-12">
                    <?php print render($content['field_slide_range']); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-1 glossary-sidebar">
        <h3 class="title"><?php print t('Lexicon'); ?></h3>
        <?php
        $blockObject = block_load('views', 'glossary_display-glossary');
        $block = _block_get_renderable_array(_block_render_blocks(array($blockObject)));
        $output = drupal_render($block);
        print $output;
        ?>
    </div>
</div>