<?php

/**
 * @file
 * A basic template for room entities
 *
 * Available variables:
 * - $content: An array of comment items. Use render($content) to print them
 *   all, or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $title: The name of the room
 * - $url: The standard URL for viewing a room entity
 * - $page: TRUE if this is the main view page $url points too.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. By default the following classes are available, where
 *   the parts enclosed by {} are replaced by the appropriate values:
 *   - entity-profile
 *   - room-{TYPE}
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess()
 * @see template_preprocess_entity()
 * @see template_process()
 */
?>
<?php //dpm($content); ?>

<div class="row">
  <div class="col-md-12">
    <div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
      <?php if (!$page): ?>
        <h2<?php print $title_attributes; ?>>
           <?php print $title; ?>
        </h2>
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-md-6">
        <?php print render($content['field_description']); ?>

        <?php print render($content['field_google_maps']); ?>


    </div>
    <div class="col-md-6">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php $items = $content['field_images']['#items']; $count = 0; ?>
                <?php foreach ($items as $delta => $item): ?>
                    <?php $count++; ?>
                    <div class="item<?php if($count == 1){ ?> active<?php } ?>">
                        <?php $uri = $item['uri']; ?>
                        <?php $url_uri = file_create_url($uri); ?>
                        <img src="<?php print $url_uri; ?>" class="img-responsive" alt="" />
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <!-- Button trigger modal -->
        <div class="pull-right">
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                Réserver !
            </button>
            <?php print render($content['sharethis']); ?>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php print t('Reserved my trip'); ?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <?php print render($content['bookable_unit_reference']); ?>
                            </div>
                            <div class="col-md-6">
                                <?php
                                $block = module_invoke('wassa_easy_booking_chapoutier', 'block_view', 'wassa_easy_booking_chapoutier', array('bookable_unit_reference' => $content['bookable_unit_reference']['#items'][0]['target_id']));
                                print render($block['content']);
                                ?>
                                <?php
                                //$block = module_invoke_all('block_view', 'rooms_availability_search');
                                //print render($block['content']);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?php print render($content['bookable_unit_reference']); ?>
    </div>
    <div class="col-md-6">
        <?php
        $block = module_invoke('wassa_easy_booking_chapoutier', 'block_view', 'wassa_easy_booking_chapoutier', array('bookable_unit_reference' => $content['bookable_unit_reference']['#items'][0]['target_id']));
        print render($block['content']);
        ?>
        <?php
        //$block = module_invoke_all('block_view', 'rooms_availability_search');
        //print render($block['content']);
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Contenu principal
        </a>
        <div class="collapse" id="collapseExample">
            <div class="well">
                <?php print render($content); ?>
            </div>
        </div>
    </div>
</div>
<style>
    .google_map_field_display {
        height: 300px;
        width: 100%;
    }
</style>