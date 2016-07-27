<?php
/**
 * @file
 * Default theme implementation for beans.
 *
 * Available variables:
 * - $content: An array of comment items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $title: The (sanitized) entity label.
 * - $url: Direct url of the current entity if specified.
 * - $page: Flag for the full page state.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. By default the following classes are available, where
 *   the parts enclosed by {} are replaced by the appropriate values:
 *   - entity-{ENTITY_TYPE}
 *   - {ENTITY_TYPE}-{BUNDLE}
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess()
 * @see template_preprocess_entity()
 * @see template_process()
 */
global $language;
$langue = $language->language;
//dpm($content);
?>
<div class="col-xs-12 mobile <?php print $classes; ?>">
        <img src="<?php print render($content['field_image_mobile']); ?>" class="img-responsive"/>
    <img src="sites/all/themes/chapoutier/img/signature_facetspera.svg" onload="this.style.opacity='1';" class="facetspera"/>
</div>
<div class="col-md-12 embed-responsive embed-responsive-16by9 desktop <?php print $classes; ?>">
    <?php
        if(isset($content['field_video']['#items'][0]['uri'])) {?>
              <video id="video-homepage" class="video-js embed-responsive-item" loop muted autoplay preload
                     poster="<?php print render($content['field_image']); ?>" data-setup="{}">
                    <source src="<?php print render($content['field_video']); ?>" type='video/mp4'>
              </video>
        <?php } ?>
    <!--<script>
        //var video = document.getElementById("video-homepage");
        //video.addEventListener("canplay", function() {
        //    setTimeout(function() {
        //        video.play();
        //    }, 2000);
        //});
    </script>-->
</div>
<?php if($langue == 'fr'){ ?>
    <div class="col-xs-12 col-md-8 col-md-offset-2 vert-offset-top-3 vert-offset-bottom-3 content">
        <?php print $content['field_description']['#items'][0]['value']; ?>
    </div>
<?php }elseif($langue == 'en'){ ?>
    <div class="col-xs-12 col-md-8 col-md-offset-2 vert-offset-top-3 vert-offset-bottom-3 content">
        <?php print $content['field_description_en']['#items'][0]['value']; ?>
    </div>
<?php }else{ ?>
    <div class="col-xs-12 col-md-8 col-md-offset-2 vert-offset-top-3 vert-offset-bottom-3 content">
        <?php print $content['field_description']['#items'][0]['value']; ?>
    </div>
<?php } ?>